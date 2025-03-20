CREATE DATABASE claim_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE claims (
    id INT AUTO_INCREMENT PRIMARY KEY,
    JobID VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    InsuranceClaimNo VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    VehicleRego VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    Owner VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
);

INSERT INTO claims (JobID, InsuranceClaimNo, VehicleRego, Owner) VALUES
('JOB001', 'IC98765', 'ABC123', 'John Smith'),
('JOB002', 'IC45678', 'XYZ789', 'Emma Watson'),
('JOB003', 'IC34567', 'DEF456', 'Michael Johnson'),
('JOB004', 'IC23456', 'GHI789', 'Sarah Williams'),
('JOB005', 'IC12345', 'JKL012', 'David Brown'),
('JOB006', 'IC87654', 'MNO345', 'Maria Garcia'),
('JOB007', 'IC76543', 'PQR678', 'James Wilson'),
('JOB008', 'IC65432', 'STU901', 'Lisa Anderson'),
('JOB009', 'IC54321', 'VWX234', 'Robert Taylor'),
('JOB010', 'IC43210', 'YZA567', 'Jennifer Martinez'),
('JOB011', 'IC32109', 'BCD890', 'William Davis'),
('JOB012', 'IC21098', 'EFG123', 'Elizabeth Thompson'),
('JOB013', 'IC10987', 'HIJ456', 'Christopher Lee'),
('JOB014', 'IC09876', 'KLM789', 'Jessica White'),
('JOB015', 'IC89765', 'NOP012', 'Daniel Clark'),
('JOB016', 'IC78654', 'QRS345', 'Sophie Turner'),
('JOB017', 'IC67543', 'TUV678', 'Andrew Miller'),
('JOB018', 'IC56432', 'WXY901', 'Rachel Green'),
('JOB019', 'IC45321', 'ZAB234', 'Thomas Moore'),
('JOB020', 'IC34210', 'CDE567', 'Emily Parker');