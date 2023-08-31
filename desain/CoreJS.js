$(".angkasaja").keypress(function(data) {
  if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
    return false;
  }
});
$(".hurufsaja").keypress(function(data) {
  // alert("hurufsaja");
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key == 32 || key == 9 || (key >= 37 && key <= 40) || (key >= 97 && key <= 122));
});

function kembali() {
  window.history.back()
}