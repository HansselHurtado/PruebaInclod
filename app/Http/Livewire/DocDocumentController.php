<?php

namespace App\Http\Livewire;

use App\Models\DocDocumento;
use App\Models\ProProceso;
use App\Models\TipTipoDoc;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DocDocumentController extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';//poder utilizar la paginación en laravel 8

    public $pagination = 10, $search, $action = 1, $edit = 1;
    public $name, $code, $docDocument, $content, $type = 'Elegir', $process = 'Elegir', $selected_id;
    public $docTypes = null, $proceses = null;

    public function mount(){
        $this->docTypes    = TipTipoDoc::orderBy('tip_nombre')->get();
        $this->proceses    = ProProceso::orderBy('pro_nombre')->get();
    }
    public function render()
    {
        try {
            if ($this->search) {
                $docDocuments = DocDocumento::Search($this->search);
            }else{
                $docDocuments = DocDocumento::orderBy('id','desc');
            }
            //dd($docDocuments);
            return view('doc-document.component',[
                'docDocuments'  => $docDocuments->paginate($this->pagination),
            ])->extends('layouts.app')->section('content');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function StoreOrUpdate($action)
    {
        $this->validate([
            'name'                  => 'bail|required|min:3|max:20|string',
            'content'               => 'bail|required|string|min:3|max:255',
            'process'               => 'bail|required|not_in:Elegir',
            'type'                  => 'bail|required|not_in:Elegir',
        ]
        );


        if ($this->selected_id) {
            $updateOrCreate = 'actualizado';
            $id             = DocDocumento::find($this->selected_id)['id'];
        }else{
            $updateOrCreate = 'creado';
            $id             = DocDocumento::latest('id')->first();
            $id             = $id ? $id['id']+1: 1;
        }

        $type   = TipTipoDoc::find($this->type)['tip_prefijo'];
        $proces = ProProceso::find($this->process)['pro_prefijo'];
        $code   = $type.'-'.$proces.'-'.$id;

        $find = [
            'id'  => $this->selected_id,
        ];
        $data = [
            'doc_nombre'                => $this->name,
            'doc_codigo'                => $code,
            'doc_contenido'             => $this->content,
            'doc_id_tipo'               => $this->type,
            'doc_id_proceso'            => $this->process,
        ];


        $docDocument = DocDocumento::updateOrCreate($find, $data);

        $this->emit('msgok','El regitro '.$docDocument->doc_nombre.', ha sido '.$updateOrCreate);
        $this->emit('modalsClosed','doc-component');

        // limpiar inpunts
        $this->handleReset($action);
    }

    // limpiar
    public function handleReset($action)
    {
        $this->name             = '';
        $this->docDocument      = '';
        $this->code             = '';
        $this->content          = '';
        $this->action           = $action;
        $this->edit             = 1;
        $this->selected_id      = null;
        $this->process          = 'Elegir';
        $this->type             = 'Elegir';
    }

    //permite la búsqueda cuando se navega entre el paginado
    public function updatingSearch(){
        $this->gotoPage(1);
    }

    public function edit(DocDocumento $docDocumento)
    {
        $this->docDocument      = $docDocumento;
        $this->selected_id      = $docDocumento->id;
        $this->name             = $docDocumento->doc_nombre;
        $this->code             = $docDocumento->doc_codigo;
        $this->content          = $docDocumento->doc_contenido;
        $this->type             = $docDocumento->doc_id_tipo;
        $this->process          = $docDocumento->doc_id_proceso;
        $this->edit             = 2;
    }


    protected $listeners = ['handleDelete'];


    public function handleDelete(DocDocumento $docDocumento, $action){
        $docDocumento->delete();
        $this->emit('msgok','El regitro ha sido eliminado');
        $this->handleReset($action);
    }
}
