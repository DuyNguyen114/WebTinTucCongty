<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/admin/home')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                <span>Admin Home</span>
                </div>
            </a>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion nav nav-pills" id="accordionSidebar">
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @if($Role == 1)
            <!-- Nav Item - Dashboard -->
            <li class="nav-item @yield('system')">
                <a class="nav-link" href="{{ url('/admin/system') }}" >
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span style="font-size:20px">Cấu hình hệ thống</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item @yield('page')">
                <a class="nav-link" href="{{ url('/admin/page/list') }}">
                <i class="fa fa-sitemap" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý trang</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item @yield('social')">
                <a class="nav-link" href="{{ url('admin/social/list') }}">
                <i class="fa fa-eye" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý mạng xã hội</span></a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            @if($Role == 1 || $Role == 2)
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item mouseenter">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseTwo" aria-controls="collapseExample" aria-expanded="false">  
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý tin tức</span>
                </a>
                <div class="collapseTwo" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color: #4e73df; margin-left: 20px">
                        <a class="collapse-item" href="{{ url('admin/news_cat/list') }}" style="color: white; font-size:15px; margin-left: 35px"> Danh mục tin tức</a><br>
                        <a class="collapse-item" href="{{ url('admin/news/list') }}" style="color: white; font-size:15px; margin-left: 35px"> Danh sách tin tức</a>
                    </div>
                </div>
            </li> -->

            <li class="nav-item @yield('news')">
                    <a class="btn btn-primary nav-link" data-bs-toggle="collapse" href="#collapseExample" role="" aria-expanded="false" aria-controls="collapseExample" style="background-color: #4167d6; border: none">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                        <span style="font-size:20px">Quản lý tin tức</span>
                    </a>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <a class="collapse-item" href="{{ url('admin/news_cat/list') }}" > Danh mục tin tức</a><br>
                        <a class="collapse-item" href="{{ url('admin/news/list') }}" > Danh sách tin tức</a>
                    </div>
                    </div>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item @yield('slide')">
                <a class="nav-link" href="{{ url('admin/slider/list') }}">
                <i class="fas fa-sticky-note"></i>
                    <span style="font-size:20px">Quản lý slide show</span></a>
            </li>

            @endif

            <hr class="sidebar-divider">
            
            <li class="nav-item @yield('sale')">
                <a class="nav-link" href="{{ url('admin/newletters/list') }}">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý tin khuyến mãi</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item @yield('contact')">
                <a class="nav-link" href="{{ url('admin/contact/list') }}">
                <i class="fa fa-phone" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý liên hệ</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
        </ul>

</ul>



<script>
    $(document).ready(function(){
        $("#mouseenter").mouseenter(function(){
            alert("You entered abc!");
        });
    });
</script>