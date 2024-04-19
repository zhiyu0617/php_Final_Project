function validatePass(){
  var passwordInput = document.getElementById("password");
  var password = passwordInput.value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "pcode1-ajax.php", true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          var errorMsg = document.getElementById("password-error");
          errorMsg.innerText = xmlhttp.responseText;
          errorMsg.style.color = xmlhttp.responseText === "Valid!" ? "green" : "red";
          if (xmlhttp.responseText === "Valid!") {
              sessionStorage.setItem('password', password); // Storing password in session storage for later validation
          }
      }
  };

  // Send the AJAX request with the password data
  xmlhttp.send("password=" + encodeURIComponent(password));
}
