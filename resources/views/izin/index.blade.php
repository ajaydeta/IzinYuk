@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Perizinan</h1>    

@stop

@section('content')
    <div class="row mx-auto px-2">
        <div class="col-12">
            <div class="card ">
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="table">
                    <thead class="text-center">
                        <tr>
                        <th>#</th>
                        <th>ID User</th>
                        <th>Tipe Izin</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($izin as $row)
                            <tr>
                            <td class="align-middle">{{ ++$i }}</td>
                            <td class="align-middle">{{ $row->user_id }}</td>
                            <td class="align-middle">{{ $row->type_izin }}</td>
                            <td class="align-middle">{{ $row->tanggal_mulai }}</td>
                            <td class="align-middle">{{ $row->tanggal_selesai }}</td>
                            <td class="align-middle"> 
                                @if(empty($row->status_diterima))
                                    <label class="badge badge-warning">Menunggu konfirmasi</label>
                                    @else
                                            <label class="badge badge-success">{{ $row->status_diterima }}</label>
                                @endif
                            </td>
                            <td class="text-center" style="text-align: center">
                                <div class="row text-center align-middle">
                                    <a class="btn btn-sm-2 btn-primary m-2" title="Detail" href="{{ route('izin.show',$row->id) }}"><i class="fa fa-info"></i></a>
                                    @can('izin-edit')
                                        <a class="btn btn-sm-2 btn-warning m-2 text-white" title="Edit" href="{{ route('izin.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('izin-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['izin.destroy', $row->id],'style'=>'display:inline']) !!}
                                            <button type="submit" class="btn btn-sm-2 btn-danger m-2" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('izin-admit')
                                        @if(!empty($row->status_diterima))
                                            @else
                                                {!! Form::open(['method' => 'PATCH' ,'route' => ['izin.admit',$row->id]]) !!}
                                                    <button class="btn btn-sm-2 btn-success m-2" title="Approve" type="submit" name="status_diterima" value="Diterima">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                {!! Form::close() !!}
                                        @endif
                                    @endcan
                                </div>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {!! $izin->render() !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function(){
            $('#table').DataTable();
        })
    </script>
@stop
