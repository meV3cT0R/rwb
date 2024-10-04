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
    foreign key (marketedBy) references user(id) on delete cascade,
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


