CREATE DATABASE IF NOT EXISTS management;

USE management;

CREATE TABLE IF NOT EXISTS associate(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  cpf CHAR(11),
  membership_date DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS annuitity(
  id INT AUTO_INCREMENT PRIMARY KEY,
  year YEAR UNIQUE NOT NULL,
  value DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS associateAnnuity(
  id_associate INT,
  id_annuity INT,
  paid VARCHAR(3) DEFAULT 'Não',
  PRIMARY KEY (id_associate, id_annuity),
  FOREIGN KEY (id_associate) REFERENCES associate(id),
  FOREIGN KEY (id_annuity) REFERENCES annuitity(id)
);
