CREATE DATABASE IF NOT EXISTS labcode;
USE labcode;

CREATE TABLE IF NOT EXISTS submissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student VARCHAR(100),
  program VARCHAR(100),
  code TEXT,
  submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
