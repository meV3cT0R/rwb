drop database realEstate;
create database realEstate;

use realEstate;

create table role(
    id int auto_increment primary key,
    name varchar(50) not null,
    createdAt datetime default current_timestamp
);

insert into role(name) values('ADMIN'),('CUSTOMER'),('OWNER'),('AGENT');

create table user(
    id int auto_increment primary key,
    firstName varchar(50) not null,
    lastName varchar(50) not null,
    email varchar(100) not null,
    username varchar(50) not null,
    password varchar(255) not null,
    roleId int,
    avatar varchar(255) not null,
    foreign key (roleId) references role(id) on delete set null,
    createdAt datetime default current_timestamp

);

create table country (
    id int auto_increment primary key,
    name varchar(50) not null,
    createdBy int,
    createdAt datetime default current_timestamp,
    foreign key (createdBy) references user(id) on delete set null
);

create table state (
    id int auto_increment primary key,
    name varchar(50) not null,
    countryId int not null,
    createdBy int,
    createdAt datetime default current_timestamp,
    foreign key (createdBy) references user(id) on delete set null,
    foreign key (countryId) references country(id) on delete cascade
);

create table city (
    id int auto_increment primary key,
    name varchar(50) not null,
    countryId int not null,
    stateId int,
    createdBy int,
    createdAt datetime default current_timestamp,
    foreign key (createdBy) references user(id) on delete set null,
    foreign key (countryId) references country(id) on delete cascade,
    foreign key (stateId) references state(id) on delete set null
);

create table propertyType (
    id int auto_increment primary key,
    name varchar(50) not null,
    createdBy int,
    createdAt datetime default current_timestamp,
    foreign key (createdBy) references country(id) on delete set null
);

create table property(
    id int auto_increment primary key,
    propertyType int,
    status varchar(20) not null,
    yearBuilt int not null,
    marketedBy int not null,
    description varchar(255) not null,
    price float not null,
    totalSqFt float not null,
    lotSizeUnit varchar(20) not null,
    lotSize float not null,
    cityId int,
    address varchar(50) not null,
    foreign key (marketedBy) references user(id) on delete cascade,
    foreign key (cityId) references city(id) on delete set null,
    createdAt datetime default current_timestamp
);

create table propertyPhotos (
    id int auto_increment primary key,
    url varchar(255) not null,
    propertyId int not null,
    foreign key (propertyId) references property(id) on delete cascade,
    createdAt datetime default current_timestamp
);

create table enquiry(
    id int auto_increment primary key,
    enquiry varchar(255) not null,
    createdBy int not null,
    enquiryFor int not null,
    createdAt datetime default current_timestamp,
    foreign key (enquiryFor) references property(id) on delete cascade,
    foreign key (createdBy) references user(id) on delete cascade
);

create table comment (
    id int auto_increment primary key,
    comment varchar(255) not null,
    createdBy int not null,
    commentFor int not null,
    createdAt datetime default current_timestamp,
    foreign key (commentFor) references enquiry(id) on delete cascade,
    foreign key (createdBy) references user(id) on delete cascade
);

create table invoice (
    id int auto_increment primary key,
    propertyId int not null,            
    issuedTo int not null,    
    issuedBy int not null,             
    amount float not null,             
    status varchar(20) not null,      
    dueDate date not null,              
    createdAt datetime default current_timestamp,
    foreign key (propertyId) references property(id) on delete cascade,
    foreign key (issuedTo) references user(id) on delete cascade,
    foreign key (issuedBy) references user(id) on delete cascade
);

create table documentType (
    id int auto_increment primary key,
    name varchar(50) not null,           
    description varchar(255),            
    createdAt datetime default current_timestamp
);


create table document (
    id int auto_increment primary key,
    documentTypeId int,            
    filePath varchar(255) not null,         
    uploadedBy int not null,                 
    relatedToProperty int,                  
    relatedToUser int,                      
    relatedToInvoice int,                    
    description varchar(255),                
    createdAt datetime default current_timestamp,
    foreign key (documentTypeId) references documentType(id) on delete set null,
    foreign key (uploadedBy) references user(id) on delete cascade,
    foreign key (relatedToProperty) references property(id) on delete cascade,
    foreign key (relatedToUser) references user(id) on delete set null,
    foreign key (relatedToInvoice) references invoice(id) on delete set null
);




create table paymentMethod (
    id int auto_increment primary key,
    methodName varchar(50) not null,      
    description varchar(255),        
    createdAt datetime default current_timestamp
);
create table payment (
    id int auto_increment primary key,
    invoiceId int not null,    
    paidBy int not null,           
    paidTo int not null,                
    amount float not null,            
    paymentDate datetime default current_timestamp, 
    paymentMethodId int, 
    paymentStatus varchar(20) not null, 
    createdAt datetime default current_timestamp,
    foreign key (invoiceId) references invoice(id) on delete cascade,
    foreign key (paidBy) references user(id) on delete cascade,
    foreign key (paidTo) references user(id) on delete cascade,
    foreign key (paymentMethodId) references paymentMethod(id) on delete cascade 
);



