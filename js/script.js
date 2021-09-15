$(document).ready(function () {
  $.ajax({
    type: "get",
    url: "https://rs-bed-covid-api.vercel.app/api/get-provinces",
    dataType: "json",
    success: function (response) {
      let provinsi = response.provinces;
      $.each(provinsi, function (i, data) { 
         $("#provinsi").append(`
          <option id="see-detail" value="`+ data.id +`">`+ data.name +`</option>
         
         `);
      });
    }
  });
  $("#provinsi").change(function () {
    $("#city").html("");
    $.ajax({
      type: "get",
      url: "https://rs-bed-covid-api.vercel.app/api/get-cities",
      data: {
        "provinceid" : $(this).val()
      },
      dataType: "json",
      success: function (kota) {
        let gedung = kota.cities;
        $.each(gedung, function (j, stats) { 
           $("#city").append(`
            <option value="`+ stats.id +`">`+ stats.name +`</option>
           `);
        });

      }
    });
    // let change = $(this).val();
    // console.log(change);
  });
});
