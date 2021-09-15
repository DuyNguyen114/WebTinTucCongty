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
            <li class="nav-item active">
                <a class="nav-link @yield('system')" href="{{ url('/admin/system') }}" >
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span style="font-size:20px">Cấu hình hệ thống</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/admin/page/list') }}">
                <i class="fa fa-sitemap" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý trang</span></a>
            </li>

            <li class="nav-item active">
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
            <li class="nav-item mouseenter">
                <a class="nav-link collapsed " data-toggle="collapse" data-target="#collapseTwo" href="#">  
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý tin tức</span>
                </a>
                <div id="row mt-2" class="" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color: #4e73df; margin-left: 20px">
                        <a class="collapse-item" href="{{ url('admin/news_cat/list') }}" style="color: white; font-size:15px; margin-left: 35px"> Danh mục tin tức</a><br>
                        <a class="collapse-item" href="{{ url('admin/news/list') }}" style="color: white; font-size:15px; margin-left: 35px"> Danh sách tin tức</a>
                    </div>
                </div>
            </li>

            @endif

            <hr class="sidebar-divider">
            
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('admin/newletters/list') }}">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span style="font-size:20px">Quản lý tin khuyến mãi</span></a>
            </li>

            <li class="nav-item active">
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