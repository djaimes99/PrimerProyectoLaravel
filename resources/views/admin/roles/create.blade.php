@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Crear nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}
                @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    
                @enderror
            </div>

            <h2 class="h3">Lista de permisos</h2>
            @foreach ($permissions as $permission)
            <div>
                <label>
                    {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                    {{$permission->description}}
                </label>
            </div>
                
            @endforeach
            {!! Form::submit('Crear Rol', ['class'=> 'btn btn-primary']) !!}
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop

