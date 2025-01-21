Instruction: Ang aming code ay gagamit ng xampp, need ito ng specific table
at database. Kami ay gumawa ng sql code para direkta makagawa, at hindi na
iisa isahin. Nasa ibaba ang username password (para sa login), at nasa ibaba 
ang sql code. Homepage.php or login.php ang pwedeng unahin buksan.
Thank you :)
username: sample
password: sample2
-------------------------------------------------------------------------------------


CREATE DATABASE integrateddb;

USE integrateddb;

CREATE TABLE store (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ITEM VARCHAR(225) NOT NULL,
    PRICE_IN_PESO INT(225) NOT NULL,
    SERIAL_NUMBER INT(225) NOT NULL,
    DESCRIPTION VARCHAR(225) NOT NULL,
    ITEM_TIME TIMESTAMP,
    STOCK_QUANTITY INT(225) NOT NULL);
    
CREATE TABLE try (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NAME VARCHAR(225) NOT NULL,
    PASW VARCHAR(225),
    AGE INT(30) );
    
INSERT INTO try (ID, NAME, PASW, AGE) VALUES (NULL, 'sample','sample2',2)