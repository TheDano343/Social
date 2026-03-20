 <form wire:submit="store">
        <div class="form-group">
        <label for="">Nombre</label>
        <input wire:model='Nombre' type="text" class="form-control"> 
        @error('Nombre')
       <span class="text-danger">{{$message}}</span>
       @enderror
        </div>

        <button  class="btn btn-success mt-3">Enviar</button>

    </form>
