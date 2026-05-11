@extends('layouts.admin')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Editar usuario
                            <a class="btn btn-danger float-end" href="{{url('user')}}">Regresar</a>
                        </h4>

                    </div>

                    <div class="card-body">
                        <form action="{{route('user.update', ['user'=>$user])}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label>Nombre de usuario</label>
                                <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}">
                            </div>

                            <div class="mb-3">
                                <label>Correo Electronico</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{old('email',$user->email)}}">
                            </div>

                            <button class="btn btn-primary" type="submit">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
</body>

</html>