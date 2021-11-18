@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
<h1>Listar Objetivos funcionales</h1>
@stop

@section('content')
@if (@session('info'))
    <div class="alert alert-success">
        <strong>{{ @session('info') }}</strong>
    </div>

@endif
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.objetivos.create') }}">Agregar Objetivo Funcional </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="objetivo">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo/Estatus</th>
                    <th title="Avance Objetivo(%)">AO(%)</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($objetivos as $objetivo)
                    <tr>
                        <td>{{ $objetivo->id }}</td>
                        <td>{{ $objetivo->objetivo }}</td>
                        <td>
                            @if ($objetivo->tipo == 0)
                                {{ 'Previsto' }}
                            @elseif(($objetivo->tipo)==1)
                                {{ 'Imprevisto' }}

                            @endif/
                            <br>
                            @if ($objetivo->estatus == 1)
                                {{ 'No Iniciado' }}
                            @elseif(($objetivo->estatus)==2)
                                {{ 'En Proceso' }}
                            @elseif(($objetivo->estatus)==3)
                                {{ 'Culminado' }}

                            @endif


                        </td>
                        <td>
                            {{ $objetivo->avance_obj }}(%)
                        </td>
                        <td width="10px">
                            @can('admin.objetivos.edit')
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.objetivos.edit', $objetivo) }}">Editar</a>
                            @endcan
                        </td>
                        <td width="10px">
                            @can('admin.metas.destroy')
                               <!-- <form action="{{ route('admin.objetivos.destroy', $objetivo) }}" method="post"
                                    class="form-eliminar">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            -->
                                @endcan
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>
@stop

@section('css')
<!--datatables-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('.form-eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro de eliminar el Registro?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.value) {
                /*Swal.fire(
                    'Eliminado!',
                    'El registro Has sido Eliminado!',
                    'success'
                )*/
                this.submit();
            }
        })
    });
</script>

@endsection
