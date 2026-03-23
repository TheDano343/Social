<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Publicacion;
use App\Models\User;
use Livewire\Attributes\Rule;

new class extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $Descripcion;

    #[Rule('image')]
    public $Imagen;

    public $users_id;
    public $edit_mode=false;
    public $publicaciones;
    public $publicacion_Id;


    public function store()
    {
        $this->validate();

        Publicacion::create([
            'Descripcion' => $this->Descripcion,
            'Imagen' => $this->Imagen->store('upload', 'public'),
            'users_id' => auth()->id(),
        ]);

        session()->flash('success','Post publicado');
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $this->edit_mode = true;
        $publicacion = Publicacion::find($id);
        $this->Descripcion = $publicacion->Descripcion;
        $this->Imagen = $publicacion->Imagen;
        $this->publicacion_Id = $id;
    }

    public function update()
    {
        $publicacion = Publicacion::find($this->publicacion_Id);

        $publicacion->update([
            'Descripcion' => $this-> Descripcion,
            'Imagen' => $this->Imagen->store('upload', 'public'),
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

    public function render()
    {
        $this->usuarios = User::all();
        $this->publicaciones = Publicacion::all();
        return view('pages.modulos.social.publicacion');
    }
    
};
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
                                <li><a class="dropdown-item" wire:click="edit({{$publicacion->IdPublicacion}})">Editar</a></li>
                                <li><a class="dropdown-item" wire:click="delete({{$publicacion->IdPublicacion}})">Eliminar</a></li>
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

    </div>
</div>
