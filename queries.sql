CREATE DATABASE IF NOT EXISTS 'sns';
USE 'sns';

CREATE TABLE IF NOT EXISTS users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(75) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone_number VARCHAR(15) NOT NULL UNIQUE,
  role VARCHAR(10) NOT NULL,
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS artisans (
  artisan_id INT AUTO_INCREMENT,
  user_id INT NOT NULL,
  company_name VARCHAR(255) UNIQUE NOT NULL,
  company_address VARCHAR(255) UNIQUE NOT NULL,
  description TEXT NOT NULL,
  profile_picture VARCHAR(255) NOT NULL,
  PRIMARY KEY (artisan_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS services (
  service_id INT,
  service_name VARCHAR(255) NOT NULL,
  service_description TEXT NOT NULL,
  PRIMARY KEY (service_id)
);

CREATE TABLE IF NOT EXISTS artisan_services (
  artisan_id INT,
  service_id INT,
  PRIMARY KEY (artisan_id, service_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id),
  FOREIGN KEY (service_id) REGERENCES services(service_id)
);

CREATE TABLE IF NOT EXISTS availabilities (
  availability_id INT,
  artisan_id INT,
  date DATE,
  start_time TIME,
  end_time TIME,
  PRIMARY KEY (availability_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id)
);

CREATE TABLE IF NOT EXISTS requests (
  request_id INT,
  user_id INT,
  service_id INT,
  description TEXT,
  date_requested DATE NOT NULL DEFAULT CURRENT_DATE,
  status VARCHAR(10) NOT NULL DEFAULT 'pending',
  location VARCHAR(255) NOT NULL ,
  PRIMARY KEY (request_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (service_id) REFERENCES services(service_id)
);

CREATE TABLE IF NOT EXISTS quotes (
  quote_id INT,
  artisan_id INT,
  request_id INT,
  quote_amount DECIMAL(10, 2) NOT NULL,
  quote_description TEXT,
  date_quoted DATE NOT NULL DEFAULT CURRENT_DATE,
  PRIMARY KEY (quote_id),
  FOREIGN KEY (artisan_id) REFERENCES artisans(artisan_id),
  FOREIGN KEY (request_id) REFERENCES requests(request_id)
);

CREATE TABLE IF NOT EXISTS payments (
  payment_id INT,
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
  message_id INT,
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
  notification_id INT,
  user_id INT,
  message TEXT NOT NULL,
  date_sent DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  is_read BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (notification_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE IF NOT EXISTS Reviews (
  review_id INT,
  user_id INT,
  artisan_id INT,
  rating INT NOT NULL,
  review_text TEXT,
  date_reviewed DATE NOT NULL DEFAULT CURRENT_DATE,
  PRIMARY KEY (review_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id),
  FOREIGN KEY (artisan_id) REFERENCES Artisans(artisan_id)
);

