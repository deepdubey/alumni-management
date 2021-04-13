// After form loads focus will go to User id field.
// function firstfocus() {
//   document.getElementById("email").focus();
//   return true;
// }

function ValidateEmail() {
  var uemail = document.getElementById("email");
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (uemail.value.match(mailformat)) {
    // document.getElementById("password").focus();
    document.getElementById("emailerror").innerHTML = "";
    return true;
  } else {
    document.getElementById("emailerror").innerHTML = "Invalid email adreess";
    // uemail.focus();
    return false;
  }
}
// This function will validate Password.
function passid_validation() {
  var passid = document.getElementById("password");
  var passw = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,20}$/;
  if (!passid.value.match(passw)) {
    document.getElementById("passworderror").innerHTML =
      "Password must be 8 to 20 character, aleast 1 number and 1 special character";
    // passid.focus();
    return false;
  }
  // // Focus goes to next field i.e. Name.
  // document.getElementById("cpassword").focus();
  document.getElementById("passworderror").innerHTML = "";
  return true;
}

function check_pass() {
  if (
    document.getElementById("password").value ==
    document.getElementById("cpassword").value
  ) {
    document.getElementById("cpassworderror").innerHTML = "";
    document.getElementById("submit").disabled = false;
  } else {
    document.getElementById("cpassworderror").innerHTML =
      "Password didn't match";
    document.getElementById("submit").disabled = true;
  }
}
