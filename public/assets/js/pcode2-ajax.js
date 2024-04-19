function validatePass2(){
    var confirmPasswordInput = document.getElementById("input3");
    var confirmPassword = confirmPasswordInput.value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "pcode2-ajax.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var errorMsg = document.getElementById("confirmpassword-error");
            errorMsg.innerText = xmlhttp.responseText;
            errorMsg.style.color = xmlhttp.responseText === "Valid!" ? "green" : "red";
        }
    };

    // Send the AJAX request with the confirm password data
    xmlhttp.send("password=" + encodeURIComponent(confirmPassword));
}