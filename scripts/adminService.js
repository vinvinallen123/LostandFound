function updateLogFunc(logID, itemName, itemDesc, itemStatus, adminID) {
    $.ajax({
        url: "../controllers/controller.php",
        type: "POST",
        data: {
            logID: logID,
            itemName: itemName,
            itemDesc: itemDesc,
            itemStatus: itemStatus,
            adminID: adminID
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

function removeLogFunc(logID) {
    Swal.fire({
        title: "Are you sure?",
        text: "This item will be deleted.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../controllers/controller.php",
                type: "POST",
                data: {
                    deleteLogID: logID
                },
                success: function(returnedData) {
                    if (returnedData.includes("successfully")) {
                        Swal.fire({
                            title: "Deleted!",
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
    });
}
function changeStatus(logID) {
    Swal.fire({
        title: "Update Status",
        input: "select",
        inputOptions: {
            "Missing": "Missing",
            "Found": "Found",
            "Claimed": "Claimed"
        },
        inputPlaceholder: "Select new status",
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed && result.value) {

            $.ajax({
                url: "../controllers/controller.php",
                type: "POST",
                data: {
                    logID: logID,
                    itemStatus: result.value 
                },
                success: function(response) {
                    if (response.includes("successfully")) {
                        Swal.fire("Updated!", response, "success")
                        .then(() => location.reload());
                    } else {
                        Swal.fire("Error!", response, "error");
                    }
                }
            });

        }
    });
}
