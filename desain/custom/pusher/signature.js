
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('58f10ec738925cc9cf18', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('ci_pusher2');
  channel.bind('my-event2', function(data) {
    // alert(data.gambar);
    var i = new Image(150,150)
    var signature = data.gambar;
  //Here signatureDataFromDataBase is the string that you saved earlier
    i.src = 'data:' + signature;
    $(i).appendTo('#signature'+data.nokun);
    $("#val_signature"+data.nokun).val(data.gambar);
  });
