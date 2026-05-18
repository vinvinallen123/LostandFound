<?php
session_start();

require_once "../BL/adminManager.php";

$adminManager = new adminManager();


if (
    isset($_POST["adminFirstName"], $_POST["adminLastName"], $_POST["adminEmail"], $_POST["adminUsername"], $_POST["adminPassword"])
) {
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