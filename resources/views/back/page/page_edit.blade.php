@extends('back.templates.master')

@section('title', 'Sửa page')

@section('page', 'active')

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
    <h1>Cập nhật trang web</h1>

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
    <div class="card-header"><a class="btn btn-block btn-danger ad_add" href="{{ url('/admin/page/list') }}">Quay lại</a></div>

    <div class="container rounded bg-white mt-5 mb-5">
    <form action="{{ url('admin/page/edit/'.$page->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
    <div>
        <div class="">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Page Edit</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12" style="margin-bottom:20px"><label class="labels" style="font-size: 20px; font-weight:400;">Tên trang</label><input type="text" name="name" class="form-control" id="title" onkeyup="ChangeToSlug();" value="<?php echo $page->name?>"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12" style="margin-bottom:20px"><label class="labels" style="font-size: 20px; font-weight:400;">Đường dẫn</label><input type="text" name="alias" class="form-control" id="slug" value="{{ $page->alias }}"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12" style="margin-bottom:20px; "><label class="labels" style="font-size: 20px; font-weight:400;">Ảnh đại diện</label>
                    @if($page->images != NULL)
                        <img src=" {{ asset("/be-assets/img/page/".$page->images) }} " alt="">
                    @endif
                    <input type="file" name="images" class="form-control"></div>
                </div>
                <div class="row mt-2">
                    <div style="padding-left: 0; padding-bottom: 10px">
                        <div class="col-md-12"><label for="" style="font-size: 20px; font-weight:400;">Trạng thái</label></div>
                        <select style="margin-left: 15px ;" name="status" id="">
                            <option value="" placeholder="Trạng thái">---Trạng thái---</option>
                            <?php $check1 = ($page->status == 1) ? "selected" : '';?>
                            <option <?php echo $check1; ?> value="1">Bật</option>
                            <?php $check2 = ($page->status != 1) ? 'selected' : '';?>
                            <option <?php echo $check2; ?> value="0">Tắt</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div style="padding-left: 0; padding-bottom: 10px">
                        <div class="col-md-12" style="margin-bottom:20px;"><label class="labels" style="font-size: 20px; font-weight:400;">Font</label><input type="text" name="font" class="form-control" placeholder="enter font" value="{{ $page->font }}"></div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div style="padding-left: 0; padding-bottom: 10px">
                        <div class="col-md-12" style="margin-bottom:20px; font-size: 20px; font-weight:400;"><label class="labels" style="font-size: 20px; font-weight:400;">Sắp xếp</label><input type="text" name="sort" class="form-control" placeholder="enter font" value="{{ $page->sort }}"></div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12" style="margin-bottom:20px; font-size: 20px; font-weight:400;"><label class="labels" style="font-size: 20px; font-weight:400;">Meta title</label><textarea name="MetaTitle" id="" rows="4" class="form-control" value="">{{ $page->MetaTitle }}</textarea></div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12" style="margin-bottom:20px; font-size: 20px; font-weight:400;"><label class="labels" style="font-size: 20px; font-weight:400;">Meta description</label><textarea name="MetaDescription" id="" rows="4" class="form-control" value="">{{ $page->MetaDescription }}</textarea></div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12" style="margin-bottom:20px; font-size: 20px; font-weight:400;"><label class="labels" style="font-size: 20px; font-weight:400;">Meta keyword</label><textarea name="MetaKeyword" id="" rows="2" class="form-control" value="">{{ $page->MetaKeyword }}</textarea></div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12" style="margin-bottom:20px; font-size: 20px; font-weight:400;"><label class="labels" style="font-size: 20px; font-weight:400;">Mô tả tin tức</label><textarea name="description" id="ckeditor" rows="8" class="form-control" value="">{{ $page->description }}</textarea></div>               
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Chỉnh sửa</button></div>
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