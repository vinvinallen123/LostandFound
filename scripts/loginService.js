
function validateNumFields(element) {
    element.value = element.value.replace(/[0-9]/g, " ");
}







document.getElementById("loginUsername").addEventListener("input", function () {
    this.value = this.value.replace(/\s/g, "");
});


document.getElementById("loginPassword").addEventListener("input", function () {
    this.value = this.value.replace(/\s/g, "");
});









function loginFunc() {
    var username = document.getElementById("loginUsername").value;
    var password = document.getElementById("loginPassword").value;

    if (username.trim() === "" || password.trim() === "") {
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
            loginUsername: username,
            loginPassword: password
        },
        success: function(returnedData) {
            if (returnedData.includes("Login successful")) {
                Swal.fire({
                    title: "Success!",
                    text: returnedData,
                    icon: "success"
                }).then(() => {
                    window.location.href = "../views/dashboardPage.php";
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