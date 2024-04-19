function validateUsername() {
  var username = document.getElementById("input1").value;
  var errorSpan = document.getElementById("username-error");

  if (username.length === 0) {
      errorSpan.innerHTML = "";
      return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "uname-ajax.php", true); // make sure this path is correct
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          errorSpan.innerHTML = this.responseText;
          errorSpan.style.color = this.responseText === "Valid!" ? "green" : "red";
      }
  };
  xhr.send("username=" + encodeURIComponent(username));
}
