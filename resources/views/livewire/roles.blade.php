<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif

    @if($edit_mode)
    @include('livewire.roles-edit')
    @else
    @include('livewire.roles-create')
    @endif


    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Accion</th>
            </tr>
        </thead>
        @foreach($roles as $rol)
        <tr>
            <td>{{$rol->IdRol}}</td>
            <td>{{$rol->Nombre}}</td>
            <th>
                <button wire:click="edit({{$rol->IdRol}})"  class="btn btn-primary btn-sm" >Editar</button>

                <button wire:click="delete({{$rol->IdRol}})" class="btn btn-danger btn-sm">Eliminar</button>
            </th>

            @endforeach
            </tbody>

    </table>
</div>