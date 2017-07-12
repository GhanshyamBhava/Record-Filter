$( function() {

  var mxp = $( "#maxprice" ).val();
  var mnp = $( "#minprice" ).val();


  $( "#slider" ).slider({
      range: true,
      min: 3,
      max: 100,
      values: [ mnp, mxp ],
      slide: function(event, ui) {
        $( "#amount" ).text( "From" + ui.values[0] + " - To " + ui.values[1] );
      },
      stop: function (event, ui) {
        $( "#minprice" ).val(ui.values[0]);
        $( "#maxprice" ).val(ui.values[1]);
      }
  });
  $("#amount").text("From "+$("#slider").slider("values",0)+"-To "+$("#slider").slider("values",1));

});

function setpageno(pageno) {
    $('#pageno').val(pageno);
    $('form').submit();
}