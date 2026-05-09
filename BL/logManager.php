<?php

require_once "../models/database.php";
require_once "../models/logModel.php";

class logManager {

    private $logModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connectionDB();
        $this->logModel = new logModel($db);
    }

    public function addLogFunc($itemName, $itemDesc, $itemStatus, $userID): void {
        try {
            if ($this->logModel->createLog($itemName, $itemDesc, $itemStatus, $userID)) {
                echo "Log added successfully";
            } else {
                echo "Error adding log";
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        
        
        
            }
    }




    public function getLogsFunc(): mixed {
    $response = $this->logModel->readLogs();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

public function updateLogFunc($logID, $itemStatus, $adminID): void {
    try {
        if ($this->logModel->updateLog($logID, $itemStatus, $adminID)) {
            echo "Log updated successfully";
        } else {
            echo "Error updating log";
        }
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
}


public function deleteLogFunc($logID): void {
    try {
        if ($this->logModel->deleteLog($logID)) {
            echo "Log deleted successfully";
        } else {
            echo "Error deleting log";
        }
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
}

public function getDailyReportsFunc() {
    return $this->logModel->getDailyReports();
}

}
?>