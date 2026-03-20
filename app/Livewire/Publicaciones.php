<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Publicacion;
use App\Models\User;
use Livewire\Attributes\Rule;

class Publicaciones extends Component
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

        session()->flash('message','Post publicado');
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

        session()->flash('message','Post actualizado');
        $this->resetInputFields();
        $this->edit_mode = false;
    }

    public function resetInputFields()
    {
        $this->Descripcion = '';
        $this->Imagen = '';

    }

    public function delete($id)
    {
        $publicacion = Publicacion::find($id);
        $publicacion->delete();
        session()->flash('message','Post eliminado');
    }

    public function render()
    {
        $this->usuarios = User::all();
        $this->publicaciones = Publicacion::all();
        return view('livewire.publicaciones');
    }
}
