@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Editar Coordinación</h1>
@stop

@section('content')
@if (@session('info'))
<div class="alert alert-success">
    <strong>{{@session('info')}}</strong>
</div>
    
@endif
<div class="card">
    <div class="card-body">
        {!! Form::model($coordinacione, ['route' => ['admin.coordinaciones.update', $coordinacione], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::label('nombre_coord', 'Nombre Coordinación') !!}
            {!! Form::text('nombre_coord', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre de la Coordinación']) !!}
        </div>
       @error('nombre_coord')
            <span class="text-danger">{{$message}}</span>
           
       @enderror
        {!! Form::submit('Editar Coordinación', ['class' => 'btn btn-primary']) !!}
        <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop