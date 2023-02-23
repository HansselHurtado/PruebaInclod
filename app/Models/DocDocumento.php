<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocDocumento extends Model
{
    use HasFactory;

    protected $table = 'doc_documentos';

    protected $fillable = [
        'doc_nombre',
        'doc_codigo',
        'doc_contenido',
        'doc_id_tipo',
        'doc_id_proceso'
    ];


    public function tipTipoDocs() {
        return $this->belongsTo(TipTipoDoc::class);
    }

    public function proProcesos() {
        return $this->belongsTo(ProProceso::class);
    }

    // scope
    public function scopeSearch($query, $search)
    {
        return $query->where('doc_nombre','like', '%'.$search.'%')
            ->orWhere('doc_codigo','like', '%'.$search.'%')
            ->orWhere('doc_contenido','like', '%'.$search.'%');
    }
}
