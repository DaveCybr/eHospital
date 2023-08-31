$(document).ready(function(){
  var jumlah = 0;
  $('#checked_all').on('ifChecked', function () {
    var jml = 0;
    $('.checked_hapus').prop('checked',true).iCheck('update');
    $('.checked_hapus').prop('checked',true).each(function(){
      jml++;
    });
    $(this).prop('checked',true).iCheck('update');
    $("#jumlah").val(jml);
    $("#jumlah_pilih").html(jml);
    $("#hapus_data").removeClass('btn-secondary');
    $("#hapus_data").removeClass('hapus-false');
    $("#hapus_data").addClass('btn-danger');
    $("#hapus_data").addClass('hapus-true');
  })
  $('#checked_all').on('ifUnchecked', function () {
    var jml=0;
    $('.checked_hapus').prop('checked',false).iCheck('update');
    $("#jumlah").val(jml);
    $("#jumlah_pilih").html(jml);
    $("#hapus_data").removeClass('btn-danger');
    $("#hapus_data").removeClass('hapus-true');
    $("#hapus_data").addClass('btn-secondary');
    $("#hapus_data").addClass('hapus-false');

  })
  $('.checked_hapus').on('ifUnchecked', function () {
    var jml_pilih = parseInt($("#jumlah").val());
    $(this).prop('checked',false).iCheck('update');
    jml_pilih -=1;
    $("#jumlah").val(jml_pilih);
    $("#jumlah_pilih").html(jml_pilih);
    if (jml_pilih==0) {
      $("#hapus_data").removeClass('btn-danger');
      $("#hapus_data").removeClass('hapus-true');
      $("#hapus_data").addClass('btn-secondary');
      $("#hapus_data").addClass('hapus-false');
      $("#checked_all").prop('checked',false).iCheck('update');
    }

  })
  $('.checked_hapus').on('ifChecked', function () {
    var jml_pilih = parseInt($("#jumlah").val());
    $(this).prop('checked',true).iCheck('update');
    jml_pilih += parseInt(1);
    $("#jumlah").val(jml_pilih);
    $("#jumlah_pilih").html(jml_pilih);
    $("#hapus_data").removeClass('btn-secondary');
    $("#hapus_data").removeClass('hapus-false');
    $("#hapus_data").addClass('btn-danger');
    $("#hapus_data").addClass('hapus-true');
  })
})
