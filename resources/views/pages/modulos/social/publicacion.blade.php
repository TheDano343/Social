<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Publicacion;
use App\Models\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;


    #[Rule('required')]
    public $Descripcion;

    #[Rule('required|image|max:1024')]
    public $Imagen;

    public $users_id;
    public $edit_mode=false;
    // public $publicaciones;
    public $publicacion_Id;

    public $porPagina = 6;

    public function loadMore()
    {
        $this->porPagina += 6; // Aumenta el límite
    }


    public function store()
    {
        $this->validate();

        Publicacion::create([
            'Descripcion' => $this->Descripcion,
            'Imagen' => $this->Imagen ? $this->Imagen->store('upload', 'public') : null,
            'users_id' => auth()->id(),
        ]);

        session()->flash('success','Post publicado');
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $publicacion = Publicacion::find($id);
        $this->authorize('update', $publicacion);

        $this->edit_mode = true;
        $this->Descripcion = $publicacion->Descripcion;
        $this->Imagen = $publicacion->Imagen;
        $this->publicacion_Id = $id;
    }

    public function update()
    {
        $publicacion = Publicacion::find($this->publicacion_Id);

        $this->authorize('update', $publicacion);

        $publicacion->update([
            'Descripcion' => $this-> Descripcion,
            'Imagen' => $this->Imagen->store('upload', 'public')
        ]);

        session()->flash('update','Post actualizado');
        $this->resetInputFields();
        $this->edit_mode = false;
    }

    public function resetInputFields()
    {
        $this->Descripcion = '';
        $this->Imagen = '';

    }

    public function cancelUpdate()
    {
        $this->edit_mode=false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $publicacion = Publicacion::find($id);
        $publicacion->delete();
        session()->flash('destroy','Post eliminado');
    }

    public function visualizar(Publicacion $publicacion)
    {
        $publicacion = Publicacion::all(); 
        return view('publicacion.edit', compact('publicacion'));
    }

    public function render()
    {
        return view('pages.modulos.social.publicacion', [
            'publicaciones' =>  Publicacion::latest()->take($this->porPagina)->get(),
        ]);
    }
}
?>



<div class="container">

    

    <div>
        <div id="mensaje-exito" class="container">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
        </div>

        <div id="mensaje-editado" class="container">
            @if(session()->has('update'))
            <div class="alert alert-primary">
                {{session('update')}}
            </div>
            @endif
        </div>

        <div id="mensaje-eliminado" class="container">
            @if(session()->has('destroy'))
            <div class="alert alert-danger">
                {{session('destroy')}}
            </div>
            @endif
        </div>

        @if($edit_mode)
        @include('pages.modulos.social.edit')
        @else
        @include('pages.modulos.social.create')
        @endif

        <div class="row row-gap-3 justify-content-center mt-4">
            @foreach($publicaciones as $publicacion)

            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{$publicacion->Users->name}}</h5>
                        <div class="btn-group">
                            <button class="btn btn-light btn-sm float-right" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                ...
                            </button>
                            <ul class="dropdown-menu">
                                @can('update',$publicacion)

                                <li><a class="dropdown-item"
                                        wire:click="edit({{$publicacion->IdPublicacion}})">Editar</a></li>
                                @endcan

                                @can('delete',$publicacion)
                                <li><a class="dropdown-item"
                                        wire:click="delete({{$publicacion->IdPublicacion}})">Eliminar</a></li>
                                @endcan


                            </ul>
                        </div>


                    </div>

                    <p class="card-text">{{$publicacion->Descripcion}}</p>
                    <p class="card-text"><small
                            class="text-muted">{{$publicacion->created_at->diffForHumans(['locale'=>'es']) }}</small>
                    </p>
                </div>
                <div class="p-4">
                    <img src="{{asset('storage/'.$publicacion->Imagen)}}" class="card-img-bottom" alt="image">
                </div>
            </div>

            @endforeach
            
        </div>

        <div wire:intersect="loadMore" class="p-4 text-center">
            <span wire:loading>Cargando Mas Publicaciones</span>
        </div>

    </div>
</div>