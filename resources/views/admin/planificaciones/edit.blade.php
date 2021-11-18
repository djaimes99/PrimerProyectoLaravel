@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
<h1>Editar Programación de la Meta</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($planificacione, ['route' => ['admin.planificaciones.update', $planificacione], 'method' => 'put']) !!}
        <div class="form-group">
           
          
        <br>
        
            {!! Form::label('fecha_realCulm', 'Fecha Real Final:') !!}
            {!! Form::text('fecha_realCulm', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Fecha Fin', 'readonly']) !!}
            @error('fecha_realCulm')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            {!! Form::label('asignado', 'Asignado:') !!}
            {!! Form::text('asignado', null, ['class' => 'form-control','readonly', 'placeholder' => 'Ingrese Indicar la Cantidad Asignar (Nros)!!']) !!}
            @error('asignado')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <br>
            
        </div>
        {!! Form::submit('Crear Programación de la Meta', ['class' => 'btn btn-primary']) !!}
        <a href="{{ url()->previous() }}" class="btn btn-default">Cancel</a>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@stop

@section('js')
<script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    $('#fecha_realCulm').datepicker({
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
                    "Atención!! en el campo (Justificación Actividad Imprevista), debe Registrar el motivo del porque se Agrega esa Actividad Imprevista!!"
                );
                $("#j").show();
            }
        });
    });
</script>
@endsection
