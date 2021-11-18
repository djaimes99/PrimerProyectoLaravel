@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Lista Actividades</h1>
@stop

@section('content')
    @if (@session('info'))
        <div class="alert alert-success">
            <strong>{{ @session('info') }}</strong>
        </div>

    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.actividades.create') }}">Agregar Actividad a la
                Meta</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th title="Id">Id</th>
                        <th title="Actividad">Actividad</th>
                        <th title="Meta Nro">Meta/Coordinacion</th>
                        <th title="Estatus">Estatus / Tipo</th>


                        <th colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actividades as $actividade)
                        <tr>
                            <td>{{ $actividade->id }}</td>
                            <td>{{ $actividade->nombre_actividad }}</td>

                            <td>
                                {{ $actividade->meta }} /{{ $actividade->nombre_coord }}
                            </td>
                            <td>
                                @if ($actividade->estatus == 1)
                                    {{ 'No Iniciado' }}
                                @elseif(($actividade->estatus)==2)
                                    {{ 'En Proceso' }}
                                @elseif(($actividade->estatus)==3)
                                    {{ 'Culminado' }}
                                @endif
/  
                                @if ($actividade->tipo == 0)
                                    {{ 'Previsto' }}
                                @else
                                    {{ 'Imprevisto' }}

                                @endif
                            </td>


                            <td width="10px">
                                @can('admin.actividades.edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.actividades.edit', $actividade) }}" title="Editar Actividad"><i
                                            class="fas fa-edit fa-fw"></i></a>
                                @endcan


                            </td>
                            <td width="10px">
                                @can('admin.actividades.destroy')
                                    <!--<form action="{{ route('admin.actividades.destroy', $actividade) }}" method="post" class="form-eliminar">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                title="Eliminar O Inactivar Actividad(Eliminado Lógico!!)"><i
                                                    class="fas fa-trash fa-fw"></i></button>
                                        </form>-->
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
