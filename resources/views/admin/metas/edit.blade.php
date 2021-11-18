@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Editar Meta</h1>
@stop

@section('content')
    @if (@session('info'))
        <div class="alert alert-success">
            <strong>{{ @session('info') }}</strong>
        </div>

    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($meta, ['route' => ['admin.metas.update', $meta], 'method' => 'put']) !!}

            <div class="form-group">
              <!--  {!! Form::label('id_objetivo', 'Objetivo Funcional:') !!}
                {!! Form::select('id_objetivo', $objetivos, null, ['class' => 'form-control', 'readonly','placeholder' => 'Debe Seleccionar Un Objetivo Funcional!!']) !!}
                @error('id_objetivo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>-->
                {!! Form::label('meta', 'Meta:') !!}
                {!! Form::text('meta', null, ['class' => 'form-control','readonly', 'placeholder' => 'Ingrese el Nombre de la Meta']) !!}
                @error('meta')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>

                {!! Form::label('iniciativa', 'Iniciativa:') !!}
                {!! Form::text('iniciativa', null, ['class' => 'form-control','readonly', 'placeholder' => 'Ingrese Iniciativa']) !!}
                {!! Form::label('supuesto', 'Supuesto:') !!}
                {!! Form::text('supuesto', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'Ingrese Supuesto']) !!}
                {!! Form::label('indicadores', 'Indicadores:') !!}
                {!! Form::text('indicadores', null, ['class' => 'form-control', 'readonly','placeholder' => 'Ingrese el ó los Indicadores']) !!}
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
                
                    {!! Form::label('nro_programado_demanda', 'Nro Programado ó Por demanda:') !!}
                    {!! Form::text('nro_programado_demanda', null, ['class' => 'form-control', 'readonly','placeholder' => 'Ingrese Programado, (en Numero)']) !!}
                    @error('programado')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                

                <br>
                {!! Form::label('ejecutado', 'Ejecutado:') !!}
                {!! Form::text('ejecutado', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Ejecutado, (en Numero)']) !!}
                @error('ejecutado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


                <br>
                {!! Form::label('nro_pto_cta_aprob_poai', 'Nro Aprob. POAI:') !!}
                {!! Form::text('nro_pto_cta_aprob_poai', null, ['class' => 'form-control','readonly', 'placeholder' => 'Ingrese Nro Pto Cta. Aprob. POAI']) !!}
                {!! Form::label('obs_avance_obstaculo', 'Observación Avance, Obstaculo, Avance Extra :') !!}
                {!! Form::textarea('obs_avance_obstaculo', null, ['rows' => 2, 'cols' => 75, 'class' => 'form-control', 'placeholder' => 'Describa (SI Hubo..), Observación de Avance Extra ']) !!}


            </div>
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>

            @enderror
            {!! Form::submit('Editar Meta', ['class' => 'btn btn-primary']) !!}
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
        $('#fecha_inicio1').datepicker({
            numberOfMonths: 1,
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            //minDate: new Date(2010,0,1),
            altFormat: "yy-mm-dd",
            showButtonPanel: true
        });
        $('#fecha_fin1').datepicker({
            numberOfMonths: 1,
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            //minDate: new Date(2010,0,1),
            altFormat: "yy-mm-dd",
            showButtonPanel: true
        });
    </script>


@stop
