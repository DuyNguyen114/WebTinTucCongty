@extends('back.templates.master')

@section('title', 'Thêm tin')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
   body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
    </style>
</head>
<body>
    <h1>Thêm tin mới</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card-header"><a class="btn btn-block btn-danger ad_add" href="{{ url('/admin/news/list') }}">Quay lại</a></div>

    <div class="container rounded bg-white mt-5 mb-5">
    <form action="{{ url('admin/news/add') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div>
        <div class="">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Thêm tin mới</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Tên tin tức</label><input type="text" name="name" class="form-control" id="title" onkeyup="ChangeToSlug();"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Đường dẫn</label><input type="text" name="alias" class="form-control" id="slug"></div>
                </div>
                <div class="row mt-2">
                    <div>
                        <div class="col-md-12"><label for="">Thuộc danh mục</label></div>
                        <select style="margin-left: 15px ;" name="Cat_id" id="">
                            <option value="" placeholder="Trạng thái">---Danh mục---</option>
                            @if(isset($newsCategory) && count($newsCategory) > 0)
                            @foreach($newsCategory as $newsCategory)
                            <option value="{{ $newsCategory->id }}" placeholder="">{{ $newsCategory->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div>
                        <div class="col-md-12"><label for="">Trạng thái</label></div>
                        <select style="margin-left: 15px ;" name="status" id="">
                            <option value="" placeholder="Trạng thái">---Trạng thái---</option>
                            <option value="1">Bật</option>
                            <option value="0">Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                        <div class="col-md-12"><label class="labels" style="font-size: 15px;">Meta title</label><textarea name="MetaTitle" id="" rows="4" class="form-control"></textarea></div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels" style="font-size: 15px;">Meta Description</label><textarea name="MetaDescription" id="" rows="4" class="form-control" value=""></textarea></div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels" style="font-size: 15px;">Meta keyword</label><textarea name="MetaKeyword" id="" rows="2" class="form-control" value=""></textarea></div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels" style="font-size: 15px;">Giới thiệu ngắn</label><textarea name="smallDescription" id="" rows="2" class="form-control" value=""></textarea></div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="">Ảnh đại diện</label><br>
                        <input type="file" name="images" id="">
                    </div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels" style="font-size: 15px;">Mô tả tin tức</label><textarea name="description" id="ckeditor" rows="8" class="form-control" value=""></textarea></div>               
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Thêm </button></div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>


</body>
</html>
@endsection