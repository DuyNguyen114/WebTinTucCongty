@extends('back.templates.master')

@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection 

@section('title', 'Quản lý mail khuyến mãi')

@section('sale', 'active')

@section('content')

<?php use App\Models\Role; ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        
    </head>
    <body>
        <h1>Mail khuyến mãi</h1>
        <a class="btn btn-block btn-primary ad_add" href="{{ url('/admin/newletters/add') }}">Thêm</a>
        <table id="table_id" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="text-align:center">STT</th>
                    <th style="text-align:center">Email</th>
                    <th style="text-align:center">Trạng thái</th>
                    <th style="text-align:center"><i class="fa fa-wrench" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($newletters) && count($newletters) > 0)
                    @foreach($newletters as $key => $newletter)
                    <tr>
                        <td style="text-align:center">{{ $key + 1 }}</td>
                        <td style="text-align:center">{{ $newletter->email }}</td>
                        <td style="text-align:center">
                            @if( $newletter->seen == 1)
                                <span style="color: green">Đã xem</span>
                            @else
                                <span style="color: red">Chưa xem</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-block btn-primary ad_button_edit" href="{{ url('/admin/newletters/edit/'.$newletter->id) }}" title="Chỉnh sửa">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-block btn-primary ad_button_delete" href="{{ url('/admin/newletters/delete/'.$newletter->id) }}" title="Xóa">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </body>
    </html>
@endsection

@push('scripts')
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endpush