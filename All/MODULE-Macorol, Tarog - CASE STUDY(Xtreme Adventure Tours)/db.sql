
CREATE DATABASE booking_system;

CREATE TABLE bookings (
    id INT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(50),
    region VARCHAR(255),
    province VARCHAR(255),
    city VARCHAR(255),
    street_address VARCHAR(255),
    tour VARCHAR(255),
    tour_length INT,
    people INT,
    preferred_date DATE,
    total_price DECIMAL(10, 2)
);


CREATE TABLE users (
    id INT PRIMARY KEY,
    fname VARCHAR(255),
    lname VARCHAR(255),
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    reset_code VARCHAR(50)
);
