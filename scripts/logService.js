const itemName = document.getElementById("itemName");
if (itemName) {
    itemName.addEventListener("input", function () {
        this.value = this.value.replace(/^\s+/, "");
    });
}

const itemDesc = document.getElementById("itemDesc");
if (itemDesc) {
    itemDesc.addEventListener("input", function () {
        this.value = this.value.replace(/^\s+/, "");
    });
}




function changeStatus(logID) {
    Swal.fire({
        title: "Update Status",
        input: "select",
        inputOptions: {
            Missing: "Missing",
            Found: "Found",
            Claimed: "Claimed"
        },
        inputPlaceholder: "Select status",
        showCancelButton: true
    }).then((result) => {

        if (!result.isConfirmed || !result.value) return;

        $.ajax({
            url: "../controllers/controller.php",
            type: "POST",
            data: {
                logID: logID,
                itemStatus: result.value
            },
            success: function(res) {
                if (res.includes("successfully")) {
                    Swal.fire("Updated", res, "success")
                    .then(() => location.reload());
                } else {
                    Swal.fire("Error", res, "error");
                }
            }
        });

    });
}


function removeLogFunc(logID) {
    Swal.fire({
        title: "Are you sure?",
        text: "This item will be deleted.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {

        if (!result.isConfirmed) return;

        $.ajax({
            url: "../controllers/controller.php",
            type: "POST",
            data: {
                deleteLogID: logID
            },
            success: function(res) {

                if (res.includes("successfully")) {
                    Swal.fire("Deleted", res, "success")
                    .then(() => location.reload());
                } else {
                    Swal.fire("Error", res, "error");
                }

            }
        });

    });
}





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

    if (!window.labels || !window.data) return;

    const ctx1 = document.getElementById("chart1");
    if (ctx1) {
        new Chart(ctx1, {
            type: "bar",
            data: {
                labels: window.labels,
                datasets: [{
                    label: "Items Per Day",
                    data: window.data,
                    borderWidth: 1
                }]
            }
        });
    }

    const ctx2 = document.getElementById("chart2");
    if (ctx2 && window.weekLabels && window.weekData) {
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: window.weekLabels,
                datasets: [{
                    label: "Weekly Reports",
                    data: window.weekData,
                    borderWidth: 1
                }]
            }
        });
    }

    const ctx3 = document.getElementById("chart3");
    if (ctx3 && window.statusData) {
        new Chart(ctx3, {
            type: "pie",
            data: {
                labels: ["Missing", "Claimed"],
                datasets: [{
                    data: window.statusData,
                    borderWidth: 1
                }]
            }
        });
    }

});