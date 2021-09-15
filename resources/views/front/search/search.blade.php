
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
                        <div class"">
                            @if(isset($search_list) && $search_list != NULL)
                            <ul class="news_cat_wrap">
                                @foreach($search_list as $k=>$new)
                                <li>
                                        <a href="{{ url($new->alias) }}.html">
                                            <img src="{{ url('be-assets/img/news/'.$new->images) }}" alt="">
                                            <b>{{Illuminate\Support\Str::of($new->name)->words(5) }}</b>
                                            <p>{{Illuminate\Support\Str::of($new->smallDescription)->words(15)}}<span>[read more]</span></p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>  
                            <div class="page_pagination">{{ $search_list->links() }}</div>    
                            @else 
                            <p class="search_error"><i class="fas fa-exclamation-triangle"></i> Không tìm thấy kết quả nào!</p>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>    
        </div>
    </div> 
@endsection