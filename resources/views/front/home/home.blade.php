
@extends('front.templates.master')

@section('title', $page_info->MetaTitle)

@section('description', $page_info->MetaDescription)

@section('keywords', $page_info->MetaKeyword)

@section('home', 'active')

@section('url', url('/'))

@section('image', url('be-assets/img/page/'.$page_info->images))


@section('content')
    <div class="home_page">
        <div class="slider_wrap">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            @if(isset($slider) && count($slider) > 0)
            @foreach($slider as $k => $slider)
                <div class="carousel-item @if($k == 0) active @endif" data-bs-interval="2000">
                <img src="{{ url('be-assets/img/slider/'.$slider->images) }}" class="d-block w-100" alt="...">
                </div>
            @endforeach
            @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="home_top">
                        <div class="home_top_left">
                            <div class="heading">Tin mới</div> 
                            <ul>
                                    @if(isset($newest) && count($newest) > 0 )
                                    @foreach($newest as $new)
                                    <li>
                                        <a href="{{ url($new->alias) }}.html">
                                            <img src="{{ url('be-assets/img/news/'.$new->images) }}" alt="">
                                            <b>{{Illuminate\Support\Str::of($new->name)->words(5) }}</b>
                                            <p>{{Illuminate\Support\Str::of($new->smallDescription)->words(15)}}<span>[read more]</span></p>
                                        </a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>   
                        </div>
                        <div class="home_top_right">
                            <div class="heading">
                                Về chúng tôi
                            </div>
                            <img src="{{ url('be-assets/img/about_us/about.jpg') }}" alt="">
                            <b>Sir Hevn D'monyx</b>
                            <p><strong>SOLARYA DRAGOON</strong> {{Illuminate\Support\Str::of($about)->words(30)}} <a href="{{ url('/ve-chung-toi') }}" title="Xem thêm">[read more]</a> </p>

                            <div class="home_social">
                                @if(isset($social) && count($social) > 0)
                                @foreach($social as $social)
                                    <span>
                                    <a href="{{ $social->alias }}">{!! $social->font !!}</a>
                                    </span>
                                @endforeach
                                @endif
                            </div>
                        
                        </div>   
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                    <div class="heading" style="margin-top: 55px; color: white;">Khuyến mãi mới nhất</div> 
                    <div class="home_center">
                        <div class="row">
                            @if(isset($news_sale) && count($news_sale) > 0 )
                                @foreach($news_sale as $new)
                                    <div class="col sale">
                                        <a href="{{ url($new->alias) }}.html">
                                            <img src="{{ url('be-assets/img/news/'.$new->images) }}" alt="">
                                            <b>{{Illuminate\Support\Str::of($new->name)->words(5) }}</b>
                                            <p>{{Illuminate\Support\Str::of($new->smallDescription)->words(15)}}<span>[read more]</span></p>
                                        </a>
                                    </div>
                                @endforeach
                                @endif
                        </div>
                    </div>
            </div>
        </div>

        <div class="container bottom">
            <div class="row">
                    <div class="home_bottom">
                    <div class="heading">Được xem nhiều</div> 
                        <div class="row">
                            @if(isset($news) && count($news) > 0 )
                                @foreach($news as $new)
                                    <div class="col most_viewed">
                                        <a href="{{ url($new->alias) }}.html">
                                            <img src="{{ url('be-assets/img/news/'.$new->images) }}" alt="">
                                            <b>{{Illuminate\Support\Str::of($new->name)->words(5) }}</b>
                                            <p>{{Illuminate\Support\Str::of($new->smallDescription)->words(15)}}<span>[read more]</span></p>
                                        </a>
                                    </div>
                                @endforeach
                                @endif
                        </div>
                    </div>
            </div>
        </div>
    </div> 
@endsection