@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
<h1>Crear Nueva Meta</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.metas.store']) !!}
        <div class="form-group">
            {!! Form::label('id_objetivo', 'Objetivo Funcional:') !!}
            {!! Form::select('id_objetivo', $objetivos, null, ['class' => 'form-control', 'placeholder' => 'Debe Seleccionar Un Objetivo Funcional!!']) !!}

            @error('id_objetivo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::label('meta', 'Meta:') !!}
            {!! Form::text('meta', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre de la Meta']) !!}
            @error('meta')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            {!! Form::label('iniciativa', 'Iniciativa:') !!}
            {!! Form::text('iniciativa', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Iniciativa']) !!}
            {!! Form::label('supuesto', 'Supuesto:') !!}
            {!! Form::text('supuesto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Supuesto']) !!}
            {!! Form::label('indicadores', 'Indicadores:') !!}
            {!! Form::text('indicadores', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el ó los Indicadores']) !!}
            {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
            {!! Form::text('fecha_inicio', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Inicio', 'readonly']) !!}
            @error('fecha_inicio')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::label('fecha_fin', 'Fecha Fin:') !!}
            {!! Form::text('fecha_fin', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Fin', 'readonly']) !!}
            @error('fecha_fin')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::label('meta_modo', 'Meta Modo:') !!}
            {!! Form::select('meta_modo', [1 => 'Programado', 2 => 'Por Demanda'], 'null', ['class' => 'form-control', 'placeholder' => '<-- Seleccione -->']) !!}
            @error('meta_modo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::label('nro_programado_demanda', 'Nro Programado ó Por demanda:') !!}
            {!! Form::text('nro_programado_demanda', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Programado, o por demanda (en Numero)']) !!}
            @error('nro_programado_demanda')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <br>
            {!! Form::label('explicacion_prog_dem', 'Explicacion Programación / Demanda (concepto):') !!}
            {!! Form::text('explicacion_prog_dem', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Explicacion Programación / Demanda (concepto: Informe, reunion u otro..)']) !!}
            @error('explicacion_prog_dem')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::label('ejecutado', 'Ejecutado:') !!}
            {!! Form::text('ejecutado', 0, ['class' => 'form-control', 'placeholder' => 'Ingrese Ejecutado, (en Numero)']) !!}
            @error('ejecutado')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <br>
            {!! Form::label('nro_pto_cta_aprob_poai', 'Nro Aprob. POAI:') !!}
            {!! Form::text('nro_pto_cta_aprob_poai', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Nro Pto Cta. Aprob. POAI']) !!}

            <br>
            {!! Form::label('tipo', 'Tipo Objetivo') !!}
            {!! Form::select('tipo', [0 => 'Previsto', 1 => 'Imprevisto'], 'null', ['class' => 'form-control', 'placeholder' => '<-- Seleccione -->']) !!}
            @error('tipo')
                <span class="text-danger">{{ $message }}</span>
            @enderror



        </div>
        <div id="j" style="display:none">
            {!! Form::label('observacion_just_imprevisto_meta', 'Justificación Meta Imprevista:') !!}
            {!! Form::textarea('observacion_just_imprevisto_meta', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Ingrese la Justificación al Agregar Meta Imprevista!!']) !!}
        </div>
        <br>

        {!! Form::submit('Crear Meta', ['class' => 'btn btn-primary']) !!}

        <a href="{{ url()->previous() }}" class="btn btn-default">Cancel</a>

        {!! Form::close() !!}
    </div>
</div>
@stop


@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@stop

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

    $(document).ready(function() {

        $("#tipo").change(function() {

            var valorCambiado = $(this).val();
            if (valorCambiado == 0) {
                $("#j").hide();
            } else if (valorCambiado == 1) {
                alert(
                    "Atención!! en el campo (Justificación Meta Imprevista), debe Registrar el motivo del porque se Agrega esa Meta Imprevista!!");
                $("#j").show();
            }
        });

    });
</script>


@stop
