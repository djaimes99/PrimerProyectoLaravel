@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
<h1>Crear Nueva Actividad</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.actividades.store']) !!}
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
        {!! Form::label('tipo', 'Tipo Actividad') !!}
        {!! Form::select('tipo', [0 => 'Previsto', 1 => 'Imprevisto'], 'null', ['class' => 'form-control', 'placeholder' => '<-- Seleccione -->']) !!}
        @error('tipo')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <div id="j" style="display:none">
            {!! Form::label('observacion_just_imprevisto_act', 'Justificación Actividad Imprevista:') !!}
            {!! Form::textarea('observacion_just_imprevisto_act', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Ingrese la Justificación al Agregar Actividad Imprevista!!']) !!}
        </div>
        <br>
        {!! Form::submit('Crear Actividad', ['class' => 'btn btn-primary']) !!}
        <a href="{{ url()->previous() }}" class="btn btn-default">Cancel</a>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('js')
<script src="{{ asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
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
