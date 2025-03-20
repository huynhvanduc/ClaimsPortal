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

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern browser supporting JavaScript and HTMX (Chrome, Firefox, Edge, etc.)

## Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd ClaimPortal
```

## Project Structure

ClaimPortal/
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
└── src/
    ├── Config/
    │   └── Database.php
    ├── Controllers/
    │   └── ClaimController.php
    ├── Models/
    │   └── Claim.php
    └── Views/
        └── templates/
            ├── add_claim.php
            ├── claim_list.php
            ├── footer.php
            ├── header.php
            ├── loading.php
            └── toast.php

### 2. Configure the Database
Create a MySQL database:
```sql
CREATE DATABASE claim_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE claims (
    id INT AUTO_INCREMENT PRIMARY KEY,
    JobID VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    InsuranceClaimNo VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    VehicleRego VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    Owner VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
);
```

Update database configuration in `src/Config/Database.php`:
```php
private $host = 'localhost';
private $dbname = 'claim_portal';
private $username = 'your_username';
private $password = 'your_password';
```

### 3. Configure BASE_URL
Update in `public/index.php`:
```php
define('BASE_URL', '/claim-portal'); // Adjust if necessary
```

### 4. Server Setup
- Place project in web server root directory (e.g., `C:\xampp\htdocs` for XAMPP)
- Enable mod_rewrite for Apache
- Set proper permissions for files and directories
- Ensure PHP and MySQL services are running

### 5. Import Sample Data
Run the following SQL commands to import sample data:
```sql
INSERT INTO claims (JobID, InsuranceClaimNo, VehicleRego, Owner) VALUES
('JOB001', 'IC98765', 'ABC123', 'John Smith'),
('JOB002', 'IC45678', 'XYZ789', 'Emma Watson'),
('JOB003', 'IC34567', 'DEF456', 'Michael Johnson');
```

### 6. Access Application
Visit: `http://localhost/claim-portal`

### 7. Troubleshooting
- Ensure all database credentials are correct
- Check Apache error logs if the page doesn't load
- Verify PHP version compatibility
- Make sure all required PHP extensions are enabled
- Check file permissions if running on Linux/Unix systems

## Usage Guide

### View Claims List
- Access main page to view all claims
- Claims displayed in responsive table format
- Loading animation indicates data fetching

### Search Claims
- Type in search box to filter claims
- Results update after 500ms delay
- Search across all fields (Job ID, Insurance Claim No, Vehicle Rego, Owner)
- Clear search to view all claims

### Add New Claim
1. Fill required fields:
   - Job ID (format: JOBxxx)
   - Insurance Claim No (format: ICxxxxx)
   - Vehicle Rego
   - Owner
2. Submit form
3. Receive instant feedback via toast notifications

## Customization

### Loading Animation
- Modify `assets/css/loading.css` for appearance
- Adjust timing in `assets/js/loading.js`
- Default delay: 500ms

### Toast Notifications
- Customize in `assets/css/toast.css`
- Configure duration in `assets/js/toast.js`
- Default display: 5000ms

## Security Features

- Input validation and sanitization
- XSS protection
- SQL injection prevention
- Error handling and logging

## Browser Support

- Chrome (latest)
- Edge (latest)