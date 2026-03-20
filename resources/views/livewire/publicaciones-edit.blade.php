    <form wire:submit="update">
        <div class="form-group">
        <label for="">Nombre</label>
        <input wire:model='Nombre' type="text" class="form-control"> 
        @error('Nombre')
       <span class="text-danger">{{$message}}</span>
       @enderror

       <label for="">Imagen</label>
        <input wire:model='Imagen' type="file" class="form-control">
        @error('Imagen')
        <span class="text-danger">{{$message}}</span>
        
        @enderror
        </div>


        <button class="btn btn-success mt-3">Actualizar</button>
        <button wire:click.prevent="cancelUpdate()" class="btn btn-success mt-3">Cancelar</button>

    </form>
