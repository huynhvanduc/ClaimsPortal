CREATE DATABASE claim_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE claims (
    id INT AUTO_INCREMENT PRIMARY KEY,
    JobID VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    InsuranceClaimNo VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    VehicleRego VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    Owner VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
);

INSERT INTO claims (JobID, InsuranceClaimNo, VehicleRego, Owner) VALUES
('001', 'IC12345', '29A-12345', 'Nguyễn Văn A'),
('002', 'IC12346', '51B-45678', 'Trần Thị B'),
('003', 'IC12347', '51C-78901', 'Lê Văn C'),
('004', 'IC12348', '30A-11111', 'Phạm Thị D'),
('005', 'IC12349', '29B-22222', 'Hoàng Văn E');