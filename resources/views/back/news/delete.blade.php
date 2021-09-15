@extends('back.templates.master')

@section('title', 'Xóa Tin')

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
    <h1>Xóa tin</h1>

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
    <div class="card-header"><a class="btn btn-block btn-danger ad_add" href="{{ url('/admin/news_cat/list') }}">Quay lại</a></div>

    <div class="container rounded bg-white mt-5 mb-5">
    <form action="{{ url('admin/news/delete/'.$news->id) }}" method="POST">
        @csrf
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">News Edit</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Tên tin tức</label><input type="text" name="name" class="form-control" placeholder="" value="{{ $news->name }}"></div>
                </div>
                <div>
                    <br>
                    <label for="">Thuộc danh mục</label>
                    <br>
                    <select name="Cat_id" id="">
                        <option value="" placeholder="Trạng thái">---Chọn danh mục---</option>
                        <?php $check = ""; ?>
                    @if(isset($newsCategory) && count($newsCategory) > 0)
                        @foreach($newsCategory as $newsCategory)
                        <?php if($news->Cat_id == $newsCategory->id){$check = "selected";} ?>
                        <option {{ $check }} value="{{ $newsCategory->id }}" placeholder="">{{ $newsCategory->name }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div>
                    <br>
                    <label for="">Trạng thái</label>
                    <br>
                    <select name="status" id="">
                        <option value="" placeholder="Trạng thái">---Trạng thái---</option>
                        <?php $check1 = ($news->status == 1) ? "selected" : "";?>
                        <option {{ $check1 }} value="1">Bật</option>
                        <?php $check0 = ($news->status == 0) ? "selected" : "";?>
                        <option {{ $check0 }} value="0">Tắt</option>
                    </select>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Meta title</label><br><textarea name="MetaTitle" id="" rows="4" class="form-control" value="">{{ $news->MetaTitle }}</textarea></div>               
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Meta description</label><br><textarea name="MetaDescription" id="" rows="4" class="form-control" value="">{{$news->MetaDescription}}</textarea></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Meta keyword</label><br><textarea name="MetaKeyword" id="" rows="2" class="form-control" value="">{{ $news->MetaKeyword }}</textarea></div>
                </div>                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Giới thiệu</label><br><textarea name="smallDescription" id="" rows="3" class="form-control" value="">{{ $news->smallDescription }}</textarea></div>
                </div>                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Mô tả tin tức</label><br><textarea name="description" id="" rows="8" class="form-control" value="">{{ $news->description }}</textarea></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Xóa</button></div>
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