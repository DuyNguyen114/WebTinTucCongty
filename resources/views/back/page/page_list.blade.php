@extends('back.templates.master')

@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection 

@section('title', 'Quản lý trang')

@section('page', 'active')

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
                    <th style="text-align:center">STT</th>
                    <th style="text-align:center">Tên trang</th>
                    <th style="text-align:center">Font</th>
                    <th style="text-align:center">Trạng thái</th>
                    <th style="text-align:center">Sắp xếp</th>
                    <th style="text-align:center"><i class="fa fa-wrench" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($page) && count($page) > 0)
                    @foreach($page as $key => $page)
                    <tr>
                        <td style="text-align:center">{{ $key + 1 }}</td>
                        <td style="text-align:center">{{ $page->name }}</td>
                        <td style="text-align:center">{{ $page->font }}</td>
                        <td style="text-align:center">
                            @if( $page->status == 1)
                                Bật
                            @else
                                Tắt
                            @endif
                        </td>
                        <td style="text-align:center">{{ $page->sort }}</td>
                        <td style="text-align:center">
                            <a class="btn btn-block btn-primary ad_button_edit" href="{{ url('/admin/page/edit/'.$page->id) }}" title="Chỉnh sửa">
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