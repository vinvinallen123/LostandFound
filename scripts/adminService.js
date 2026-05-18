function adminSubmitFunc() {
    $.ajax({
        url: "../controllers/adminController.php",
        type: "POST",
        data: {
            adminFirstName: $("#firstName").val(),
            adminLastName: $("#lastName").val(),
            adminEmail: $("#email").val(),
            adminUsername: $("#username").val(),
            adminPassword: $("#password").val()
        },
        success: function(res) {
            if (res.includes("successfully")) {
                Swal.fire("Success", res, "success")
                .then(() => window.location.href = "adminLoginPage.php");
            } else {
                Swal.fire("Error", res, "error");
            }
        }
    });
}

function adminLoginFunc() {
    $.ajax({
        url: "../controllers/adminController.php",
        type: "POST",
        data: {
            adminLoginUsername: $("#loginUsername").val(),
            adminLoginPassword: $("#loginPassword").val()
        },
        success: function(res) {
            if (res.includes("Login successful")) {
                Swal.fire("Success", res, "success")
                .then(() => window.location.href = "../views/adminDashboardPage.php");
            } else {
                Swal.fire("Error", res, "error");
            }
        }
    });
}