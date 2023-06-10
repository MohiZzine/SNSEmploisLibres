CREATE DATABASE IF NOT EXISTS sns;
USE sns;

CREATE TABLE IF NOT EXISTS users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(50) NOT NULL,
  email VARCHAR(75) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL UNIQUE,
  phone_number VARCHAR(25) NOT NULL UNIQUE,
  role VARCHAR(10) ENUM ('user', 'artisan') NOT NULL DEFAULT 'user',
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS artisans (
  artisan_id INT AUTO_INCREMENT,
  user_id INT NOT NULL,
  company_name VARCHAR(80) UNIQUE NOT NULL,
  company_address VARCHAR(175) UNIQUE NOT NULL,
  description TEXT NOT NULL,
  profile_picture VARCHAR(255) NOT NULL,
  PRIMARY KEY (artisan_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS services (
  service_id INT AUTO_INCREMENT,
  service_name VARCHAR(255) NOT NULL,
  service_description TEXT NOT NULL,
  PRIMARY KEY (service_id)
);

CREATE TABLE IF NOT EXISTS artisan_services (
  artisan_id INT,
  service_id INT,
  PRIMARY KEY (artisan_id, service_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id),
  FOREIGN KEY (service_id) REFERENCES services(service_id)
);

CREATE TABLE IF NOT EXISTS availabilities (
  availability_id INT AUTO_INCREMENT,
  artisan_id INT,
  date DATE,
  start_time TIME,
  end_time TIME,
  PRIMARY KEY (availability_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id)
);

CREATE TABLE IF NOT EXISTS requests (
  request_id INT AUTO_INCREMENT,
  user_id INT,
  service_id INT,
  description TEXT,
  date_requested TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(10) NOT NULL DEFAULT 'pending',
  location VARCHAR(255) NOT NULL,
  PRIMARY KEY (request_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (service_id) REFERENCES services(service_id)
);

CREATE TABLE IF NOT EXISTS quotes (
  quote_id INT AUTO_INCREMENT,
  artisan_id INT,
  request_id INT,
  quote_amount DECIMAL(10, 2) NOT NULL,
  quote_description TEXT,
  date_quoted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (quote_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id),
  FOREIGN KEY (request_id) REFERENCES requests(request_id)
);

CREATE TABLE IF NOT EXISTS payments (
  payment_id INT AUTO_INCREMENT,
  user_id INT,
  artisan_id INT,
  request_id INT,
  quote_id INT,
  payment_amount DECIMAL(10, 2),
  date_paid DATE,
  payment_method VARCHAR(255),
  PRIMARY KEY (payment_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id),
  FOREIGN KEY (artisan_id) REFERENCES Artisans(artisan_id),
  FOREIGN KEY (request_id) REFERENCES Requests(request_id),
  FOREIGN KEY (quote_id) REFERENCES Quotes(quote_id)
);

CREATE TABLE IF NOT EXISTS Messages (
  message_id INT AUTO_INCREMENT,
  user_id INT,
  artisan_id INT,
  request_id INT,
  message_text TEXT,
  date_sent DATETIME,
  PRIMARY KEY (message_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id),
  FOREIGN KEY (artisan_id) REFERENCES Artisans(artisan_id),
  FOREIGN KEY (request_id) REFERENCES Requests(request_id)
);

CREATE TABLE IF NOT EXISTS Notifications (
  notification_id INT AUTO_INCREMENT,
  user_id INT,
  message TEXT NOT NULL,
  date_sent DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  is_read BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (notification_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE IF NOT EXISTS Reviews (
  review_id INT AUTO_INCREMENT,
  user_id INT,
  artisan_id INT,
  rating INT NOT NULL,
  review_text TEXT,
  date_reviewed TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (review_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id),
  FOREIGN KEY (artisan_id) REFERENCES Artisans(artisan_id)
);

-- MohaZayani2003
-- LeoMohi1987
-- RonaldoSui1985

INSERT INTO Users (username, full_name, email, password, phone) VALUES ('mohizine', 'Mohieddine Farid', 'farid.mohieddine@gmail.com', '$2y$10$ANvC.QckSes9a0vH62h33evuASZaDIXBPLV/A6ZurCT.2jcX6rtmi
', '123456'),
('MohiZwine', 'Leonel Messi', 'leomessi@gmail.com', '$2y$10$63iJ6y.F1WwHMcVUHQ/l/eia65Q0yQZYCd3tSlrvVgqMKBDHry4aO
','6666666'),
('Cristiano', 'Cristiano Ronaldo', '$2y$10$p4geEi6CFgXBkwHVhQl/Ke9BpNA67P7Cibl53nPvRATnJrYsUogZG
', '777777');

INSERT INTO artisans (user_id, company_name, company_address, description, profile_picture) VALUES
(3, 'Bob Plumbing', '123 Plumber St, New York', 'Expert plumbing services.', 'bob_profile.jpg'),
(4, 'Alice Electricians', '456 Electric Ave, New York', 'Reliable electrical services.', 'alice_profile.jpg'),
(3, 'HandyFix', '789 Fixit Rd, New York', 'General handyman services.', 'handyfix_profile.jpg'),
(4, 'Roof Masters', '1011 Roof St, New York', 'Professional roofing services.', 'roofmasters_profile.jpg'),
(3, 'Comfort HVAC', '1213 Heat Rd, New York', 'HVAC installation and repair.', 'comfort_profile.jpg');

-- Populating the services table
INSERT INTO services (service_name, service_description) VALUES
('Plumbing', 'All kinds of plumbing services.'),
('Electrical', 'Electrical installations and repairs.'),
('Handyman', 'General repair and maintenance.'),
('Roofing', 'Roof repair and installation.'),
('HVAC', 'Heating, ventilation, and air conditioning services.');

-- Populating the artisan_services table
INSERT INTO artisan_services (artisan_id, service_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- Populating the availabilities table
INSERT INTO availabilities (artisan_id, date, start_time, end_time) VALUES
(1, '2023-06-12', '09:00:00', '17:00:00'),
(2, '2023-06-13', '10:00:00', '18:00:00'),
(3, '2023-06-14', '08:00:00', '16:00:00'),
(4, '2023-06-15', '11:00:00', '19:00:00'),
(5, '2023-06-16', '09:30:00', '17:30:00');

-- Populating the requests table
INSERT INTO requests (user_id, service_id, description, location) VALUES
(1, 5, 'Need HVAC repair for central air.', '123 Main St, New York'),
(2, 4, 'Leaky roof needs fixing.', '456 Elm St, New York'),
(5, 3, 'Broken window and door repair.', '789 Oak St, New York'),
(1, 2, 'Electrical wiring repair needed.', '111 Pine St, New York'),
(2, 1, 'Pipes need replacing.', '222 Maple St, New York');

-- Populating the quotes table
INSERT INTO quotes (artisan_id, request_id, quote_amount, quote_description) VALUES
(1, 1, 200.50, 'HVAC repair services'),
(2, 2, 300.75, 'Roof repair services'),
(3, 3, 150.00, 'Window and door repair'),
(4, 4, 225.00, 'Electrical wiring repair'),
(5, 5, 180.00, 'Plumbing services');

-- Populating the payments table
INSERT INTO payments (user_id, artisan_id, request_id, quote_id, payment_amount, date_paid, payment_method) VALUES
(1, 1, 1, 1, 200.50, '2023-06-11', 'Credit Card'),
(2, 2, 2, 2, 300.75, '2023-06-12', 'PayPal'),
(5, 3, 3, 3, 150.00, '2023-06-13', 'Debit Card'),
(1, 4, 4, 4, 225.00, '2023-06-14', 'Credit Card'),
(2, 5, 5, 5, 180.00, '2023-06-15', 'Cash');

-- Populating the Messages table
INSERT INTO Messages (user_id, artisan_id, request_id, message_text, date_sent) VALUES
(1, 1, 1, 'When can you start?', '2023-06-10 10:00:00'),
(2, 2, 2, 'Is the quote negotiable?', '2023-06-10 11:00:00'),
(5, 3, 3, 'Can you bring your own tools?', '2023-06-10 12:00:00'),
(1, 4, 4, 'Need it done asap', '2023-06-10 13:00:00'),
(2, 5, 5, 'Are you available on weekends?', '2023-06-10 14:00:00');

-- Populating the Notifications table
INSERT INTO Notifications (user_id, message, date_sent, is_read) VALUES
(1, 'Your request has been accepted', '2023-06-10 10:05:00', FALSE),
(2, 'Your payment has been processed', '2023-06-10 11:10:00', TRUE),
(5, 'You have a new message', '2023-06-10 12:20:00', FALSE),
(1, 'Your request status has changed', '2023-06-10 13:15:00', FALSE),
(2, 'You have received a new quote', '2023-06-10 14:30:00', TRUE);

-- Populating the Reviews table
INSERT INTO Reviews (user_id, artisan_id, rating, review_text, date_reviewed) VALUES
(1, 1, 5, 'Great service!', '2023-06-10 15:00:00'),
(2, 2, 4, 'Good job, but a bit pricey.', '2023-06-10 16:00:00'),
(5, 3, 5, 'Very professional and timely.', '2023-06-10 17:00:00'),
(1, 4, 3, 'Service was okay, not the best.', '2023-06-10 18:00:00'),
(2, 5, 4, 'Did a good job with the repairs.', '2023-06-10 19:00:00');