drop database if exists przychodnia;

-- Utworzenie bazy danych
CREATE DATABASE przychodnia;

-- Użycie utworzonej bazy danych
USE przychodnia;

-- Utworzenie tabeli "users" dla użytkowników
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Utworzenie tabeli "doctors" dla lekarzy
CREATE TABLE doctors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  specialization VARCHAR(255) NOT NULL
);

-- Utworzenie tabeli "appointments" dla umówionych wizyt
CREATE TABLE appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  doctor_id INT NOT NULL,
  patient_id INT NOT NULL,
  symptoms TEXT,
  date DATE,
  FOREIGN KEY (doctor_id) REFERENCES doctors (id),
  FOREIGN KEY (patient_id) REFERENCES users (id)
);

INSERT INTO Doctors (name, specialization)
VALUES
    ('Dr. John Doe', 'Kardiologia'),
    ('Dr. Jane Smith', 'Dermatologia'),
    ('Dr. Michael Johnson', 'Chirurgia'),
    ('Dr. Sarah Williams', 'Pediatria'),
    ('Dr. Johnny Sins', 'Seksuologia');


