<!-- Modal create user -->
<div wire:ignore.self class="modal fade" id="doc-component" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $edit == 1 ? 'Crear':'Editar'}} Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    <label>Nombre</label>
                    <input wire:model.lazy="name" type="text" class="form-control"  placeholder="Nombre">
                </div>
                <div class="form-group col-sm-12">
                    <label>Contenido</label>
                    <textarea wire:model.lazy="content" type="text"  class="form-control" cols="10" rows="4" name="Contenido"></textarea>

                </div>
                @if ($edit == 2)
                    <div class="form-group col-sm-12">
                        <label>Codigo</label>
                        <input wire:model.lazy="code" readonly type="text" class="form-control" placeholder="Codigo">
                    </div>
                @endif
                <div class="form-group col-sm-12">
                    <label >Tipo de documento</label>
                    <select wire:model="type" class="form-control" >
                        <option selected value="Elegir" disabled="true">Elegir</option>
                        @foreach($docTypes as $docType)
                            <option value="{{ $docType->id }}" >
                                {{ $docType->tip_nombre}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-12">
                    <label >Proceso</label>
                    <select wire:model="process" class="form-control" >
                        <option selected value="Elegir" disabled="true">Elegir</option>
                        @foreach($proceses as $proces)
                            <option value="{{ $proces->id }}" >
                                {{ $proces->pro_nombre}}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="mt-2">
                @include('common.messages')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click="StoreOrUpdate(1)" class="btn btn-primary" >Guardar</button>
            </div>
        </div>

    </div>
</div>
