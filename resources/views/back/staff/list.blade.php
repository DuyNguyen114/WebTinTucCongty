@extends('back.templates.master')

@section("css")
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection 

@section('title', 'Danh sách nhân viên')

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
        <a class="btn btn-block btn-primary ad_add" href="{{ url('/admin/staff/add') }}">Thêm</a>
        <table id="table_id" class="display" style="width:100%">
            <thead>
                <tr>
                    <th style="text-align:center">STT</th>
                    <th style="text-align:center">Họ và tên</th>
                    <th style="text-align:center">Chức vụ</th>
                    <th style="text-align:center">email</th>
                    <th style="text-align:center">SĐT</th>
                    <th style="text-align:center"><i class="fa fa-wrench" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($users))
                    @foreach($users as $key => $user)
                    <tr>
                        <td style="text-align:center">{{ $key + 1 }}</td>
                        <td style="text-align:center">{{ $user->name }}</td>
                        <td style="text-align:center"> 
                            <ul>
                                @foreach($user->roles as $role)
                                <li>
                                    {{ $role->name }}
                                </li>
                                @endforeach
                            </ul> 
                        </td>
                        <td style="text-align:center">{{ $user->email }}</td>
                        <td style="text-align:center">{{ $user->phone }}</td>
                        <td>
                            <a class="btn btn-block btn-primary ad_button_edit" href="{{ url('/admin/staff/edit/'.$user->id) }}" title="Chỉnh sửa">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-block btn-primary ad_button_delete" href="{{ url('/admin/staff/delete/'.$user->id) }}" title="Xóa">
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