
document.getElementById("itemName").addEventListener("input", function () {
    this.value = this.value.replace(/^\s+/, "");
});


document.getElementById("itemDesc").addEventListener("input", function () {
    this.value = this.value.replace(/^\s+/, "");
});













function submitItem() {

    var itemName = document.getElementById("itemName").value;
    var itemDesc = document.getElementById("itemDesc").value;
    var itemStatus = document.getElementById("itemStatus").value;

    if (
        itemName.trim() === "" ||
        itemDesc.trim() === "" ||
        itemStatus === ""
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
            itemName: itemName,
            itemDesc: itemDesc,
            itemStatus: itemStatus
        },
        success: function(returnedData) {
            if (returnedData.includes("successfully")) {
                Swal.fire({
                    title: "Success!",
                    text: returnedData,
                    icon: "success"
                }).then(() => {
                    location.reload();
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
document.addEventListener("DOMContentLoaded", function () {
    var barChart = document.getElementById("myChart");

    new Chart(barChart, {
        type: "bar",
        data: {
            labels: window.barData.labels,
            datasets: [{
                label: "Items Reported Per Day",
                data: window.barData.data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});


