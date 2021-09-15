<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer_top">
                <div class="row">
                    <div class="col footer_top_left">Đăng kí nhận tin khuyến mãi</div>
                    <div class="col footer_top_right">
                        <input type="text" name="" id="textEmailSub" placeholder="Email của bạn...">
                        <button id="btnSendSub">SEND</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6"><div class="footer_logo"><a href="{{ url('/') }}" title="Trang chủ"><img src="{{ url('be-assets/img/system/'.$logo->description) }}" alt=""></a></div></div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="footer_copyright">
                        {{ $copyright->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>