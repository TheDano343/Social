<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Rol;

class Roles extends Component
{
    #[Rule('required')]
    public $Nombre;
    public $roles;
    public $edit_mode=false;
    public $rol_id;

    public function store()
    {
        $this->validate();
        Rol::create([
            'Nombre' => $this->Nombre,
        ]);

        session()->flash('message','Rol publicado');
         $this->resetInputFields(); 
    }

    public function resetInputFields()
    {
        $this->Nombre = '';
    }

    public function edit($id)
    {
        $this->edit_mode = true;
        $rol = Rol::find($id);
        $this->Nombre = $rol->Nombre;
        $this->rol_id = $id;
    }

    public function update()
    {
        $validated_data = $this->validate([
            'Nombre' => 'required'
        ]);

        $rol = Rol::find($this->rol_id);
        $rol->update($validated_data);

        session()->flash('message','Rol Actualizado');
        $this->resetInputFields(); 
        $this->edit_mode = false;
    }

    public function cancelUpdate()
    {
        $this->edit_mode=false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $rol = Rol::find($id);
        $rol->delete();
        session()->flash('message','Post eliminado');
    }

    public function render()
    {
        $this->roles = Rol::all();
        return view('livewire.roles');
    }

}
