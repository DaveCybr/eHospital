<?php
  $data = $this->Core->get_dokumentasi($this->uri->segment(3));
?>

<style>
.gallery {
-webkit-column-count: 3;
-moz-column-count: 3;
column-count: 3;
-webkit-column-width: 33%;
-moz-column-width: 33%;
column-width: 33%; }
.gallery .pics {
-webkit-transition: all 350ms ease;
transition: all 350ms ease; }
.gallery .animation {
-webkit-transform: scale(1);
-ms-transform: scale(1);
transform: scale(1); }

@media (max-width: 450px) {
.gallery {
-webkit-column-count: 1;
-moz-column-count: 1;
column-count: 1;
-webkit-column-width: 100%;
-moz-column-width: 100%;
column-width: 100%;
}
}

@media (max-width: 400px) {
.btn.filter {
padding-left: 1.1rem;
padding-right: 1.1rem;
}
}
</style>
<!-- Grid row -->
<div class="row">

</div>
<!-- Grid row -->

<!-- Grid row -->
<div class="gallery" id="gallery">
  <?php foreach ($data as $value): ?>
    <div class="mb-3 pics animation all 2">
      <img class="img-fluid" src="<?php echo base_url()."foto/dokumentasi/".$value->nama_gambar;?>" alt="Card image cap">
    </div>
  <?php endforeach; ?>
  <!-- Grid column -->

  <!-- Grid column -->


</div>
<!-- Grid row -->
<script>
$(function() {
var selectedClass = "";
$(".filter").click(function(){
selectedClass = $(this).attr("data-rel");
$("#gallery").fadeTo(100, 0.1);
$("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
setTimeout(function() {
$("."+selectedClass).fadeIn().addClass('animation');
$("#gallery").fadeTo(300, 1);
}, 300);
});
});
</script>
