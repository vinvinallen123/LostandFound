<?php

class logModel {
    private $connect;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function createLog($itemName, $itemDesc, $itemStatus, $userID): mixed {
        $insertQuery = "INSERT INTO logs_tbl (item_name, item_desc, item_status, user_id, admin_id, date_reported, date_claimed)
                        VALUES
                        (:item_name, :item_desc, :item_status, :user_id, :admin_id, :date_reported, :date_claimed)";

        $dateNow = date('Y-m-d H:i:s');
        $adminID = null;
        $dateClaimed = null;

        $response = $this->connect->prepare($insertQuery);

        $response->bindParam(":item_name", $itemName);
        $response->bindParam(":item_desc", $itemDesc);
        $response->bindParam(":item_status", $itemStatus);
        $response->bindParam(":user_id", $userID);
        $response->bindParam(":admin_id", $adminID);
        $response->bindParam(":date_reported", $dateNow);
        $response->bindParam(":date_claimed", $dateClaimed);

        return $response->execute();
    }

    public function readLogs(): mixed {
        $selectQuery = "SELECT * FROM logs_tbl ORDER BY date_reported DESC";
        $response = $this->connect->prepare($selectQuery);
        $response->execute();
        return $response;
    }

    public function updateLog($logID, $itemStatus, $adminID): mixed {
        $updateQuery = "UPDATE logs_tbl
                        SET item_status = :item_status,
                            admin_id = :admin_id
                        WHERE log_id = :log_id";

        $response = $this->connect->prepare($updateQuery);

        $response->bindParam(":item_status", $itemStatus);
        $response->bindParam(":admin_id", $adminID);
        $response->bindParam(":log_id", $logID);

        $response->execute();
        return $response;
    }

    public function deleteLog($logID): mixed {
        $deleteQuery = "DELETE FROM logs_tbl WHERE log_id = :log_id";

        $response = $this->connect->prepare($deleteQuery);
        $response->bindParam(":log_id", $logID);
        $response->execute();

        return $response;
    }
public function getItemsPerDay(): mixed {
    $query = "SELECT DATE(date_reported) AS report_date, COUNT(*) AS total
              FROM logs_tbl
              GROUP BY DATE(date_reported)
              ORDER BY DATE(date_reported) ASC";

    $stmt = $this->connect->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function getReportsByDayName(): mixed {
    $query = "SELECT DAYNAME(date_reported) AS day_name, COUNT(*) AS total
              FROM logs_tbl
              GROUP BY DAYNAME(date_reported)
              ORDER BY FIELD(DAYNAME(date_reported),
              'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')";

    $stmt = $this->connect->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}




























































?>