@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Crear Nueva Coordinación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.coordinaciones.store']) !!}
            <div class="form-group">
                {!! Form::label('nombre_coord', 'Nombre Coordinación:') !!}
                {!! Form::text('nombre_coord', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre de la Coordinación']) !!}
            </div>
            @error('nombre_coord')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::label('id_gerencia', 'Gerencia Correspondiente:') !!}
            {!! Form::select('id_gerencia', $gerencias, null, ['class' => 'form-control', 'placeholder' => 'Debe Seleccionar Una Gerencia Correspondiente!!']) !!}
            @error('id_gerencia')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::submit('Crear Coordinación', ['class' => 'btn btn-primary']) !!}
            <a href="{{ url()->previous() }}" class="btn btn-default">Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@endsection
