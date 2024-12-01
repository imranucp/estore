-- <<<<<<<<<<<<<<<<    Inventory Table    >>>>>>>>>>>>>>>> --
CREATE TABLE inventory (
    brandCode VARCHAR(10) PRIMARY KEY,
    quantity INT
);

INSERT INTO
    inventory (brandCode, quantity)
VALUES
    ('BC001', 50),
    ('BC002', 20),
    ('BC003', 35),
    ('BC004', 45),
    ('BC005', 30),
    ('BC006', 60),
    ('BC007', 25),
    ('BC008', 40),
    ('BC009', 55),
    ('BC010', 15);

-- <<<<<<<<<<<<<<<<    Bicycles Table    >>>>>>>>>>>>>>>> --
CREATE TABLE bicycles (
    brandCode VARCHAR(10) PRIMARY KEY,
    brandName VARCHAR(50),
    supplierId VARCHAR(10),
    quantity INT,
    FOREIGN KEY (supplierId) REFERENCES suppliers(id)
);

ALTER TABLE
    bicycles
ADD
    COLUMN description TEXT,
ADD
    COLUMN image_url VARCHAR(255);

UPDATE
    bicycles
SET
    image_url = '../assets/trek.jpg'
WHERE
    brandCode = 'BC001';

UPDATE
    bicycles
SET
    image_url = '../assets/specialized.webp'
WHERE
    brandCode = 'BC002';

UPDATE
    bicycles
SET
    image_url = '../assets/giant.jpeg'
WHERE
    brandCode = 'BC003';

UPDATE
    bicycles
SET
    image_url = '../assets/cannondale.webp'
WHERE
    brandCode = 'BC004';

UPDATE
    bicycles
SET
    image_url = '../assets/scott.jpeg'
WHERE
    brandCode = 'BC005';

UPDATE
    bicycles
SET
    image_url = '../assets/bianchi.webp'
WHERE
    brandCode = 'BC006';

UPDATE
    bicycles
SET
    image_url = '../assets/cervelo.avif'
WHERE
    brandCode = 'BC007';

UPDATE
    bicycles
SET
    image_url = '../assets/merida.webp'
WHERE
    brandCode = 'BC008';

UPDATE
    bicycles
SET
    image_url = '../assets/pinarello.webp'
WHERE
    brandCode = 'BC009';

UPDATE
    bicycles
SET
    image_url = '../assets/colnago.webp'
WHERE
    brandCode = 'BC010';

INSERT INTO
    bicycles (brandCode, brandName, supplierId, quantity)
VALUES
    ('BC001', 'Trek', 'SUP01', 50),
    ('BC002', 'Specialized', 'SUP02', 20),
    ('BC003', 'Giant', 'SUP03', 35),
    ('BC004', 'Cannondale', 'SUP01', 45),
    ('BC005', 'Scott', 'SUP02', 30),
    ('BC006', 'Bianchi', 'SUP03', 60),
    ('BC007', 'Cervelo', 'SUP01', 25),
    ('BC008', 'Merida', 'SUP02', 40),
    ('BC009', 'Pinarello', 'SUP03', 55),
    ('BC010', 'Colnago', 'SUP01', 15);

-- <<<<<<<<<<<<<<<<    Supplier Table    >>>>>>>>>>>>>>>> --
CREATE TABLE suppliers (
    id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(50),
    address VARCHAR(100),
    cityId VARCHAR(10),
    FOREIGN KEY (cityId) REFERENCES cities(id)
);

INSERT INTO
    suppliers (id, name, address, cityId)
VALUES
    ('SUP01', 'CycleWorld', '123 Elm St', 'C001'),
    ('SUP02', 'BikeMasters', '456 Oak Ave', 'C002'),
    ('SUP03', 'PedalPro', '789 Maple Blvd', 'C003'),
    ('SUP04', 'GearShift', '111 Pine Rd', 'C001'),
    ('SUP05', 'WheelWorks', '222 Cedar Ln', 'C002'),
    ('SUP06', 'ChainReaction', '333 Birch Dr', 'C003');

-- <<<<<<<<<<<<<<<<    Cities Table    >>>>>>>>>>>>>>>> --
CREATE TABLE cities (
    id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(50)
);

INSERT INTO
    cities (id, name)
VALUES
    ('C001', 'New York'),
    ('C002', 'San Francisco'),
    ('C003', 'Chicago');

-- <<<<<<<<<<<<<<<<    Customer Table    >>>>>>>>>>>>>>>> --
CREATE TABLE customers (
    id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(50),
    phoneNumber VARCHAR(15),
    addressId VARCHAR(10),
    FOREIGN KEY (addressId) REFERENCES addresses(id)
);

INSERT INTO
    customers (id, name, phoneNumber, addressId)
VALUES
    ('CUS001', 'John Doe', '555-1234', 'A001'),
    ('CUS002', 'Jane Smith', '555-5678', 'A002'),
    ('CUS003', 'Alice Johnson', '555-8765', 'A003'),
    ('CUS004', 'Bob Brown', '555-4321', 'A004'),
    ('CUS005', 'Charlie Davis', '555-0000', 'A005'),
    ('CUS006', 'Eva White', '555-1111', 'A006'),
    ('CUS007', 'Mike Green', '555-2222', 'A007'),
    ('CUS008', 'Nancy Black', '555-3333', 'A008'),
    ('CUS009', 'Tom Harris', '555-4444', 'A009'),
    ('CUS010', 'Sara Wilson', '555-5555', 'A010');

-- <<<<<<<<<<<<<<<<    Addresses Table    >>>>>>>>>>>>>>>> --
CREATE TABLE addresses (
    id VARCHAR(10) PRIMARY KEY,
    streetNumber VARCHAR(10),
    streetName VARCHAR(50),
    suburb VARCHAR(50),
    postCode VARCHAR(10)
);

INSERT INTO
    addresses (id, streetNumber, streetName, suburb, postCode)
VALUES
    ('A001', '123', 'Main St', 'Downtown', '10001'),
    ('A002', '456', 'Second Ave', 'Uptown', '10002'),
    ('A003', '789', 'Third Blvd', 'Midtown', '10003'),
    ('A004', '101', 'Fourth Rd', 'Westside', '10004'),
    ('A005', '202', 'Fifth Ln', 'Eastside', '10005'),
    ('A006', '303', 'Sixth Pl', 'Northside', '10006'),
    (
        'A007',
        '404',
        'Seventh Ct',
        'Southside',
        '10007'
    ),
    ('A008', '505', 'Eighth Dr', 'Hillside', '10008'),
    ('A009', '606', 'Ninth St', 'Lakeside', '10009'),
    ('A010', '707', 'Tenth Way', 'Riverside', '10010');

-- <<<<<<<<<<<<<<<<    Orders Table    >>>>>>>>>>>>>>>> --
CREATE TABLE orders (
    id VARCHAR(10) PRIMARY KEY,
    customerId VARCHAR(10),
    orderDate TIMESTAMP,
    FOREIGN KEY (customerId) REFERENCES customers(id)
);

INSERT INTO
    orders (id, customerId, orderDate)
VALUES
    ('ORD001', 'CUS001', '2024-10-10 12:34:56'),
    ('ORD002', 'CUS002', '2024-10-11 13:45:00'),
    ('ORD003', 'CUS003', '2024-10-12 14:55:10'),
    ('ORD004', 'CUS004', '2024-10-13 15:20:00'),
    ('ORD005', 'CUS005', '2024-10-14 16:30:25'),
    ('ORD006', 'CUS006', '2024-10-15 17:40:50'),
    ('ORD007', 'CUS007', '2024-10-16 18:50:00'),
    ('ORD008', 'CUS008', '2024-10-17 19:10:00'),
    ('ORD009', 'CUS009', '2024-10-18 20:20:10'),
    ('ORD010', 'CUS010', '2024-10-19 21:30:30');

-- <<<<<<<<<<<<<<<<    Payments Table    >>>>>>>>>>>>>>>> --
CREATE TABLE payments (
    id VARCHAR(10) PRIMARY KEY,
    orderId VARCHAR(10),
    amount DECIMAL(10, 2),
    date TIMESTAMP,
    description VARCHAR(255),
    FOREIGN KEY (orderId) REFERENCES orders(id)
);

INSERT INTO
    payments (id, orderId, amount, date, description)
VALUES
    (
        'PAY001',
        'ORD001',
        500.00,
        '2024-10-10 12:40:00',
        'Credit Card'
    ),
    (
        'PAY002',
        'ORD002',
        750.00,
        '2024-10-11 13:50:00',
        'Paypal'
    ),
    (
        'PAY003',
        'ORD003',
        350.00,
        '2024-10-12 14:55:30',
        'Credit Card'
    ),
    (
        'PAY004',
        'ORD004',
        900.00,
        '2024-10-13 15:25:00',
        'Cash'
    ),
    (
        'PAY005',
        'ORD005',
        1200.00,
        '2024-10-14 16:35:00',
        'Credit Card'
    ),
    (
        'PAY006',
        'ORD006',
        850.00,
        '2024-10-15 17:45:00',
        'Paypal'
    ),
    (
        'PAY007',
        'ORD007',
        600.00,
        '2024-10-16 18:55:00',
        'Credit Card'
    ),
    (
        'PAY008',
        'ORD008',
        1300.00,
        '2024-10-17 19:15:00',
        'Bank Transfer'
    ),
    (
        'PAY009',
        'ORD009',
        450.00,
        '2024-10-18 20:25:00',
        'Credit Card'
    ),
    (
        'PAY010',
        'ORD010',
        1100.00,
        '2024-10-19 21:35:00',
        'Cash'
    );

-- <<<<<<<<<<<<<<<<    Receipts Table    >>>>>>>>>>>>>>>> --
CREATE TABLE receipts (
    id VARCHAR(10) PRIMARY KEY,
    paymentId VARCHAR(10),
    date TIMESTAMP,
    amount DECIMAL(10, 2),
    description VARCHAR(255),
    FOREIGN KEY (paymentId) REFERENCES payments(id)
);

INSERT INTO
    receipts (id, paymentId, date, amount, description)
VALUES
    (
        'REC001',
        'PAY001',
        '2024-10-10 12:45:00',
        500.00,
        'Payment Received'
    ),
    (
        'REC002',
        'PAY002',
        '2024-10-11 13:55:00',
        750.00,
        'Payment Received'
    ),
    (
        'REC003',
        'PAY003',
        '2024-10-12 15:00:00',
        350.00,
        'Payment Received'
    ),
    (
        'REC004',
        'PAY004',
        '2024-10-13 15:30:00',
        900.00,
        'Payment Received'
    ),
    (
        'REC005',
        'PAY005',
        '2024-10-14 16:40:00',
        1200.00,
        'Payment Received'
    ),
    (
        'REC006',
        'PAY006',
        '2024-10-15 17:50:00',
        850.00,
        'Payment Received'
    ),
    (
        'REC007',
        'PAY007',
        '2024-10-16 19:00:00',
        600.00,
        'Payment Received'
    ),
    (
        'REC008',
        'PAY008',
        '2024-10-17 19:20:00',
        1300.00,
        'Payment Received'
    ),
    (
        'REC009',
        'PAY009',
        '2024-10-18 20:30:00',
        450.00,
        'Payment Received'
    ),
    (
        'REC010',
        'PAY010',
        '2024-10-19 21:40:00',
        1100.00,
        'Payment Received'
    );

-- -- <<<<<<<<<<<<<<<<    Special Requests Table    >>>>>>>>>>>>>>>> --
CREATE TABLE special_requests (
    id VARCHAR(10) PRIMARY KEY,
    orderId VARCHAR(10),
    serviceDescription VARCHAR(255),
    FOREIGN KEY (orderId) REFERENCES orders(id)
);

INSERT INTO
    special_requests (id, orderId, serviceDescription)
VALUES
    ('REQ001', 'ORD001', 'Customized Seat'),
    ('REQ002', 'ORD002', 'Special Handlebar'),
    ('REQ003', 'ORD003', 'Extra Accessories'),
    ('REQ004', 'ORD004', 'Extended Warranty'),
    ('REQ005', 'ORD005', 'Personalized Colors'),
    ('REQ006', 'ORD006', 'Performance Tires'),
    ('REQ007', 'ORD007', 'Advanced Brakes'),
    ('REQ008', 'ORD008', 'Carbon Frame'),
    ('REQ009', 'ORD009', 'Lightweight Wheels'),
    ('REQ010', 'ORD010', 'Premium Pedals');

-- <<<<<<<<<<<<<<<<    Shipping Methods Table    >>>>>>>>>>>>>>>> --
CREATE TABLE shipping_methods (
    id VARCHAR(10) PRIMARY KEY,
    orderId VARCHAR(10),
    method VARCHAR(50),
    FOREIGN KEY (orderId) REFERENCES orders(id)
);

INSERT INTO
    shipping_methods (id, orderId, method)
VALUES
    ('SHIP001', 'ORD001', 'Standard'),
    ('SHIP002', 'ORD002', 'Express'),
    ('SHIP003', 'ORD003', 'Next Day'),
    ('SHIP004', 'ORD004', 'International'),
    ('SHIP005', 'ORD005', 'Standard'),
    ('SHIP006', 'ORD006', 'Express'),
    ('SHIP007', 'ORD007', 'Next Day'),
    ('SHIP008', 'ORD008', 'Standard'),
    ('SHIP009', 'ORD009', 'Express'),
    ('SHIP010', 'ORD010', 'International');

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_code VARCHAR(10),
    quantity INT,
    FOREIGN KEY (product_code) REFERENCES bicycles(brandCode)
);

ALTER TABLE
    cart
MODIFY
    user_id VARCHAR(255);

UPDATE
    cart
SET
    user_id = 'CUS001'
WHERE
    product_code = 'BC010';

select
    *
from
    addresses;