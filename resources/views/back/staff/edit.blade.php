@extends('back.templates.master')

@section('title', 'Sửa thông tin tài khoản')

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
    <form action="{{ url('admin/staff/edit/'.$edit_user->id.'/'.$role_id) }}" method="POST">
        @csrf
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQF2psCzfbB611rnUhxgMi-lc2oB78ykqDGYb4v83xQ1pAbhPiB&usqp=CAU"></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">User Name</label><input type="text" name="name" class="form-control" placeholder="" value="<?php echo $edit_user->name?>"></div>
                    <div class="col-md-12"><label class="labels">Full Name</label><input type="text" name="fullname" class="form-control" placeholder="" value="<?php echo $edit_user->fullname?>"></div>
                </div>
                <div>
                    <br>
                    <select name="role" id="">
                        <option value="" placeholder="chọn chức vụ">---Chọn chức vụ---</option>
                        <?php $check1 = ($role_id == 1) ? "selected" : '';?>
                        <option <?php echo $check1; ?>  value="1">Administrator</option>
                        <?php $check2 = ($role_id == 2) ? 'selected' : '';?>
                        <option <?php echo $check2; ?> value="2">Nhân viên cấp 2</option>
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">PhoneNumber</label><input type="text" name="phone" class="form-control" placeholder="enter phone number" value="<?php echo $edit_user->phone?>"></div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" name="address" class="form-control" placeholder="enter address" value="<?php echo $edit_user->address?>"></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" placeholder="" value="<?php echo $edit_user->email; ?>"></div>
                    <div class="col-md-12"><label class="labels">Password</label><input type="text" name="password" class="form-control" placeholder="Chỉ điền khi muốn đổi mật khẩu" value=""></div>
                    <div class="col-md-12"><label class="labels"></label><input type="hidden" name="id" class="form-control" placeholder="" value="<?php echo $edit_user->id ?>"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

    </form>
</body>
</html>
@endsection