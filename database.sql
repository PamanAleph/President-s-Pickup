create table sender (
        sender_id int (12) primary key auto_increment,
        sender_name varchar (100),
        sender_address varchar (100),
        sender_pnumber varchar (100),
        sender_email varchar (100)
);
create table recipient (
        recipient_id int (12) primary key auto_increment,
        recipient_name varchar (100),
        destination_id  int (12),
        recipient_pnumber varchar (100),
        recipient_email varchar (100),
        foreign key (destination_id) references destination (destination_id)

);
create table destination(
        destination_id int (12) primary key auto_increment,
        destination_name varchar(100),
        destination_address varchar (255)
);
create table courier (
        courier_id int (12) primary key auto_increment,
        courier_name varchar (100),
        courier_address varchar (100),
        courier_pnumber varchar (100),
        courier_email varchar (100),
        destination_id int (12),

        foreign key (destination_id) references destination (destination_id)
);
create table item (
        item_id int (12) primary key auto_increment,
        item_name varchar (100),
        item_type varchar (20),
        item_insurance varchar (10),
        item_weight int (50)
);
create table services (
        services_id int (12) primary key auto_increment,
        services_name varchar (100),
        services_price double,
        services_duration varchar (50)
);
create table orders (
    orders_id int (12) auto_increment,
    sender_id int (12),
    recipient_id int (12),
    courier_id int (12),
    item_id int (12),
    services_id int (12),
    destination_id int(16),
    orders_date timestamp (6),
    orders_price int (20),
    orders_status varchar (255),

    primary key (orders_id),
    foreign key (sender_id) references sender (sender_id),
    foreign key (recipient_id) references recipient (recipient_id),
    foreign key (courier_id) references courier (courier_id),
    foreign key (item_id) references item (item_id),
    foreign key (services_id) references services (services_id),
    foreign key (destination_id) references destination (destination_id)
);


ALTER TABLE sender AUTO_INCREMENT = 1000001;
ALTER TABLE recipient AUTO_INCREMENT = 2000001;
ALTER TABLE courier AUTO_INCREMENT = 3000001;
ALTER TABLE item AUTO_INCREMENT = 4000001;
ALTER TABLE services AUTO_INCREMENT = 5000001;
ALTER TABLE orders AUTO_INCREMENT = 6000001;
ALTER TABLE destination  AUTO_INCREMENT = 7000001

