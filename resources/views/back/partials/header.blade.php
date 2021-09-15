<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <a href="{{ url('/') }}" style="color:aliceblue">Trang chủ</a>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto" style="position: relative;">

                <div class="topbar-divider d-none d-sm-block"></div>

                    <li>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: #b89696; background-color: #ffffff; border: none; margin-top: 15px">
                                <span style="margin-bottom: 10px">Xin chào {{ $user->name }}</span>
                                <i class="fa fa-user-circle fa-2x" aria-hidden="true" style="margin-left:5px"></i>
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/staff/profile') }}">
                                        <i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i>
                                        Profile
                                    </a>
                                </li>
                                @if($Role == 1)
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/staff/list') }}">
                                        <i class="fa fa-users" aria-hidden="true" style="margin-right: 2px;"></i>
                                        Quản lý nhân viên
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: #b89696; background-color: #ffffff; border: none;">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2" style="margin-left: 5px;"></i> Logout
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </li>



                </ul>

                </nav>