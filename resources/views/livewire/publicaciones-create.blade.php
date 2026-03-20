<form wire:submit="store">
    <div class="form-group">
        <label for="">Nombre</label>
        <input wire:model='Descripcion' type="text" class="form-control">
        @error('Descripcion')
        <span class="text-danger">{{$message}}</span>
        @enderror

        <label for="">Imagen</label>
        <input wire:model='Imagen' type="file" class="form-control">
        @error('Imagen')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <button class="btn btn-success mt-3">Enviar</button>

</form>