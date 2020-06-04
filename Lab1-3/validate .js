function validateForm() {
  var fname = document.forms["user_details"]["first_name"].value;
  var lname = document.forms["user_details"]["last_name"].value; //!Check whether it is first or lastd
  var city = document.forms["user_details"]["city_name"].value;
  if (fname == null || lname == "" || city == "") {
    alert("All deails are required were not supplied");
    return false;
  }
  return true;
}
