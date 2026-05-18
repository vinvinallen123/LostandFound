<?php
session_start();

require_once "../BL/adminManager.php";

$adminManager = new adminManager();


if (
    isset($_POST["adminFirstName"], $_POST["adminLastName"], $_POST["adminEmail"], $_POST["adminUsername"], $_POST["adminPassword"])
) {

    $email = $_POST["adminEmail"];

    if (
        !str_ends_with($email, "@gmail.com") &&
        !str_ends_with($email, "@yahoo.com")
    ) {
        echo "Only Gmail and Yahoo emails are allowed";
        exit;
    }

    $adminManager->addAdminFunc(
        $_POST["adminFirstName"],
        $_POST["adminLastName"],
        $_POST["adminEmail"],
        $_POST["adminUsername"],
        $_POST["adminPassword"]
    );

    exit;
}


if (
    isset($_POST["adminLoginUsername"], $_POST["adminLoginPassword"])
) {

    $adminManager->loginAdminFunc(
        $_POST["adminLoginUsername"],
        $_POST["adminLoginPassword"]
    );

    exit;
}
?>