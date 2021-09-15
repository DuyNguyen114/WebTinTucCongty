
@extends('front.templates.master')

@section('title', $page_info->MetaTitle)

@section('description', $page_info->MetaDescription)

@section('keywords', $page_info->MetaKeyword)

@section($page_info->alias, 'active')

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
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>    
        </div>
    </div> 
@endsection