
@extends('front.templates.master')

@section('title', $page_info->MetaTitle)

@section('description', $page_info->MetaDescription)

@section('keywords', $page_info->MetaKeyword)

@section('lien-he', 'active')

@section('url', url('/'.$page_info->alias))

@section('image', url('be-assets/img/page/'.$page_info->images))


@section('content')
    <div class="contact_wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="contact_page">
                        <div class="heading">
                            {{ $page_info->name }}
                        </div>
                        <div class="contact_description">
                            {!!$page_info->description!!}
                        </div>
                        <div class="contact_map">
                            {!! $map->description !!}
                        </div>
                        <div class="contact_form">
                            <input type="text" id="txtName" placeholder="Họ và tên...">
                            <input type="email" id="txtEmail" placeholder="Email...">
                            <input type="text" id="txtPhone" placeholder="Số điện thoại...">
                            <textarea name="" id="txtMessage" placeholder="Lời nhắn..." cols="30" rows="10"></textarea>
                            <button id="btnSend">Gửi liên hệ</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>    
        </div>
    </div> 
@endsection