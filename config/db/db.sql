CREATE DATABASE `estorex_db`;

-- Admin Tables

CREATE TABLE `account` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `emailaddress` VARCHAR(255) NOT NULL,
    `psw` VARCHAR(255) NOT NULL,
    `uploads` VARCHAR(255) NOT NULL,
    `account` VARCHAR(25) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE `products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(255) NOT NULL,
    `product_description` TEXT NOT NULL,
    `product_new_price` DECIMAL(9,2) NOT NULL,
    `product_old_price` DECIMAL(9,2) NOT NULL,
    `category` VARCHAR(255) NOT NULL,
    `sub_category` VARCHAR(255) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `merchant_product_email` VARCHAR(255) NOT NULL,
    `product_id` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(product_id) REFERENCES account(id) 
);

-- End Admin Tables


-- Customer Tables

CREATE TABLE `customer` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `address` TEXT NOT NULL,
    `phone` VARCHAR(55) NOT NULL,
    `emailaddress` VARCHAR(255) NOT NULL,
    `city` VARCHAR(25) NOT NULL,
    `post_code` VARCHAR(25) NOT NULL,
    `customer_id` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY(id),
    FOREIGN KEY(customer_id) REFERENCES account(id)
);

CREATE TABLE `temp_customer` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `address` TEXT NOT NULL,
    `phone` VARCHAR(55) NOT NULL,
    `emailaddress` VARCHAR(255) NOT NULL,
    `city` VARCHAR(25) NOT NULL,
    `post_code` VARCHAR(25) NOT NULL,
    `product_name` VARCHAR(255) NOT NULL,
    `product_description` TEXT NOT NULL,
    `product_new_price` DECIMAL(9,2) NOT NULL,
    `product_old_price` DECIMAL(9,2) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY(id)
);

CREATE TABLE `order_item` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(255) NOT NULL,
    `product_description` TEXT NOT NULL,
    `product_new_price` DECIMAL(9,2) NOT NULL,
    `product_old_price` DECIMAL(9,2) NOT NULL,
    `size` VARCHAR(255) NOT NULL,
    `color` VARCHAR(255) NOT NULL,
    `quantity` VARCHAR(255) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `merchant_product_email` VARCHAR(255) NOT NULL,
    `orderId` INT NOT NULL,
    `order_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(orderId) REFERENCES account(id)
);

-- End Customer Tables