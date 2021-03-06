<?php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();

    $Role = 0;
    foreach($user->roles as $role){
        if($role->id == 1){
            $Role = 1;
        } elseif($role->id == 2){
            $Role = 2;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/be-assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ url('be-assets/bootstrap-5.0.2/dist/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('be-assets/css/back_style.css') }}" rel="stylesheet" />

    @yield('css')


    <style>
        .ad_button_delete{
            background-color: #FF0000;
        }

        .ad_add{
            max-width: 100px;
        }
    </style>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include("back.partials.sidebar")
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                @include("back.partials.header")
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <!-- Main Content -->
               <section class="content"> 
                    <div class="container-fluid">
                            @yield('content')
                    </div>
               </section>
                <!-- End of Main Content -->

            </div>

            <div>
                <!-- Footer -->
                @include("back.partials.footer")
                <!-- End of Footer -->
            </div>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="http://localhost:8/webtintuc.com/public/admin/logout1">Logout</a>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to logout?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Select "Logout" below if you are ready to end your current session.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="http://localhost:8/webtintuc.com/public/admin/logout1">Logout</a>
      </div>
    </div>
  </div>
</div>

    <!-- Bootslugap core JavaScript-->
    <script src="{{ asset("/be-assets/vendor/jquery/jquery.min.js") }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset("/be-assets/vendor/jquery-easing/jquery.easing.min.js") }}"></script>

    
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- Custom scripts for all pages-->
    <script src="{{ asset("/be-assets/js/sb-admin-2.min.js") }}"></script>
    <script src="{{ asset("/be-assets/js/sb-admin-2.js") }}"></script>


    <script src="{{ url('be-assets//bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js') }}"></script> 

        @stack("scripts")
    
    <script src="{{ asset('/ckeditor4/ckeditor.js') }}"></script>"> </script>
    <script>
        CKEDITOR.replace( 'ckeditor' ,{
            filebrowserBrowseUrl : '{{ url("/responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr=") }}',
            filebrowserUploadUrl : '{{ url("/responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr=") }}',
            filebrowserImageBrowseUrl : '{{ url("/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=") }}'
        });
    </script>

    <script type="text/javascript">
        function ChangeToSlug() {
            var title, slug;
 
            //L???y text t??? th??? input title 
            title = document.getElementById("title").value;

            //?????i ch??? hoa th??nh ch??? th?????ng
            slug = title.toLowerCase();

            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
            slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
            slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
            slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
            slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
            slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
            slug = slug.replace(/??|???|???|???|???/gi, 'y');
            slug = slug.replace(/??/gi, 'd');
            //X??a c??c k?? t??? ?????t bi???t
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
            slug = slug.replace(/ /gi, "-");
            //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
            //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox c?? id ???slug???
            document.getElementById('slug').value = slug;
        }
    </script>
</body>

</html>