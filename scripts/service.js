
function validateNumFields(element) {
    element.value = element.value.replace(/[0-9]/g, " ");
}


document.getElementById("firstName").addEventListener("input", function () {
    validateNumFields(this);
});


document.getElementById("lastName").addEventListener("input", function () {
    validateNumFields(this);
});


document.getElementById("username").addEventListener("input", function () {
    this.value = this.value.replace(/\s/g, "");
});


document.getElementById("email").addEventListener("input", function () {
    this.value = this.value.replace(/\s/g, "");
});


document.getElementById("password").addEventListener("input", function () {
    this.value = this.value.replace(/\s/g, "");
});




















function submitFunc() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var email = document.getElementById("email").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

      // FIRST NAME VALIDATION
if (firstName.length < 3 || firstName.length > 10) {
    Swal.fire({
        title: "Invalid First Name",
        text: "First name must be between 3 and 10 characters.",
        icon: "error"
    });
    return;
}

// LAST NAME VALIDATION
if (lastName.length < 3 || lastName.length > 20) {
    Swal.fire({
        title: "Invalid Last Name",
        text: "Last name must be between 3 and 20 characters.",
        icon: "error"
    });
    return;
}



    if (
        firstName.trim() === "" ||
        lastName.trim() === "" ||
        email.trim() === "" ||
        username.trim() === "" ||
        password.trim() === ""
    ) {
        Swal.fire({
            title: "Error!",
            text: "Please fill in all fields.",
            icon: "error"
        });
        return;
    }

    $.ajax({
        url: "../controllers/controller.php",
        type: "POST",
        data: {
            fName: firstName,
            lName: lastName,
            email: email,
            username: username,
            password: password
        },
        success: function(returnedData) {
            if (returnedData.includes("successfully")) {
                Swal.fire({
                    title: "Success!",
                    text: returnedData,
                    icon: "success"
                }).then(() => {
                    window.location.href = "../views/loginPage.php";
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: returnedData,
                    icon: "error"
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                title: "Error!",
                text: xhr.status + " : " + xhr.responseText,
                icon: "error"
            });
        }
    });
}

