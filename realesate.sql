create database realestate;
use realestate;
create table users(
id int auto_increment primary key,
fullname varchar(100) not null,
email varchar(100) not null,
password varchar(255) not null
);

create table properties(
id int primary key auto_increment,
user_id int not null,
property_name varchar(200) not null,
location varchar(100) not null,
price decimal(10,2) not null,
property_type varchar(200) not null,
image varchar(255) not null,
created_at datetime default current_timestamp,

foreign key properties(user_id)  references users(id) 
);

desc properties;

select * from users;
