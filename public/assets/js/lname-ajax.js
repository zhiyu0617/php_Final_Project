function validateLName() {
    var lastName = document.getElementById("input5").value;
    var messageBox = document.getElementById("lastname-error");
  
    if (lastName.length == 0) {
        messageBox.innerHTML = "";
        messageBox.style.color = "initial";
        return;
    } else {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "lname-ajax.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var responseText = this.responseText.trim();
                messageBox.innerHTML = responseText;
                messageBox.style.color = responseText === "Valid!" ? "green" : "red";
            }
        };
        xhr.send("lastName=" + encodeURIComponent(lastName));
    }
  }