function validateFirstName() {
    var firstName = document.getElementById("input4").value; // Ensure this ID matches your input field
    var messageBox = document.getElementById("firstNameMessage");
   
    if (firstName.length == 0) {
      messageBox.innerHTML = "";
      messageBox.style.color = "initial";
      return;
    } else {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "fname-ajax.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = this.responseText.trim();
          messageBox.innerHTML = responseText;
          messageBox.style.color = responseText === "Valid!" ? "green" : "red";
        }
      };
      xhr.send("firstName=" + encodeURIComponent(firstName));
    }
  }