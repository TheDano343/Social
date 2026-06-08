<form wire:submit="store" enctype="multipart/form-data">
    <div class="form-group">
        <label class="d-none">Portada</label>
        <input wire:model='Imagen' type="file" class="form-control d-none">
        @error('Imagen')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
    <button class="btn btn-success mt-3 position-absolute">Enviar Foto de Portada</button>
    </div>

</form>