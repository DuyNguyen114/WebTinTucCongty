@extends('back.templates.master')

@section('title', 'Sửa page')

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
    <div class="card-header"><a class="btn btn-block btn-danger ad_add" href="{{ url('/admin/contact/list') }}">Quay lại</a></div>

    <div class="container rounded bg-white mt-5 mb-5">
    <form action="{{ url('admin/contact/edit/'.$contact->id) }}" method="POST">
        @csrf
    <div class="row">
        <div class="">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Contact Edit</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Họ và tên</label><input type="text" name="name" class="form-control" placeholder="" value="<?php echo $contact->name?>"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" placeholder="" value="<?php echo $contact->email?>"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">SĐT</label><input type="text" name="phone" class="form-control" placeholder="" value="<?php echo $contact->phone?>"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12"><label class="labels">Message</label><br><textarea name="message" id="" cols="140" rows="7"><?php echo $contact->message?></textarea></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12"><label class="labels">Trạng thái</label><br>
                    <select name="seen" id="">
                        <option value="" placeholder="Trạng thái">---Trạng thái---</option>
                        <?php $check1 = ($contact->seen != 0) ? "selected" : '';?>
                        <option <?php echo $check1; ?> value="1" style="color: green">Đã xem</option>
                        <?php $check2 = ($contact->seen == 0) ? 'selected' : '';?>
                        <option <?php echo $check2; ?> value="0" style="color: red">Chưa xem</option>
                    </select>
                    </div>
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