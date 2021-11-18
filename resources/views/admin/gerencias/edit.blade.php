@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Editar Gerencia</h1>
@stop

@section('content')
@if (@session('info'))
<div class="alert alert-success">
    <strong>{{@session('info')}}</strong>
</div>
    
@endif
<div class="card">
    <div class="card-body">
        {!! Form::model($gerencia, ['route' => ['admin.gerencias.update', $gerencia], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre de la Gerencia']) !!}
        </div>
       @error('nombre')
            <span class="text-danger">{{$message}}</span>
           
       @enderror
        {!! Form::submit('Editar Gerencia', ['class' => 'btn btn-primary']) !!}
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