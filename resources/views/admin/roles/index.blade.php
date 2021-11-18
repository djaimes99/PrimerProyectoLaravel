@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Lista De roles</h1>
@stop

@section('content')
@if (@session('info'))
<div class="alert alert-success">
    <strong>{{ @session('info') }}</strong>
</div>

@endif
    <div class="card">
        <div class="card-header">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.create') }}">Agregar Nuevo Rol </a>  
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    
                        <th>ID</th>
                        <th>Role</th>
                        <th colspan="2"></th>
                   

                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td width="10px"> 
                                <a href="{{route('admin.roles.edit', $role)}}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{route('admin.roles.destroy', $role)}}" method="POST" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
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
