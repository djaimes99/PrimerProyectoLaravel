@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Editar Objetivo</h1>
@stop

@section('content')
@if (@session('info'))
<div class="alert alert-success">
    <strong>{{@session('info')}}</strong>
</div>
    
@endif
<div class="card">
    <div class="card-body">
        {!! Form::model($objetivo, ['route' => ['admin.objetivos.update', $objetivo], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::label('objetivo', 'Objetivo Funcional') !!}
            {!! Form::text('objetivo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Objetivo']) !!}
        </div>
       @error('objetivo')
            <span class="text-danger">{{$message}}</span>
           
       @enderror
        {!! Form::submit('Editar Objetivo', ['class' => 'btn btn-primary']) !!}
        <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
        {!! Form::close() !!}
    </div>
</div>
@stop

