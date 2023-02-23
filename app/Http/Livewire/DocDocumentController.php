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
    public $name, $docDocument, $description, $image, $users, $status = 'Elegir', $selected_id;

    public function mount(){
        $this->docType    = TipTipoDoc::orderBy('tip_nombre')->get();
        $this->Process    = ProProceso::orderBy('pro_nombre')->get();
    }
    public function render()
    {
        try {
            if ($this->search) {
                $docDocument = DocDocumento::Search($this->search);
            }else{
                $docDocument = DocDocumento::orderBy('id','desc');
            }
            return view('doc-document.component',[
                'documents'  => $docDocument->paginate($this->pagination),
            ])->extends('layouts.app')->section('content');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
