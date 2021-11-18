@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Asignar un rol</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!} 
            {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usario']) !!}
            @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    
                @enderror
            <p class="h5">Coordinación Correspondiente:</p>
            {!! Form::select('id_coordinacion', $coordinaciones, null, ['class' => 'form-control', 'placeholder' => 'Debe Seleccionar Una Coordinación Correspondiente!!']) !!}
            @error('id_coordinacion')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    
                @enderror
            <br>
            <h2 class="h5">Listado de roles</h2>
            @foreach ($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{ $role->name }}
                    </label>
                </div>

            @endforeach
            {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop
