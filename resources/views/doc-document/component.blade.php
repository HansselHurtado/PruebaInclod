<div class="card shadow mb-4">
    @include('common.create')
    @include('common.alerts')

    <div class="card-body">
        <div class="table-responsive">
            @if($docDocuments->count() == 0)
                <h2>NO HAY REGISTRO CREADO</h2>
                <hr>
            @else
                @include('common.search')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Contenido</th>
                        <th>Tipo</th>
                        <th>Proceso</th>
                        <th>Fecha creación</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($docDocuments as $element)
                        <tr>
                            <td>{{$element->id}}</td>
                            <td>{{$element->doc_nombre}}</td>
                            <td>{{$element->doc_codigo}}</td>
                            <td>{{$element->doc_contenido}}</td>
                            <td>{{$element->tipTipoDoc->tip_nombre}}</td>
                            <td>{{$element->proProces->pro_nombre}}</td>
                            <td>{{$element->created_at}}</td>
                            <td style="text-align: center;">
                                <ul class="table-controls row d-flex justify-content-between mb-1 mt-1 gap-2" style="list-style-type: none;">
                                    <li>
                                        <a wire:click="edit({{$element->id}}, 1)" class="btn button--md btn-info btn-icon-split text-decoration-none c-pointer text-light" data-toggle="modal" data-target="#doc-component">
                                            <span class="text-white-50 icon  ">
                                                <i class="fas fa-edit padding-0-6"></i>
                                            </span>
                                            <span class="text ">Editar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn button--md btn-danger btn-icon-split text-decoration-none c-pointer" onclick="handleDelete({{$element->id}}, 1)">
                                            <span class=" text-white-50 icon padding-0-6 padding-l-1-2">
                                                <i class="fas fa-trash "></i>
                                            </span>
                                            <span class="text ">Eliminar</span>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $docDocuments->links() }}
            @endif
        </div>
    </div>
    @include('doc-document.modals')

</div>
@section('scripts')
    <script>
        const handleDelete = (id, action) => {
            Swal.fire({
                title: '¿Seguro de eliminar?',
                text: "¡Esta acción no se podrá cambiar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('handleDelete', id, action)
                }
            })
        }

    </script>
@endsection
