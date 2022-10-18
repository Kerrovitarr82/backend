CREATE DATABASE IF NOT EXISTS appDB2;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB2.* TO 'user'@'%';
FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS admins (userName varchar(191) not null, passwd varchar(191), primary key (userName));
INSERT INTO users VALUE ('shat', '{SHA}QL0AFWMIX8NRZTKeof9cXsvbvu8=');