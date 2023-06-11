DROP DATABASE IF EXISTS sns;
CREATE DATABASE IF NOT EXISTS sns;
USE sns;

CREATE TABLE IF NOT EXISTS users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(28) NOT NULL UNIQUE,
  full_name VARCHAR(28) NOT NULL,
  email VARCHAR(75) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone_number VARCHAR(25) NOT NULL UNIQUE,
  role ENUM ('user', 'artisan') NOT NULL DEFAULT 'user',
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS artisans (
  artisan_id INT AUTO_INCREMENT,
  user_id INT NOT NULL,
  company_name VARCHAR(80) UNIQUE NOT NULL,
  company_address VARCHAR(175) UNIQUE NOT NULL,
  description TEXT NOT NULL,
  profile_picture VARCHAR(255) NOT NULL,
  certifications VARCHAR(255) NOT NULL,
  location VARCHAR(255) NOT NULL,
  PRIMARY KEY (artisan_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS services (
  service_id INT AUTO_INCREMENT,
  service_name VARCHAR(255) NOT NULL,
  service_description TEXT NOT NULL,
  PRIMARY KEY (service_id)
);

CREATE TABLE IF NOT EXISTS subservices (
  subservice_id INT AUTO_INCREMENT,
  subservice_name VARCHAR(255),
  subservice_description VARCHAR(255),
  service_id INT,
  PRIMARY KEY (subservice_id),
  FOREIGN KEY (service_id) REFERENCES services(service_id)
);

CREATE TABLE IF NOT EXISTS artisan_services (
  artisan_id INT,
  subservice_id INT,
  price FLOAT,
  PRIMARY KEY (artisan_id, subservice_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id),
  FOREIGN KEY (subservice_id) REFERENCES subservices(subservice_id)
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
  subservice_id INT,
  artisan_id INT,
  date_requested TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(10) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (request_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id),
  FOREIGN KEY (subservice_id) REFERENCES subservices(subservice_id)
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

INSERT INTO Users (user_id, username, full_name, email, password, phone_number, role) VALUES (1, 'mohizine', 'Mohieddine Farid', 'farid.mohieddine@gmail.com', '$2y$10$ANvC.QckSes9a0vH62h33evuASZaDIXBPLV/A6ZurCT.2jcX6rtmi', '0712345678', 'artisan'),
(2, 'MohiZwine', 'Leonel Messi', 'leomessi@gmail.com', '$2y$10$63iJ6y.F1WwHMcVUHQ/l/eia65Q0yQZYCd3tSlrvVgqMKBDHry4aO','0712345679', 'artisan'),
(3, 'Cristiano', 'Cristiano Ronaldo','Cristiano@gmail.com', '$2y$10$p4geEi6CFgXBkwHVhQl/Ke9BpNA67P7Cibl53nPvRATnJrYsUogZG', '0712345677', 'artisan'),
(4, 'Imane', 'Imane Rahali', 'imane@gmail.com', '$2y$10$63iJ6y.F1WwHMcVUHQ/l/ea65Q0yQZYCd3tSlrvVgqMKBDHry4aO','0712345676', 'artisan'),
(5, 'Ayman', 'Ayman Messi', 'ayman@gmail.com', '$2y$10$63iJ6y.F1WwHMcVUHQ/l/ei65Q0yQZYCd3tSlrvVgqMKBDHry4aO','07123456785', 'artisan'),
(6, 'user', 'User User', 'user@gmail.com', '$2y$10$63iJ6y.F1WwHMcVUHQ/l/ei65Q0yQZYCd3tSlrvVgqMKBDHry4aO','0712345674', 'user');

INSERT INTO artisans (user_id, company_name, company_address, description, profile_picture,certifications,location) VALUES
(1, 'Bob Plumbing', '123 Plumber St, New York', 'Expert plumbing services.', 'https://img.freepik.com/free-photo/wide-angle-shot-single-tree-growing-clouded-sky-during-sunset-surrounded-by-grass_181624-22807.jpg?w=900&t=st=1686412681~exp=1686413281~hmac=6689aebfa8a06f0a67001392aac6c9b305300536f9bce311badce730320c1434','certificat1','rabat'),
(2, 'Alice Electricians', '456 Electric Ave, New York', 'Reliable electrical services.', 'https://img.freepik.com/free-photo/beautiful-scenery-green-valley-near-alp-mountains-austria-cloudy-sky_181624-6979.jpg?size=626&ext=jpg&ga=GA1.1.2144948786.1684935304&semt=sph','certificat2','agadir'),
(3, 'HandyFix', '789 Fixit Rd, New York', 'General handyman services.', 'https://img.freepik.com/free-photo/beautiful-scenery-pathway-forest-with-trees-covered-with-frost_181624-42376.jpg?size=626&ext=jpg&ga=GA1.2.2144948786.1684935304&semt=sph','certificat3','tanger'),
(4, 'Roof Masters', '1011 Roof St, New York', 'Professional roofing services.', 'https://img.freepik.com/free-photo/beautiful-scenery-pathway-forest-with-trees-covered-with-frost_181624-42376.jpg?size=626&ext=jpg&ga=GA1.2.2144948786.1684935304&semt=sph','certificat4','fes'),
(5, 'Comfort HVAC', '1213 Heat Rd, New York', 'HVAC installation and repair.', 'https://img.freepik.com/free-photo/beautiful-view-greenery-bridge-forest-perfect-background_181624-17827.jpg?size=626&ext=jpg&ga=GA1.2.2144948786.1684935304&semt=sph','certificat5','meknes');

-- Populating the services table
INSERT INTO services (service_name, service_description) VALUES
('Plumbing', 'All kinds of plumbing services.'),
('Electrical', 'Electrical installations and repairs.'),
('Handyman', 'General repair and maintenance.'),
('Roofing', 'Roof repair and installation.'),
('HVAC', 'Heating, ventilation, and air conditioning services.');

INSERT INTO subservices(subservice_name, subservice_description, service_id) VALUES ("Sewer line repair/replacement", "Repair or replacement of damaged or clogged sewer lines to restore proper drainage", 1),
("Water heater installation/repair", "Installation or repair of water heating systems for hot water supply", 1),
("Bathroom/kitchen remodel plumbing", "Bathroom and kitchen remodeling projects, including fixture installation and plumbing reconfiguration.", 1),
("Electrical panel upgrade", "Upgrading the electrical panel to increase capacity and ensure safe and efficient distribution of electricity", 2),
("Generator installation", "Installation of backup power generators to provide electricity during power outages", 2),
("Troubleshooting electrical faults", "Identifying and fixing electrical issues such as circuit faults, short circuits, or electrical malfunctions", 2),
("Tile installation/repair", "Installation or repair of various types of tiles, such as ceramic, porcelain, or natural stone, for floors, walls, or backsplashes", 3),
("Drywall installation/repair", "Installation or repair of drywall, which is essential for creating walls and ceilings in buildings", 3),
("Deck repair/staining", "Repairing damaged or deteriorated deck structures and applying protective staining to enhance their appearance and longevity", 3),
("Roof shingle replacement", "Removal and replacement of worn or damaged roof shingles to maintain a watertight and visually appealing roof", 4),
("Chimney repair", "Repair of chimney structures to ensure proper ventilation and prevent leaks or structural issues", 4),
("Roof flashing repair/replacement", "Repairing or replacing roof flashing, which prevents water penetration at roof intersections or protrusions", 4),
("Central air conditioner installation", "Installation of a centralized cooling system to provide efficient and even cooling throughout a building", 5),
("Furnace installation/repair", "Installation or repair of heating systems, such as furnaces, to ensure effective and reliable heat distribution", 5),
("Ductwork design/installation", "Designing and installing ductwork systems for proper air distribution and ventilation throughout a building", 5);


-- Populating the artisan_services table
INSERT INTO artisan_services (artisan_id, subservice_id, price) VALUES
(1, 1, 500),
(1, 2, 600),
(1, 3, 440),
(2, 4, 650),
(2, 5, 550),
(2, 6, 750),
(3, 7, 780),
(3, 8, 880),
(3, 9, 280),
(4, 10, 660),
(4, 11, 620),
(4, 12, 960),
(5, 13, 350),
(5, 14, 750),
(5, 15, 480);

-- Populating the availabilities table
INSERT INTO availabilities (artisan_id, date, start_time, end_time) VALUES
(1, '2023-06-12', '09:00:00', '17:00:00'),
(2, '2023-06-13', '10:00:00', '18:00:00'),
(3, '2023-06-14', '08:00:00', '16:00:00'),
(4, '2023-06-15', '11:00:00', '19:00:00'),
(5, '2023-06-16', '09:30:00', '17:30:00');

-- Populating the requests table
INSERT INTO requests (user_id, subservice_id, artisan_id) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 10, 4),
(5, 9, 3),
(1, 5, 2),
(2, 3, 1);

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