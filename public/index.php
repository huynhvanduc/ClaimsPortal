<?php
// Start of index.php file
define('BASE_URL', '/claim-portal');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure no output is sent before returning JSON
ob_start();

require_once __DIR__ . '/../src/Controllers/ClaimController.php';

use ClaimPortal\Controllers\ClaimController;

// Get the action parameter from query string or POST
$action = $_POST['action'] ?? ($_GET['action'] ?? 'index');
error_log("Action received: " . $action); // Log for debugging

// Get success or error messages if present
$success = $_GET['success'] ?? null;
$error = $_GET['error'] ?? null;

$controller = new ClaimController();

// Route the request to the corresponding method in ClaimController
switch ($action) {
    case 'index':
        $controller->index($success, $error);
        break;
    case 'search':
        $controller->search();
        exit;
    case 'add':
        $controller->add();
        exit;
    case 'message':
        $controller->message();
        exit;
    case 'list':
        $controller->list();
        exit;
    default:
        $controller->index($success, $error);
        break;
}

// End output buffering and send data
ob_end_flush();