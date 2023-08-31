<!DOCTYPE html>
<html>
<head>
	<title>Realtime Message</title>
</head>
<body>
	<form action="<?php echo base_url();?>message/process/" method="post" id="form">
		<input type="text" name="message" placeholder="enter here">
		<button type="submit" name="button">Kirim</button>
	</form>

</body>
 <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script type="text/javascript">
 	$("#form").submit(function(e){
 		e.preventDefault();
    var m = $("#message").val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Kunjungan/pro',
      data: { idobat: m },
      dataType:'json',
      async : false,
      success: function(response) {
        // if(response.status==0){
        //   alert("Stok Obat Habis");
        // }else{
        //    $("#scrollmodal").modal('toggle');
        //    tambahobat(response);
        // }
        alert(response);

      }
    });
 	});
 </script>
</html>
