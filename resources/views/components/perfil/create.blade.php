<form wire:submit="store" enctype="multipart/form-data">
    <div class="form-group">
        <label class="d-none">Perfil</label>
        <input wire:model='Imagen' type="file" class="form-control d-none">
        @error('Imagen')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <button class="btn btn-success mt-3">Enviar foto de perfil</button>

</form>