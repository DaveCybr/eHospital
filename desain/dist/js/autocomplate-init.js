var provinsi="";
var prov_id = 35;
var kota = "";
var kota_id = "";
var status_kota = 1;
var status_provinsi = 1;
var options = {
    url: "http://utamahusada.com/sim/Pekerjaan/get_data",

    getValue: "name",

    template: {
        type: "description",
        fields: {
            description: "email"
        }
    },

    list: {
        match: {
            enabled: true
        }
    },

    theme: "plate-dark"
};

$("#pekerjaan").easyAutocomplete(options);

// $(document).on("keyup","#provinsi",function(){
//   // alert("dhja");
//
//
// })
var options2 = {
    url: "http://utamahusada.com/sim/Pekerjaan/get_provinsi",

    getValue: "name",

    template: {
        type: "description",
        fields: {
            description: "email"
        }
    },

    list: {
        match: {
            enabled: true
        }
    },

    theme: "plate-dark"
};

$("#provinsi").easyAutocomplete(options2);
$(document).on("change","#provinsi",function(){
  // alert(provinsi);
  provinsi = $(this).val();
  // alert(provinsi);
  $.ajax({
      type  : 'POST',
      url   : "http://utamahusada.com/sim/Pekerjaan/validasi_provinsi",
      async : false,
      dataType : 'json',
      data: { prov:provinsi},
      success : function(response){
        // alert(response.status);
        if (response.status==0) {
          // alert("Provinsi Tidak Terdaftar!!!");
          $("#provinsi").focus();

        }else{
          prov_id = response.id;
          $("#kota").val();
          get_kotaku();
        }
        status_provinsi = response.status;
      }
    })

})
$(document).on("change","#kota",function(){
  // alert(provinsi);
  kota = $(this).val();
  // alert(provinsi);
  $.ajax({
      type  : 'POST',
      url   : "http://utamahusada.com/sim/Pekerjaan/validasi_kota",
      async : false,
      dataType : 'json',
      data: { kota:kota},
      success : function(response){
        // alert(response.status);
        if (response.status==0) {
          // alert("Provinsi Tidak Terdaftar!!!");
          $("#kota").focus();

        }else{
          kota_id = response.id;
          // $("#kota").val();
          // get_kotaku();
        }
        status_kota = response.status;
      }
    })
    // alert("status_kota :"+status_kota+"status_provinsi : "+status_provinsi);

})
$(document).ready(function(){
  get_kotaku();
})
$(document).on("click",".simpan_pasien",function(){
  if (prov_id==0||kota_id==0) {
    alert("Provinsi Atau Kota Tidak Terdaftar!!!");
  }else{
    $.ajax({
        type  : 'POST',
        url   : "http://utamahusada.com/sim/Pekerjaan/cek_provkota",
        async : false,
        dataType : 'json',
        data: { id_kota:kota_id,id_prov:prov_id},
        success : function(response){
          // alert(response.status);
          if (response.status==0) {
            alert("Provinsi Atau Kota Tidak Sesuai!!!");
            // $("#kota").focus();

          }else{
            $("#form_pasien").submit();
            // $("#kota").val();
            // get_kotaku();
          }
          // status_kota = response.status;
        }
      })
  }
})
function get_kotaku(){
  var options3 = {
      url: "http://utamahusada.com/sim/Pekerjaan/get_kota/"+prov_id,

      getValue: "name",

      template: {
          type: "description",
          fields: {
              description: "email"
          }
      },

      list: {
          match: {
              enabled: true
          }
      },

      theme: "plate-dark"
  };

  $("#kota").easyAutocomplete(options3);

}
