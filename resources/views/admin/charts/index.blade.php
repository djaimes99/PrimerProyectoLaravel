@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')

    <h1>Busque y Filtre Metas:</h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {!! Form::open(['route' => 'admin.charts.barchart', 'method' => 'get']) !!}
            <div class="form-group">
                <br>
                {!! Form::label('id_gerencia', 'Por Gerencia:') !!}
                {!! Form::select('id_gerencia', $gerencias, null, ['class' => 'form-control', 'placeholder' => 'Debe Seleccionar Una Gerencia Correspondiente!!']) !!}

                {!! Form::label('id_coordinacion', 'Por Coordinación:') !!}
                {!! Form::select('id_coordinacion', $coordinaciones, null, ['class' => 'form-control', 'placeholder' => 'Debe Seleccionar Una Coordinación Correspondiente!!']) !!}

                {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
                {!! Form::text('fecha_inicio', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Inicio', 'readonly']) !!}

                {!! Form::label('fecha_fin', 'Fecha Fin:') !!}
                {!! Form::text('fecha_fin', null, ['class' => 'form-control','size'=>20, 'placeholder' => 'Ingrese Fecha Fin', 'readonly']) !!}

               
            </div>
            {!! Form::submit('Filtrar y graficar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop
@section('css')

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection

@section('js')

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('#fecha_inicio').datepicker({
            numberOfMonths: 1,
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            //minDate: new Date(2010,0,1),
            //altFormat: "yy-mm-dd",
            showButtonPanel: true
        });

        $('#fecha_fin').datepicker({
            numberOfMonths: 1,
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            //minDate: new Date(2010,0,1),
            //altFormat: "yy-mm-dd",
            showButtonPanel: true
        });
    </script>

@endsection
