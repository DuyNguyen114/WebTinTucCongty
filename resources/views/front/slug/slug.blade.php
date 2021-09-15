
@extends('front.templates.master')

@section('title', $category->MetaTitle)

@section('description', $category->MetaDescription)

@section('keywords', $category->MetaKeyword)

@section($category->alias, 'active')

@section('url', url('/'.$category->alias))

@section('image', url('be-assets/img/page/'.$category->images))


@section('content')
    <div class="contact_wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="contact_page">
                        <div class="heading">
                            {{ $category->name }}
                            <select name="" id="newsSort" class="news_cat_sort">
                                <option value="tinmoi" @if($sort == 'tinmoi') selected="" @endif>Mới nhất</option>
                                <option value="luotxem" @if($sort == 'luotxem') selected="" @endif>Xem nhiều</option>
                            </select>
                            <input type="hidden" id="newsCat" value="{{ $category->alias }}" >
                        </div>
                        <div>
                            <ul class="news_cat_wrap">
                            @if(isset($list) && count($list) > 0)
                            @foreach($list as $new)
                                <li>
                                    <a href="{{ url($new->alias.'.html') }}">
                                        <img src="{{ url('be-assets/img/news/'.$new->images) }}" alt="">
                                        <b>{{Illuminate\Support\Str::of($new->name)->words(5) }}</b>
                                        <p>{{Illuminate\Support\Str::of($new->smallDescription)->words(15)}}<span>[read more]</span></p>
                                        
                                    </a>
                                </li>    
                            @endforeach
                            @endif
                            </ul>
                            <div class="page_pagination">{{ $list->links() }}</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>    
        </div>
    </div> 
@endsection