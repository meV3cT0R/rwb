    

-- Populate user table
INSERT INTO user(firstName, lastName, email, username, password, roleId, avatar) VALUES
('John', 'Doe', 'john@example.com', 'john_doe', 'password_hash_1', 1, 'avatar1.jpg'),
('Jane', 'Smith', 'jane@example.com', 'jane_smith', 'password_hash_2', 2, 'avatar2.jpg'),
('Mike', 'Johnson', 'mike@example.com', 'mike_johnson', 'password_hash_3', 3, 'avatar3.jpg'),
('Alice', 'Brown', 'alice@example.com', 'alice_brown', 'password_hash_4', 4, 'avatar4.jpg');

-- Populate country table
INSERT INTO country(name, createdBy) VALUES
('United States', 1),
('Canada', 2),
('Mexico', 3);

-- Populate state table
INSERT INTO state(name, countryId, createdBy) VALUES
('California', 1, 1),
('Texas', 1, 2),
('Ontario', 2, 3),
('Quebec', 2, 4);

-- Populate city table
INSERT INTO city(name, countryId, stateId, createdBy) VALUES
('Los Angeles', 1, 1, 1),
('Houston', 1, 2, 2),
('Toronto', 2, 3, 3),
('Montreal', 2, 4, 4);

-- Populate propertyType table
INSERT INTO propertyType(name, createdBy) VALUES
('Apartment', 1),
('House', 2),
('Commercial', 3),
('Land', 4);

-- Populate property table
INSERT INTO property(propertyType, status, yearBuilt, marketedBy, description, price, totalSqFt, lotSizeUnit, lotSize, cityId, address) VALUES
(1, 'For Sale', 1990, 1, 'Beautiful apartment in downtown', 350000, 1200, 'sqft', 0.5, 1, '123 Main St'),
(2, 'For Rent', 2005, 2, 'Spacious house in the suburbs', 2500, 2500, 'sqft', 1.0, 2, '456 Elm St'),
(3, 'For Sale', 2010, 3, 'Office space in city center', 500000, 3000, 'sqft', 1.5, 3, '789 Oak St'),
(4, 'For Sale', 2020, 4, 'Vacant land for development', 150000, 0, 'acre', 2.5, 4, '101 Pine St');

-- Populate propertyPhotos table
INSERT INTO propertyPhotos(url, propertyId) VALUES
('apartment1.jpg', 1),
('house1.jpg', 2),
('office1.jpg', 3),
('land1.jpg', 4);

-- Populate enquiry table
INSERT INTO enquiry(enquiry, createdBy, enquiryFor) VALUES
('Is the apartment still available?', 2, 1),
('Can I schedule a visit for the house?', 3, 2);

-- Populate comment table
INSERT INTO comment(comment, createdBy, commentFor) VALUES
('Yes, it is still available', 1, 1),
('Sure, please let me know a time that works for you', 4, 2);

-- Populate invoice table
INSERT INTO invoice(propertyId, issuedTo, issuedBy, amount, status, dueDate) VALUES
(1, 2, 1, 500000, 'Pending', '2024-10-31'),
(2, 3, 1, 2500, 'Paid', '2024-11-05');

-- Populate documentType table
INSERT INTO documentType(name, description) VALUES
('Contract', 'Property Sale or Rent Contract'),
('Invoice', 'Payment Invoice for Property'),
('ID Proof', 'Identification Proof Document');

-- Populate document table
INSERT INTO document(documentTypeId, filePath, uploadedBy, relatedToProperty, relatedToUser, relatedToInvoice, description) VALUES
(1, 'contract1.pdf', 1, 1, 2, NULL, 'Sale contract for apartment'),
(2, 'invoice1.pdf', 1, 1, NULL, 1, 'Invoice for apartment sale'),
(3, 'id_proof1.pdf', 2, NULL, 2, NULL, 'Customer ID Proof');

-- Populate paymentMethod table
INSERT INTO paymentMethod(methodName, description) VALUES
('Credit Card', 'Payment via Credit Card'),
('Bank Transfer', 'Payment via Bank Transfer'),
('Cash', 'Cash Payment');

-- Populate payment table
INSERT INTO payment(invoiceId, paidBy, paidTo, amount, paymentMethodId, paymentStatus) VALUES
(1, 2, 1, 500000, 1, 'Pending'),
(2, 3, 1, 2500, 2, 'Completed');