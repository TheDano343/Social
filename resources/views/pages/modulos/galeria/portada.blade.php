<?php

use Livewire\Component;
use App\Models\PortadaFoto;

new class extends Component
{
    public $porPagina = 6;

    public function loadMore()
    {
        $this->porPagina += 6; // Aumenta el límite
    }

    public function render()
    {
        return view('pages.modulos.galeria.portada', [
            'portadas' =>  PortadaFoto::latest()->take($this->porPagina)->get(),
        ]);

    }
};
?>

<div class="container mt-4">

    <div class="row g-3">
    @foreach($portadas as $portada)
    <div class="col-sm-6 col-md-4 -center">
        <img src="{{asset('storage/'.$portada->Imagen)}}" class="card-img-top">
    </div>
    @endforeach
    </div>

    <div wire:intersect="loadMore" class="p-4 text-center">
            <span wire:loading>Cargando Mas Imagenes</span>
    </div>

    @vite(['resources/css/imagenes.css'])

</div>

