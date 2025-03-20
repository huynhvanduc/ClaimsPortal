<?php
namespace ClaimPortal\Models;

require_once __DIR__ . '/../Config/Database.php';

use ClaimPortal\Config\Database;

class Claim {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllClaims($search = '') {
        $query = "SELECT * FROM claim";
        if (!empty($search)) {
            $query .= " WHERE JobID LIKE :search OR InsuranceClaimNo LIKE :search OR VehicleRego LIKE :search OR Owner LIKE :search";
        }
        $stmt = $this->db->prepare($query);
        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%");
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addClaim($jobID, $insuranceClaimNo, $vehicleRego, $owner) {
        $query = "INSERT INTO claim (JobID, InsuranceClaimNo, VehicleRego, Owner) VALUES (:jobID, :insuranceClaimNo, :vehicleRego, :owner)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':jobID', $jobID);
        $stmt->bindParam(':insuranceClaimNo', $insuranceClaimNo);
        $stmt->bindParam(':vehicleRego', $vehicleRego);
        $stmt->bindParam(':owner', $owner);
        return $stmt->execute();
    }
}