
@extends('front.templates.master')

@section('title', $new->MetaTitle)

@section('description', $new->MetaDescription)

@section('keywords', $new->MetaKeyword)

@section($new->alias, 'active')

@section('url', url('/'.$new->alias.'html'))

@section('image', url('be-assets/img/news/'.$new->images))


@section('content')
    <div class="contact_wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="contact_page">
                        <div class="heading">
                            {{ $new->name }}
                        </div>
                        <div class="new_detail_statistic">
                            <i class="far fa-calendar-check"></i>
                            {{date('d-m-Y', strtotime( $new->created_at ))}}    
                            &nbsp;&nbsp;
                            <i class="fas fa-eye"></i>
                            {{ number_format($new->views) }}
                        </div>
                        <div class="contact_description new_detail_editor">
                            {!! $new->description !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>    
        </div>
    </div> 
@endsection