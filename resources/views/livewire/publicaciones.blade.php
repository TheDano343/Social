<div>
  @if (session()->has('message'))
  <div class="alert alert-success">
    {{session('message')}}
  </div>
  @endif

  @if($edit_mode)
  @include('livewire.publicaciones-edit')
  @else
  @include('livewire.publicaciones-create')
  @endif

  <div class="row row-gap-3 justify-content-center mt-4">
    @foreach($publicaciones as $publicacion)
  
    <div class="card">
      <h5 class="card-title">{{$publicacion->Users->name}}</h5>
      <div class="card-body">

        <p class="card-text">{{$publicacion->Descripcion}}</p>
        <p class="card-text"><small class="text-muted">{{$publicacion->created_at}}</small></p>
      </div>
      <img src="{{asset('storage/'.$publicacion->Imagen)}}" class="card-img-bottom" alt="image">
      <button wire:click="edit({{$publicacion->IdPublicacion}})" class="btn btn-primary btn-sm">Editar</button>

      <button wire:click="delete({{$publicacion->IdPublicacion}})" class="btn btn-danger btn-sm">Eliminar</button>
    </div>

    @endforeach
  </div>

</div>