@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
<h1>Editar Actividad</h1>
@stop

@section('content')
@if (@session('info'))
    <div class="alert alert-success">
        <strong>{{ @session('info') }}</strong>
    </div>

@endif
<div class="card">
    <div class="card-body">
        {!! Form::model($actividade, ['route' => ['admin.actividades.update', $actividade], 'method' => 'put']) !!}
        <div class="form-group">
            {!! Form::label('nombre_actividad', 'Nombre Actividad:') !!}
            {!! Form::text('nombre_actividad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre de la Actividad']) !!}
        </div>
        @error('nombre_actividad')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        {!! Form::label('id_meta', 'Meta Corresponde:') !!}
        {!! Form::select('id_meta', $metas, null, ['class' => 'form-control', 'placeholder' => 'Debe Seleccionar La Meta que Correspondiente!!']) !!}
        @error('id_meta')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        {!! Form::label('estatus', 'Estatus:') !!}
        {!! Form::select('estatus', $estatus, null, ['class' => 'form-control', 'placeholder' => '<-- Seleccione -->']) !!}


        @error('estatus')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <div id="j" style="display:none">
            {!! Form::label('fecha_estim_final', 'Fecha Estimada Finalización:') !!}
            {!! Form::text('fecha_estim_final', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha estimada Culminación Actividad!!', 'readonly']) !!}
        </div>
        <br>
        {!! Form::submit('Editar Actividad', ['class' => 'btn btn-primary']) !!}
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
<script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $("#estatus").change(function() {

            var valorCambiado = $(this).val();

            //alert(valorCambiado);
            if (valorCambiado == 1) { //estatus No iniciado
                $("#j").hide();
            } else if (valorCambiado ==
                2) { //estatus En Proceso, se debe seleccionar una posible fecha culminación
                if ($("#fecha_estim_final").val() == "") {
                    alert(
                        "Atención!! Debe seleccionar del calendario..La fecha estimada de culminación de esta actividad!!"
                    );
                    $("#j").show();
                }
            } else {
                $("#j").hide(); //estatus culminado, guardar fecha actual (actividad culminada)
            }
        });
    });

    $('#fecha_estim_final').datepicker({
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
