
<!DOCTYPE html>
<html dir="ltr" lang="vi">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('be-assets/img/system/'.$favicon->description) }}" />
    <link rel="canonical" href="@yield('url')" />    
    <meta property="og:locale" itemprop="inLanguage" content="vi_VN"  />   
    <meta property="og:url" content="@yield('url')" /> 
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('image')" />    
    <meta property="og:site_name" content="Cơ Khí Thành Tín" />    
    <meta name="copyright" content="Cơ Khí Thành Tín"/> 
    <meta name="author" content="Cơ Khí Thành Tín">
    <meta name="geo.placename" content="Ho Chi Minh, Viet Nam"/>
    <meta name="geo.region" content="VN-HCM"/>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MTH7S47');</script>
    <!-- End Google Tag Manager -->
    
    <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />    

    <!-- Global site tag (gtag.js) - Google Analytics -->
   


    <link href="{{ url('be-assets/fontawesome-free-5.15.3/css/all.css') }}" rel="stylesheet" />
    <link href="{{ url('be-assets//bootstrap-5.0.2/dist/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('be-assets/css/style.css') }}" rel="stylesheet" />
    <script type="text/javascript">var url = "{!! url('/') !!}";</script> 

  </head>
  <body id="trangchu">
    @csrf
    <div id="wrapper">
        <div class="header">
          @include('front.partials.header')
        </div>
        <div class="content">
          @yield('content')
        </div>
        <div class="footer">
          @include('front.partials.footer')
        </div>
    </div>
  </body>
  <script src="{{ url('/js/jquery.js') }}"></script>
  <script src="{{ url('be-assets//bootstrap-5.0.2/dist/js/bootstrap.min.js') }}"></script> 
  <!-- <script src="{{ url('/js/front.js') }}"></script>   -->
  <script>
    $('#btnSend').on("click", function () {
  var name = $('#txtName').val();
  var mail = $('#txtEmail').val();
  var phone = $('#txtPhone').val();
  var message = $('#txtMessage').val();
  var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!re.test(mail)){ alert('Email không hợp lệ!'); return false;}
  else {
      $.ajax({
          url: "{{ url('/gui-email-lien-he') }}" ,
          method: "POST",
          data: {name: name, mail: mail, phone: phone, message: message, _token: "{{ csrf_token() }}"},
      }).done(function(mess){
        alert(mess);
      });
    }
    return true;

});
  </script>
  <script>
    $('#btnSendSub').on("click", function () {
    var mail = $('#textEmailSub').val();
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(mail)){ alert('Email không hợp lệ!'); return false;}
    else {
        $.ajax({
            url: "{{ url('/dang-ky-nhan-tin-khuyen-mai') }}" ,
            method: "POST",
            data: {mail: mail, _token: "{{ csrf_token() }}"},
        }).done(function(mess){
          alert(mess);
        });
      }
      return true;
});
  </script>
  <script>
    $('#newsSort').on("change", function(){
      var sort = this.value;
      var category = $('#newsCat').val()
      if(sort != ''){
        window.location.href = url+"/"+category+"/?sort="+sort;
      }
    });
  </script>
  </html>