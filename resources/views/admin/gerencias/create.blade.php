@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Crear Nueva gerencia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.gerencias.store']) !!}
            <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre de la Gerencia']) !!}
            </div>
           @error('nombre')
                <span class="text-danger">{{$message}}</span>
               
           @enderror
            {!! Form::submit('Crear Gerencia', ['class' => 'btn btn-primary']) !!}
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
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
