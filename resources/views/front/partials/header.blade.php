<div class="header_top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="header_logo"><a href="{{ url('/') }}" title="Trang chủ"><img src="{{ url('be-assets/img/system/'.$logo->description) }}" alt=""></a></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="header_social">
                    @if(isset($mang_xh) && count($mang_xh) > 0)
                    @foreach($mang_xh as $social)
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
<div class="header_bottom">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="header_menu">
                    @if(isset($page) && count($page) > 0)
                    <ul>
                        @foreach($page as $key => $page)
                        @if($key == 0)
                        <li>
                            <a href="{{ url('/') }}" style="color: #f54c0b;" class="@yield('home')">{!! $page->font !!}</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ url('/'.$page->alias) }}" class="@yield($page->alias)">{{ $page->name }}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="header_search">
                    <form action="{{ url('/tim-kiem') }}" method="GET">
                        <input type="text" id="btnSearch" placeholder="Nhập từ khóa tìm kiếm" name="keyword">
                        <button><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>