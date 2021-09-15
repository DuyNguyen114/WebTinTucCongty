@extends('back.templates.master')

@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection 

@section('title', 'Quản lý slideshow')

@section('slide', 'active')

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
        <a class="btn btn-block btn-primary ad_add" href="{{ url('/admin/slider/add') }}" style="margin-bottom: 20px;">Thêm</a>
        <table id="table_id" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="text-align:center">STT</th>
                    <th style="text-align:center">Tên </th>
                    <th style="text-align:center">Sắp xếp </th>
                    <th style="text-align:center">Ảnh đại diện</th>
                    <th style="text-align:center">Trạng Thái</th>
                    <th style="text-align:center"><i class="fa fa-wrench" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($sliders) && count($sliders) > 0)
                    @foreach($sliders as $key => $news)
                    <tr>
                        <td style="text-align:center">{{ $key + 1 }}</td>
                        <td style="text-align:center">{{ $news->name }}</td>
                        <td style="text-align:center">{{ $news->sort }}</td>
                        <td style="text-align:center">
                            <img src="{{ url('be-assets/img/slider/'.$news->images) }}" style="width:300px; height:120;" alt="">
                        </td>
                        <td style="text-align:center">
                            @if( $news->status == 1)
                                Bật
                            @else
                                Tắt
                            @endif
                        </td>
                        <td style="text-align:center">
                            <a class="btn btn-block btn-primary ad_button_edit" href="{{ url('/admin/slider/edit/'.$news->id) }}" title="Chỉnh sửa">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-block btn-primary ad_button_delete" href="{{ url('/admin/slider/delete/'.$news->id) }}" title="Xóa">
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
