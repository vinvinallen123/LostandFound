<?php
session_start();

require_once "../BL/userManager.php";
require_once "../BL/logManager.php";

$usermanager = new userManager();
$logmanager = new logManager();

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

else if (
    isset($_POST["loginUsername"], $_POST["loginPassword"])
) {
    $usermanager->loginUserFunc(
        $_POST["loginUsername"],
        $_POST["loginPassword"]
    );
    exit;
}

else if (
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
            Your extended help and cooperation mean a lot. By reporting this item,
            you are helping another student or staff member have a better chance of recovering
            something important to them.
        </p>

        <p>
            Our team will review your submitted report and update the item status once there are further developments.
        </p>

        <p>
            Thank you again for your honesty, support, and participation.
        </p>

        <br>

        <p style="font-size: 21px; font-weight: bold;">
            📦 The Mission: Possible Team
        </p>

        <hr style="border: none; border-top: 1px solid #ddd; margin: 35px 0;">

        <p style="font-size: 13px; color: #666; text-align: center;">
            Mission: Possible • Lost and Found System • Thank you for helping our community
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

else if (
    isset($_POST["logID"], $_POST["itemStatus"])
) {
    $logmanager->updateLogFunc(
        $_POST["logID"],
        $_POST["itemStatus"],
        1
    );
    exit;
}

else if (isset($_POST["deleteLogID"])) {
    $logmanager->deleteLogFunc($_POST["deleteLogID"]);
    exit;
}
?>