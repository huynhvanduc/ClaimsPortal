# Claim Portal

**Claim Portal** is a simple web application for managing insurance claims. Users can view a list of claims, search for claims by keyword, and add new claims. The application is built using PHP, JavaScript, and utilizes HTMX for seamless AJAX requests.

## Key Features

- **View Claims List:** Displays the full list of claims upon page load.
- **Search Claims:** Search claims by keyword (Job ID, Insurance Claim No, Vehicle Rego, or Owner). When the search field is empty, the full list is displayed.
- **Add New Claim:** Users can add a new claim with fields for Job ID, Insurance Claim No, Vehicle Rego, and Owner.
  - Validates data before submission.
  - Displays notifications as toasts (success or error).
  - Updates the claims list automatically upon successful addition.
- **Loading Animation:** Shows a smooth loading animation during requests (loading list, searching, adding claims).
- **Custom Toast Component:** Notifications are displayed as toasts (toastr) for success or error messages.

## Directory Structure
CLAIMPORTAL/
├── .vscode/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   ├── loading.css
│   │   │   ├── style.css
│   │   │   └── toast.css
│   │   └── js/
│   │       ├── addClaim.js
│   │       ├── claimList.js
│   │       ├── loading.js
│   │       └── toast.js
│   ├── .htaccess
│   └── index.php
├── src/
│   ├── Config/
│   │   └── Database.php
│   ├── Controllers/
│   │   └── ClaimController.php
│   ├── Models/
│   │   └── Claim.php
│   └── Views/
│       └── templates/
│           ├── add_claim.php
│           ├── claim_list.php
│           ├── footer.php
│           ├── header.php
│           ├── loading.php
│           └── toast.php
├── README.md
└── database.sql

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern browser supporting JavaScript and HTMX (Chrome, Firefox, Edge, etc.)

## Installation

### 1. Clone the Repository
Clone the project to your local machine:

```bash
git clone <repository-url>
cd CLAIMPORTAL
2. Configure the Database
Create a MySQL database:
sql
CREATE DATABASE claim_portal;
USE claim_portal;

CREATE TABLE claims (
    id INT AUTO_INCREMENT PRIMARY KEY,
    JobID VARCHAR(50) NOT NULL,
    InsuranceClaimNo VARCHAR(50) NOT NULL,
    VehicleRego VARCHAR(50) NOT NULL,
    Owner VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Update the database connection details in src/Config/Database.php:
php
$this->pdo = new \PDO("mysql:host=localhost;dbname=your_db", "your_username", "your_password");
3. Configure BASE_URL
Open the public/index.php file and update the BASE_URL according to your domain:

php
define('BASE_URL', '/claim-portal'); // Adjust if necessary
4. Set Up the Server
Place the CLAIMPORTAL directory in your web server's root directory (e.g., /var/www/html for Apache).
Ensure the server supports PHP and MySQL.
5. Access the Application
Open your browser and navigate to:

text
http://your-domain/claim-portal
Usage
1. View Claims List
Upon accessing the page, the full list of claims is loaded automatically.
A loading animation is displayed during the loading process.
2. Search Claims
Enter a keyword in the search field (Job ID, Insurance Claim No, Vehicle Rego, or Owner).
Results are displayed after a 500ms delay.
Clear the search field to display the full list of claims.
3. Add a New Claim
Fill in the "Add New Claim" form (Job ID, Insurance Claim No, Vehicle Rego, Owner).
Click the "Add Claim" button:
If validation fails (e.g., fields are empty), an error toast (red) will be displayed.
If validation succeeds, the request is sent, a loading animation is shown, and a success toast (green) will be displayed.
The claims list is updated automatically, and the form is cleared.
Customization
1. Loading Animation
Files: assets/css/loading.css and assets/js/loading.js.
Customize the loading appearance (color, spinner size) in loading.css.
Adjust the minimum display duration in addClaim.js and claimList.js (currently set to 500ms).
2. Toast Component
Files: assets/css/toast.css and assets/js/toast.js.
Customize the toast appearance (color, position, display duration) in toast.css and toast.js.
Example: Change the toast display duration:
javascript
window.showToast = function(message, type = 'success', duration = 5000) { // Change 3000 to 5000
    // ...
};