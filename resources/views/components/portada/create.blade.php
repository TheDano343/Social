<form wire:submit="store" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Portada</label>
        <input wire:model='Imagen' type="file" class="form-control">
        @error('Imagen')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <button class="btn btn-success mt-3">Enviar</button>

</form>