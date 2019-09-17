function formValidation() {
	"use strict";
var name = document.forms["SignupForm"]["name"];
var username = document.forms["SignupForm"]["username"];
var email = document.forms["SignupForm"]["email"];
var phone = document.forms["SignupForm"]["mobile"];
var password = document.forms["SignupForm"]["password"];
var cpassword = document.forms["SignupForm"]["Cpassword"];

var nameLen =name.value.len;
var usernameLen =username.value.len;
var emailLen =email.value.len;
var phoneLen =phone.value.len;
var passwordLen =password.value.len;
var cpasswordLen =cpassword.value.len;

//regex
var letters = /^[A-Za-z]+$/;
var numbers = /^[0-9]+$/;
var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\. \w{2,3})+$/;

if (nameLen == 0) {
  alert("Please input your name");
  name.focus();
  return false;
}
else if (usernameLen == 0 || !username.value.match(letters))
{
  alert("Please fill Username, alphabet characters only!");
  username.focus();
  return false;
}
else if (emailLen == 0 || email.value.match(mailFormat))
{
  alert("Please fill in a right email address");
  email.focus();
  return false;
}
else if (phoneLen == 0 || !phone.value.match(numbers))
{
  alert("Please fill your phone number with numbers only");
  phone.focus();
  return false;
}
else if (passwordLen == 0){
  alert("Please input your password");
  password.focus();
  return false;
}
else if (cpasswordLen == 0 || cpassword !== password) {
  alert("Please input a matching password");
  cpassword.focus();
  return false;
}
else {
  alert("Form Submitted Successfully");
  window.location.reload();
}
}
