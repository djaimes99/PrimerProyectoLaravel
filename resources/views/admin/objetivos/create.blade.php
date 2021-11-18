@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
<h1>Crear Nuevo Objetivo</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.objetivos.store']) !!}
        <div class="form-group">
            {!! Form::label('objetivo', 'Objetivo') !!}
            {!! Form::text('objetivo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Objetivo funcional']) !!}

            @error('objetivo')
                <span class="text-danger">{{ $message }}</span>

            @enderror

            {!! Form::label('tipo', 'Tipo Objetivo') !!}
            {!! Form::select('tipo', [0 => 'Previsto', 1 => 'Imprevisto'], 'null', ['class' => 'form-control', 'placeholder' => '<-- Seleccione -->']) !!}



        </div>

        <div id="j" style="display:none">
            {!! Form::label('observacion_just_imprevisto_obj', 'Justificación Objetivo Imprevisto:') !!}
            {!! Form::textarea('observacion_just_imprevisto_obj', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Ingrese la Justificación al Agregar Objetivo Imprevisto!!']) !!}
        </div>
        <br>

        {!! Form::submit('Crear Objetivo', ['class' => 'btn btn-primary']) !!}
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
        //alert("Entra!!");
        $("#tipo").change(function() {
            //$("#j").hide();
            var valorCambiado = $(this).val();
            //alert("valor: " + valorCambiado);

            if (valorCambiado == 0) {
                $("#j").hide();
            } else if (valorCambiado == 1) {

            alert("Atención!! en el campo (Justificación Objetivo Imprevisto) deb Registrar el motivo del porque se Agrega este Objetivo Imprevisto!!");
                $("#j").show();
            }
        });

    });
</script>
@endsection
