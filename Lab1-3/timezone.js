//jquey stuff
// $(document).ready();//*Once the document is ready execute the inner function
$(document).ready(function () {
  //Returns the no. of minuts ahead/behind greenwich meridian
  var offset = new Date().getTimezoneOffset();
  //Return no of milliseconds since 1970/01/01 //*https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date/getTime
  var timestamp = new Date().getTime();

  //Convert time to Universal Time Coordinated
  var utc_timestamp = timestamp + 60000 * offset; // * offsetin minutes

  $("#time_zone_offset").val(offset);
  $("#utc_timestamp").val(utc_timestamp);
  //Line 11 sets the value attribute in the form with  name= "time_zone_offset"
  //Line 12 sets the value attribute in the form with  name= "utc_timestamp"
});
