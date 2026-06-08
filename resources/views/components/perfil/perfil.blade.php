<?php

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

use App\Models\PerfilFoto;

new class extends Component
{
    use WithFileUploads;

    #[Rule('required|image|max:1024')]
    public $Imagen;

    public $perfiles;
    public $portadas;

    public $edit_mode=false;


    public function render()
    {
        $this->perfiles = PerfilFoto::where('users_id', Auth::id())
                                     ->latest()
                                     ->first();
        return view('components.perfil.perfil');
    }

    public function resetInputFields()
    {
        $this->Imagen = '';
    }

    public function store()
    {
        $this->validate();

        PerfilFoto::create([
            'Imagen' => $this->Imagen ? $this->Imagen->store('upload', 'public') : null,
            'users_id' => auth()->id(),
        ]);

        session()->flash('success','Foto de perfil creada');
        $this->resetInputFields(); 
    }
};
?>

<div>
    <label style="cursor:pointer;">

        <div>
        @if($perfiles)
        <img src="{{asset('storage/'.$perfiles->Imagen)}}" class="rounded w-25 img-fluid">
        @else
        <p>
            No Hay imagen
        </p>
        @endif

    @if($edit_mode)
        @include('components.perfil.edit')
        @else
        @include('components.perfil.create')
        @endif
    </div>
    
    </label>
    
</div>