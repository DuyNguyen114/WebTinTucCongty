@extends('back.templates.master')

@section('title', 'Sửa social')

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
    <h1>Sửa thông tin tài khoản</h1>

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
    <div class="card-header"><a class="btn btn-block btn-danger ad_add" href="{{ url('/admin/social/list') }}">Quay lại</a></div>

    <div class="container rounded bg-white mt-5 mb-5">
    <form action="{{ url('admin/social/edit/'.$social->id) }}" method="POST">
        @csrf
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Social Edit</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Tên trang</label><input type="text" name="name" class="form-control" placeholder="" value="<?php echo $social->name?>"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Đường dẫn</label><input type="text" name="alias" class="form-control" placeholder="" value="<?php echo $social->alias?>"></div>
                </div>
                <div>
                    <br>
                    <label for="">Trạng thái</label>
                    <br>
                    <select name="status" id="">
                        <option value="" placeholder="Trạng thái">---Trạng thái---</option>
                        <?php $check1 = ($social->status == 1) ? "selected" : '';?>
                        <option <?php echo $check1; ?> value="1">Bật</option>
                        <?php $check2 = ($social->status != 1) ? 'selected' : '';?>
                        <option <?php echo $check2; ?> value="0">Tắt</option>
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Font</label><input type="text" name="font" class="form-control" placeholder="enter font" value="{{ $social->font }}"></div>
                    <div class="col-md-12"><label class="labels">Sort</label><input type="text" name="sort" class="form-control" placeholder="enter sort" value="<?php echo $social->sort?>"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Chỉnh sửa</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
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