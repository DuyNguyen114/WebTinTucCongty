@extends('back.templates.master')

@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection 

@section('title', 'Quản lý mạng xã hội')

@section('social', 'active')

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
        <a class="btn btn-block btn-primary ad_add" href="{{ url('/admin/staff/add') }}" style="margin-bottom: 20px;">Thêm</a>
        <table id="table_id" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên mạng xã hội</th>
                    <th>Font</th>
                    <th>Trạng thái</th>
                    <th>Sắp xếp</th>
                    <th><i class="fa fa-wrench" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($social) && count($social) > 0)
                    @foreach($social as $key => $social)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $social->name }}</td>
                        <td>{{ $social->font }}</td>
                        <td style="text-align:center">
                            @if( $social->status == 1)
                                Bật
                            @else
                                Tắt
                            @endif
                        </td>
                        <td style="text-align:center">{{ $social->sort }}</td>
                        <td>
                            <a class="btn btn-block btn-primary ad_button_edit" href="{{ url('/admin/social/edit/'.$social->id) }}" title="Chỉnh sửa">
                                <i class="fa fa-cog" aria-hidden="true"></i>
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