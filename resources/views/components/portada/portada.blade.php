<?php

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

use App\Models\PortadaFoto;

new class extends Component
{
    use WithFileUploads;

    #[Rule('required|image|max:1024')]
    public $Imagen;

    public $portadas;
    public $edit_mode=false;


    public function render()
    {
        $this->portadas = PortadaFoto::where('users_id', Auth::id())
                                     ->latest()
                                     ->first();
        return view('components.portada.portada');
    }

    public function resetInputFields()
    {
        $this->Imagen = '';
    }

    public function store()
    {
        $this->validate();

        PortadaFoto::create([
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
        @if($portadas)
        <img src="{{asset('storage/'.$portadas->Imagen)}}" class="img-fluid w-50 d-block mx-auto">
        @else
        <p>
            No Hay imagen
        </p>
        @endif
        
        @if($edit_mode)
        @include('components.portada.edit')
        @else
        @include('components.portada.create')
        @endif

    </div>

    </label>

    
</div>