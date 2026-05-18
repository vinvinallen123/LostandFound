<?php
session_start();

require_once "../BL/userManager.php";
require_once "../BL/logManager.php";

$usermanager = new userManager();
$logmanager = new logManager();

/* USER REGISTER */
if (
    isset($_POST["fName"], $_POST["lName"], $_POST["email"], $_POST["username"], $_POST["password"])
) {
    $usermanager->addUserFunc(
        $_POST["fName"],
        $_POST["lName"],
        $_POST["email"],
        $_POST["username"],
        $_POST["password"]
    );
    exit;
}

/* USER LOGIN */
if (
    isset($_POST["loginUsername"], $_POST["loginPassword"])
) {
    $usermanager->loginUserFunc(
        $_POST["loginUsername"],
        $_POST["loginPassword"]
    );
    exit;
}

/* ADD LOG */
if (
    isset($_POST["itemName"], $_POST["itemDesc"], $_POST["itemStatus"])
) {
    $logmanager->addLogFunc(
        $_POST["itemName"],
        $_POST["itemDesc"],
        $_POST["itemStatus"],
        $_SESSION["user_id"]
    );

    require_once __DIR__ . "/../helper/send.php";

    $body = '
    <div style="font-family: Arial, sans-serif; color: #222; line-height: 1.6; font-size: 16px; max-width: 720px; margin: auto; padding: 35px;">
        <p>Hi ' . htmlspecialchars($_SESSION["first_name"]) . ',</p>

        <p>
            We would like to sincerely thank you for submitting an item report through
            <strong>Mission: Possible Lost and Found System</strong>.
        </p>

        <p>
            Our team will review your submitted report and update the item status once there are further developments.
        </p>

        <br>

        <p style="font-size: 21px; font-weight: bold;">
            📦 The Mission: Possible Team
        </p>
    </div>
    ';

    sendEmail(
        $_SESSION["user_email"],
        $_SESSION["first_name"],
        "Thank you for submitting an item report",
        $body
    );

    exit;
}

/* UPDATE LOG */
if (
    isset($_POST["logID"], $_POST["itemStatus"])
) {
    $logmanager->updateLogFunc(
        $_POST["logID"],
        $_POST["itemStatus"],
        $_SESSION["admin_id"] ?? $_SESSION["user_id"]
    );
    exit;
}

/* DELETE LOG */
if (isset($_POST["deleteLogID"])) {
    $logmanager->deleteLogFunc($_POST["deleteLogID"]);
    exit;
}