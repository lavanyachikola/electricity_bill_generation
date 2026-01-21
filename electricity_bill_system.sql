-- =========================
-- DATABASE
-- =========================
CREATE DATABASE IF NOT EXISTS electricity_bill_system;
USE electricity_bill_system;

-- =========================
-- USERS TABLE
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(32) NOT NULL,
    household_name VARCHAR(32) NOT NULL,
    house_number VARCHAR(16) NOT NULL,
    pin_number VARCHAR(6) NOT NULL,
    phone_number VARCHAR(10) NOT NULL,
    service_number VARCHAR(16) UNIQUE NOT NULL,
    meter_number VARCHAR(16) UNIQUE NOT NULL,
    category ENUM('Household','Commercial','Industry') NOT NULL,
    role ENUM('Admin','Employee','User') DEFAULT 'User',
    password VARCHAR(255) NOT NULL
);

-- =========================
-- METER READINGS
-- =========================
CREATE TABLE meter_readings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_number VARCHAR(16) NOT NULL,
    previous_reading INT NOT NULL,
    current_reading INT NOT NULL,
    reading_date DATE NOT NULL,
    FOREIGN KEY (service_number) REFERENCES users(service_number)
);

-- =========================
-- BILLS TABLE
-- =========================
CREATE TABLE bills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bill_number VARCHAR(20) UNIQUE NOT NULL,
    service_number VARCHAR(16) NOT NULL,
    previous_reading INT NOT NULL,
    current_reading INT NOT NULL,
    consumption INT NOT NULL,
    bill_date DATE NOT NULL,
    due_date_without_fine DATE NOT NULL,
    due_date_with_fine DATE NOT NULL,
    taxes DECIMAL(10,2) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    fine DECIMAL(10,2) DEFAULT 0,
    status ENUM('Paid','Unpaid') DEFAULT 'Unpaid',
    FOREIGN KEY (service_number) REFERENCES users(service_number)
);

-- =========================
-- RATES TABLE
-- =========================
CREATE TABLE rates (
    category ENUM('Household','Commercial','Industry') PRIMARY KEY,
    rate_per_unit DECIMAL(10,2),
    fixed_charge DECIMAL(10,2)
);

INSERT INTO rates VALUES
('Household', 5.00, 50),
('Commercial', 8.00, 150),
('Industry', 10.00, 500);

-- =========================
-- SAMPLE USERS
-- =========================
INSERT INTO users VALUES
(NULL,'Admin','AdminHouse','1','500001','9999999999','SVCADMIN','MTRADMIN','Household','Admin',MD5('admin123')),
(NULL,'Employee','EmpHouse','2','500002','8888888888','SVCEMP1','MTREMP1','Household','Employee',MD5('emp123')),
(NULL,'Ravi Kumar','Ravi House','101','500003','7777777777','SVC1001','MTR1001','Household','User',MD5('user123')),
(NULL,'Sai Traders','Sai Traders','202','500004','6666666666','SVC1002','MTR1002','Commercial','User',MD5('user123')),
(NULL,'ABC Industries','ABC Plant','303','500005','5555555555','SVC1003','MTR1003','Industry','User',MD5('user123'));
