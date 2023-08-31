
$(document).ready(function(){


  $(".select2").select2();

  $('.multiSelect').multiSelect({
      selectableOptgroup: true
  });
  $("#client_side").dataTable({
    order: [],
    columnDefs: [ { orderable: false, targets: [0]}]
  });
  $("#client_side2").dataTable({
    order: [],
    columnDefs: [ { orderable: false}]
  });
  //datatables
  var url = window.location.origin+"/template/";
  // alert(url);
  $('#server_side').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
       "url": url+"user/api/get_user",
       "type": "POST"
    },
    "columnDefs": [
    {
        "targets": [0],
        "orderable": false
    }]
  });

  //Warning Message //hapus-true
  $(document).on('click','.hapus-true',function(){
    swal({
      title: "Apakah kamu yakin?",
      text: "Data yang terhapus tidak dapat dikembalikan!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya, Hapus!",
      closeOnConfirm: false
    }, function(){
        $("#form_hapus").submit();
      });
    });
  //Hapus false
  $(document).on('click','.hapus-false',function(){
      swal("Pilih data terlebih dahulu!",'Silahkan pilih data dengan cara mencentang data yang akan dihapus');
  });


})
