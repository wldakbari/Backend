drop database if exists verkkokauppa;

create database verkkokauppa;

use verkkokauppa;

CREATE TABLE user(  
    id int primary key AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    firstname varchar(50) not null,
    lastname varchar(50) not null,
    address varchar(50) not null,
    zip varchar(10) not null,
    city varchar(30) not null
) DEFAULT CHARSET UTF8 COMMENT '';

create table category (
  id int primary key auto_increment,
  name varchar(50) not null
);

create table product (
  id int primary key auto_increment,
  name varchar(100) not null,
  price double (10,2) not null,
  image varchar(50),
   description varchar(255),
  category_id int not null,
  index category_id(category_id),
  foreign key (category_id) references category(id)
  on delete restrict
);

create table `order` (
  id int PRIMARY key AUTO_INCREMENT,
  order_date timestamp default CURRENT_TIMESTAMP,
  user_id int not null,
  index user_id(user_id),
  foreign key (user_id) references user(id)
  on delete restrict
);


create table order_row (
  order_id int not null,
  index order_id(order_id),
  foreign key (order_id) references `order`(id)
  on delete restrict,
  product_id int not null,
  index product_id(product_id),
  foreign key (product_id) references product(id)
  on delete restrict,
  amount int not null
);

insert into category (name) values ('Shoes');
insert into category (name) values ('Tracksuits');

insert into product (name, price, category_id, image, description) values ('Nike air force 1', 150.00, 1, 'airforce1.webp', 'Size: 38.5 - 47.5');
insert into product (name, price, category_id, image, description) values ('Air Jordan The Ten', 2500.00, 1, 'airjordanred.jpeg', 'Size: 38.5 - 47.5');
insert into product (name, price, category_id, image, description) values ('Air Jordan University Blue', 2000.00, 1, 'airjordanblue.jpeg', 'Size: 38.5 - 47.5');
insert into product (name, price, category_id, image, description)values ('Yeezy Slide', 150.00, 1, 'slidespure.jpeg', 'Size: 38.5 - 47.5');
insert into product (name, price, category_id, image, description) values ('Yeezy Boost 350 V2', 500.00, 1, 'boost350.jpeg', 'Size: 38.5 - 47.5');
insert into product (name, price, category_id, image, description) values ('Yeezy Boost 750', 1500.00, 1, 'boost750.jpeg', 'Size: 38.5 - 47.5');
 insert into product (name, price, category_id, image, description) values ('Nike Tech tracksuit', 300.00, 2, 'niketech.jpeg', 'Size: XS - XXL');
insert into product (name, price, category_id, image, description) values ('Y-3 CL tracksuit', 400.00, 2, 'adidasy3.jpeg', 'Size: XS - XXL');
insert into product (name, price, category_id, image, description) values ('Palm Angels tracksuit ', 700.00, 2, 'palmangels.jpeg', 'Size: XS - XXL');
insert into product (name, price, category_id, image, description) values ('Moncler tracksuit', 900.00, 2, 'moncler.webp', 'Size: XS - XXL');
insert into product (name, price, category_id, image, description) values ('Trapstar tracksuit', 400.00, 2, 'trapstar.jpeg', 'Size: XS - XXL');
insert into product (name, price, category_id, image, description) values ('Gucci tracksuit', 1100.00, 2, 'gucci.jpeg', 'Size: XS - XXL');