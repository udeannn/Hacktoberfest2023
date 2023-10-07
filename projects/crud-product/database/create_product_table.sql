CREATE TABLE product (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_image VARCHAR(255) NOT NULL,
    product_name VARCHAR(255) UNIQUE NOT NULL,
    price_buy INT(11) NOT NULL,
    price_sell INT(11) NOT NULL,
    stock INT(11) NOT NULL
);
