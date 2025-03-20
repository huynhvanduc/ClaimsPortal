<?php
namespace ClaimPortal\Controllers;

require_once __DIR__ . '/../Models/Claim.php';

use ClaimPortal\Models\Claim;

class ClaimController {
    private $claimModel;
    private $lastMessage;

    public function __construct() {
        $this->claimModel = new Claim();
        $this->lastMessage = '';
    }

    public function index($success = null, $error = null) {
        include_once __DIR__ . '/../Views/templates/header.php';
        include_once __DIR__ . '/../Views/templates/claim_list.php';
        include_once __DIR__ . '/../Views/templates/add_claim.php';
        include_once __DIR__ . '/../Views/templates/footer.php';
    }

    public function search() {
        error_log("POST data: " . print_r($_POST, true));
        $search = $_POST['search'] ?? '';
        error_log("Search value: " . $search);
        
        if (empty($search)) {
            $claims = $this->claimModel->getAllClaims();
            header('Content-Type: application/json');
            echo json_encode(['claims' => $claims]);
            return;
        }
    
        $claims = $this->claimModel->getAllClaims($search);
        header('Content-Type: application/json');
        echo json_encode(['claims' => $claims]);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
    
        $jobID = $_POST['JobID'] ?? '';
        $insuranceClaimNo = $_POST['InsuranceClaimNo'] ?? '';
        $vehicleRego = $_POST['VehicleRego'] ?? '';
        $owner = $_POST['Owner'] ?? '';
    
        // Validate data
        $errors = [];
        if (empty($jobID)) {
            $errors[] = 'Job ID is required';
        }
        if (empty($insuranceClaimNo)) {
            $errors[] = 'Insurance Claim No is required';
        }
        if (empty($vehicleRego)) {
            $errors[] = 'Vehicle Rego is required';
        }
        if (empty($owner)) {
            $errors[] = 'Owner is required';
        }
    
        if (!empty($errors)) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
            return;
        }
    
        try {
            if ($this->claimModel->addClaim($jobID, $insuranceClaimNo, $vehicleRego, $owner)) {
                $this->lastMessage = '<div class="success-message">Claim added successfully</div>';
                $claims = $this->claimModel->getAllClaims();
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'claims' => $claims, 'message' => 'Claim added successfully']);
            } else {
                $this->lastMessage = '<div class="error-message">Failed to add claim</div>';
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to add claim']);
            }
        } catch (Exception $e) {
            error_log("Error in add(): " . $e->getMessage());
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function message() {
        header('Content-Type: application/json');
        echo json_encode(['message' => $this->lastMessage]);
    }

    // New action: Return the initial list of claims
    public function list() {
        $claims = $this->claimModel->getAllClaims();
        header('Content-Type: application/json');
        echo json_encode(['claims' => $claims]);
    }
}