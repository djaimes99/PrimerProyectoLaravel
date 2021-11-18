@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Lista Metas</h1>
@stop

@section('content')
    @if (@session('info'))
        <div class="alert alert-success">
            <strong>{{ @session('info') }}</strong>
        </div>

    @endif
    <div class="card">
        <div class="card-header">

            <div class="form-group">

                @can('admin.metas.create')
                    <a class="btn btn-primary btn-sm mt-12 float-left" href="{{ route('admin.metas.create') }}">Agregar Nueva
                        Meta </a>
                @endcan
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th title="Nro Meta">Nro</th>
                        <th title="Coordinacion">Gerencia/Coordinación</th>
                        <th>Meta/Obj Func</th>
                        <th title="Fecha Inicio Y fin de la Meta">Inicio/Fin - Prog/Dem Y Nro</th>

                        <th title="Avance a la Fecha (%)">AF(%)</th>
                        <th title="Estatus Meta: Iniciado, Culminado">Estatus / Tipo</th>
                        <th colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($metas as $meta)
                        <tr>
                            <td>{{ $meta->id }}</td>
                            <td>{{ $meta->nombre }}  <br>
                            {{ $meta->nombre_coord }}</td>
                            <td>{{ $meta->meta }}/ <br>
                                {{ $meta->objetivo }}</td>
                            <td>{{ $meta->fecha_inicio }} <br>
                                {{ $meta->fecha_fin }}<br>
                                @if ($meta->meta_modo == 1)
                                {{ 'Programado' }}
                                 @else
                                {{ 'Por Demanda' }}
                                @endif
                                {{"Total:".$meta->nro_programado_demanda}}<br>/{{"Por Asig.:".$meta->nro_programado_demanda_porasignar}}
                        </td>
                            <td>{{ $meta->avance_ala_fecha }}(%)</td>
                            <td>{{$meta->estatus}}
                                @if ($meta->estatus == 1)
                                    {{ 'No Iniciado' }}
                                @elseif(($meta->estatus)== 2)
                                    {{ 'En Proceso' }}
                                @else
                                    {{ 'Culminado' }}
                                @endif
                                /
                                @if ($meta->tipo==0)
                                    {{ 'Previsto' }}
                                @elseif($meta->tipo==1)
                                    {{ 'Imprevisto' }}
                                @endif

                            </td>



                            <td width="10px">
                                @can('admin.metas.edit')
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.metas.edit', $meta) }}"
                                        title="Editar Meta"><i class="fas fa-edit fa-fw"></i></a>
                                @endcan

                            </td>
                            <td width="10px">
                                @can('admin.metas.destroy')
                                   <!-- <form action="{{ route('admin.metas.destroy', $meta) }}" method="post"
                                        class="form-eliminar">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            title="Eliminar O Inactivar Meta(Eliminado Lógico!!)"><i
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
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Esta Seguro de Eliminar el Registro?',
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
