<div class="card shadow mb-4">
    @include('common.create')
    @include('common.alerts')

    <div class="card-body">
        <div class="table-responsive">
            @if($users->isEmpty())
                <h2>NO HAY USUARIO CREADO</h2>
                <hr>
                <a href={{route('home')}} class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
              <i class="fas fa-check"></i>
              </span>
                <span class="text">Crear</span>
                </a>
            @else
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $element)
                        <tr>
                            <td>{{$element->id}}</td>
                            <td>{{$element->name}}</td>
                            <td>{{$element->email}}</td>
                            <td>{{$element->role->name}}</td>
                            <td>{{$element->status}}</td>
                            <td style="text-align: center;">
                                @include('common.actions')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}

            @endif
        </div>
    </div>
</div>

