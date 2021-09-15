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


// return re.test(String(email).toLowerCase());
