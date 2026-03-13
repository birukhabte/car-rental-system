-- Car Rental Portal Database Setup
-- Run this in phpMyAdmin or MySQL command line

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS carrental;

-- Use the database
USE carrental;

-- Show success message
SELECT 'Database carrental created/selected successfully!' as Status;

-- Instructions for next steps
SELECT 'Next: Import the SQL File/carrental.sql file through phpMyAdmin' as NextStep;