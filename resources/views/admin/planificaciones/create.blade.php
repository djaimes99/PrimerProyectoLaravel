@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
<h1>Crear Nueva Programación a la Meta</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.planificaciones.store']) !!}
        <div class="form-group">
           
          
             <label for="">Meta Correspondiente</label>
             <select class="form-control" name="id_meta" id="id_meta">
                 <option value=""><--Seleccione--></option>
                 @foreach ($metas as $item)
                 <option value="{{$item->id}}">{{$item->meta." /  Falta Por Asignar=> ".$item->nro_programado_demanda_porasignar}}</option>  
                 @endforeach
           
             </select>
          
        
        @error('id_meta')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
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
            {!! Form::label('asignado', 'Asignado:') !!}
            {!! Form::text('asignado', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Indicar la Cantidad Asignar (Nros)!!']) !!}
            @error('asignado')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <br>
            {!! Form::label('observacion', 'Observación:') !!}
            {!! Form::text('observacion', 'Sin Observación?', ['class' => 'form-control', 'placeholder' => 'Ingrese Observacion']) !!}
            @error('observacion')
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
                    "Atención!! en el campo (Justificación Actividad Imprevista), debe Registrar el motivo del porque se Agrega esa Actividad Imprevista!!"
                );
                $("#j").show();
            }
        });
    });
</script>
@endsection
