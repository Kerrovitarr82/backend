CREATE DATABASE IF NOT EXISTS appDB2;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT, UPDATE, INSERT, DELETE ON appDB2.* TO 'user'@'%';
FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS admins
(
    userName varchar(191) not null,
    passwd   varchar(191),
    primary key (userName)
);
INSERT INTO admins VALUE ('shat', '{SHA}QL0AFWMIX8NRZTKeof9cXsvbvu8=');

CREATE TABLE IF NOT EXISTS planets
(
    id          int NOT NULL AUTO_INCREMENT,
    name        varchar(191),
    description varchar(6000),
    primary key (id)
);

CREATE TABLE IF NOT EXISTS planets_faker
(
    id          int NOT NULL AUTO_INCREMENT,
    name        varchar(191),
    description varchar(6000),
    distance_from_star int,
    mass int,
    radius int,
    primary key (id)
);


