@extends('back.templates.master')

@section('title', 'Cấu hình hệ thống')

@section('system', 'active')

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
    <h1>Cấu hình hệ thống</h1>

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
    <form action="{{ url('admin/system') }}" enctype="multipart/form-data" method="POST">
        @csrf
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">System Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Tên công ty</label><input type="text" name="name" class="form-control" placeholder="" value="<?php echo $name->description; ?>"></div>
                    <div class="col-md-12">
                        <label class="labels">Logo</label><br>
                        <img src="{{ url('/be-assets/img/system/'.$logo->description) }} " height="75" width="75" alt="">
                        <input type="file" name="logo" class="form-control" placeholder=">" value="">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Favicon</label><br>
                        <img src="{{ url('/be-assets/img/system/'.$favicon->description) }} " height="75" width="75" alt="">
                        <input type="file" name="favicon" class="form-control" placeholder="" value="">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">PhoneNumber</label><input type="text" name="phone" class="form-control" placeholder="enter phone number" value="<?php echo $phone->description; ?>"></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" placeholder="enter email" value="<?php echo $email->description; ?>"></div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" name="address" class="form-control" placeholder="enter address" value="<?php echo $address->description; ?>"></div>
                    <div class="col-md-12"><label class="labels">Google Map</label><br><textarea name="map" id="" cols="140" rows="6">{{ $map->description }}</textarea></div>
                    <div class="col-md-12"><label class="labels">Copyright</label><input type="text" name="copyright" class="form-control" placeholder="" value="<?php echo  $copyright->description; ?>"></div>
                    <div class="col-md-12"><label class="labels"></label><input type="hidden" name="id" class="form-control" placeholder="" value=""></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Chỉnh sửa</button></div>
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