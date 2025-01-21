CREATE TABLE Student (
    StudentID INT PRIMARY KEY,
    Name VARCHAR(255),
    ContactNumber VARCHAR(15),
    Email VARCHAR(255),
    EmergencyContact VARCHAR(15)
);

CREATE TABLE Room (
    RoomID VARCHAR(255) PRIMARY KEY,
    RoomNumber VARCHAR(20),
    Capacity INT,
    OccupancyStatus VARCHAR(20)
);

CREATE TABLE Admissions (
    AdmissionID VARCHAR(20) PRIMARY KEY,
    StudentID INT,
    RoomID VARCHAR(20),
    AdmissionDate DATE,
    Status VARCHAR(20),
    FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
    FOREIGN KEY (RoomID) REFERENCES Room(RoomID)
);

CREATE TABLE Payments (
    PaymentID VARCHAR(20) PRIMARY KEY,
    StudentID INT,
    Amount DECIMAL(10, 2),
    PaymentDate DATE,
    FOREIGN KEY (StudentID) REFERENCES Student(StudentID)
);

CREATE TABLE FeeCollection (
    CollectionID INT PRIMARY KEY AUTO_INCREMENT,
    StudentID INT NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    CollectionDate DATE NOT NULL,
    CONSTRAINT fk_student FOREIGN KEY (StudentID) REFERENCES Student(StudentID)
);

CREATE TABLE Messages (
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    SenderId INT,
    ReceiverId INT,
    MessageText TEXT,
    Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (SenderId) REFERENCES Student(StudentID),
    FOREIGN KEY (ReceiverId) REFERENCES Student(StudentID)
);

CREATE TABLE users (
    id  INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30),
    last_name VARCHAR(30),
    username VARCHAR(50) UNIQUE,
    email  VARCHAR(60),
    password VARCHAR(20),
    reset_code VARCHAR(255)
);

CREATE TABLE student_users (
   UserID INT AUTO_INCREMENT PRIMARY KEY,
   StudentID INT,
   Username VARCHAR(50) NOT NULL UNIQUE,
   Password VARCHAR(255) NOT NULL,
   FOREIGN KEY (StudentID) REFERENCES Student(StudentID)
);
