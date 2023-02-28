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


    public function tipTipoDoc() {
        return $this->belongsTo(TipTipoDoc::class, 'doc_id_tipo');
    }

    public function proProces() {
        return $this->belongsTo(ProProceso::class, 'doc_id_proceso');
    }

    // scope
    public function scopeSearch($query, $search)
    {
        return $query->where('doc_nombre','like', '%'.$search.'%')
            ->orWhere('doc_codigo','like', '%'.$search.'%')
            ->orWhere('doc_contenido','like', '%'.$search.'%')
            ->orWhereHas('tipTipoDoc', function ($query) use ($search) {
                $query->where('tip_nombre', 'like', '%'.$search.'%');
            })
            ->orWhereHas('proProces', function ($query) use ($search) {
                $query->where('pro_nombre', 'like', '%'.$search.'%');
            });
    }
}
