drop table if exists Admin_Manages cascade;
drop table if exists Purchase_ShippingMethod cascade;
drop table if exists Admin_Edits cascade;
drop table if exists PurchaseHistory_Contains_Purchase cascade;
drop table if exists Admin cascade;
drop table if exists ShoppingCart cascade;
drop table if exists Customer_Account cascade;
drop table if exists ShippingMethod cascade;
drop table if exists Purchase cascade;
drop table if exists Supplies_Item cascade;
drop table if exists Supplier cascade;

CREATE TABLE Admin(
	e_id INT NOT NULL,
	e_name VARCHAR(20) NOT NULL,
	e_pass VARCHAR(20) NOT NULL,
 	PRIMARY KEY (e_id)
 	);
 
CREATE TABLE Customer_Account(
 	c_id INT NOT NULL,
 	c_name VARCHAR(20),
 	c_address VARCHAR(20),
 	c_email VARCHAR(20) NOT NULL,
 	c_phone INT NOT NULL,
	c_pass VARCHAR(20),
 	PRIMARY KEY (c_id, c_email, c_phone)
	);

CREATE TABLE Supplier(
 	s_name VARCHAR(30) NOT NULL,
 	s_phone_num INT,
 	s_address VARCHAR(30),
 	PRIMARY KEY (s_name)
 	);

CREATE TABLE Supplies_Item(
 	s_name VARCHAR(30) NOT NULL,
	s_pname VARCHAR(30) NOT NULL,
 	s_pid INT NOT NULL,
 	s_stock INT,
 	s_type VARCHAR(30),
 	s_price INT,
 	PRIMARY KEY (s_pid, s_name),
 	FOREIGN KEY (s_name)
 	REFERENCES Supplier(s_name)
	ON UPDATE CASCADE ON DELETE CASCADE
 	);

CREATE TABLE ShoppingCart(
 	total_price INT,
 	qty INT,
 	c_id INT NOT NULL,
 	c_phone INT NOT NULL,
 	c_email VARCHAR(20) NOT NULL,
 	PRIMARY KEY (c_id),
 	CONSTRAINT link_account FOREIGN KEY (c_id, c_email, c_phone)
 	REFERENCES Customer_Account(c_id, c_email, c_phone)
 	);

CREATE TABLE Purchase(
 	tid INT,
	s_pid INT,
	s_name VARCHAR(30),
 	date DATE,
 	amount INT,
 	PRIMARY KEY (tid, s_pid, s_name),
	CONSTRAINT link_item FOREIGN KEY (s_pid, s_name)
	REFERENCES Supplies_Item(s_pid, s_name)
	ON DELETE CASCADE ON UPDATE CASCADE
 	);

CREATE TABLE Purchase_ShippingMethod(
 	type VARCHAR(40),
 	tid INT,
 	PRIMARY KEY (tid),
 	FOREIGN KEY (tid) REFERENCES Purchase(tid)
	ON DELETE CASCADE ON UPDATE CASCADE
 	);

CREATE TABLE ShippingMethod(
 	type VARCHAR(40) NOT NULL,
 	cost INT,
 	eta DATE,
 	PRIMARY KEY (type)
 	);

CREATE TABLE Admin_Manages(
 	c_id INT NOT NULL,
 	e_id INT NOT NULL,
 	PRIMARY KEY (c_id, e_id),
 	FOREIGN KEY (c_id) REFERENCES Customer_Account(c_id)
	ON DELETE CASCADE ON UPDATE CASCADE,
 	FOREIGN KEY (e_id) REFERENCES Admin(e_id)
 	);

CREATE TABLE Admin_Edits(
 	e_id INT NOT NULL,
 	s_name VARCHAR(30) NOT NULL,
 	s_pid INT NOT NULL,
 	PRIMARY KEY (e_id, s_pid, s_name),
 	FOREIGN KEY (e_id) REFERENCES Admin(e_id)
	ON DELETE CASCADE ON UPDATE CASCADE,
 	CONSTRAINT edit_stock FOREIGN KEY (s_name, s_pid)
 	REFERENCES Supplies_Item(s_name, s_pid)
 	ON UPDATE CASCADE ON DELETE CASCADE
 	);

CREATE TABLE PurchaseHistory_Contains_Purchase(
 	c_id INT NOT NULL,
 	tid INT,
 	KEY (c_id),
 	FOREIGN KEY (c_id) REFERENCES Customer_Account(c_id)
	ON DELETE CASCADE ON UPDATE CASCADE,
 	FOREIGN KEY (tid) REFERENCES Purchase(tid)
	ON DELETE CASCADE ON UPDATE CASCADE
 	);

INSERT INTO Admin (e_id, e_name, e_pass) VALUES(001, 'Hugo', 'admin1');
INSERT INTO Admin (e_id, e_name, e_pass) VALUES(002, 'Trevor', 'admin2');
INSERT INTO Admin (e_id, e_name, e_pass) VALUES(003, 'Michelle', 'admin3');
INSERT INTO Admin (e_id, e_name, e_pass) VALUES(004, 'Li Jye', 'admin4');


INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(0,'Adrian','Unit 1','adrian@gmail.com',5550001,'aaa');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(1,'Brandon','Unit 2','brandon@gmail.com',5550002,'bbb');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(2,'Charlie','Unit 3','charlie@gmail.com',5550003,'ccc');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(3,'David','Unit 4','david@gmail.com',5550004,'ddd');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(4,'Emily','Unit 5','emily@gmail.com',5550005,'eee');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(5,'Frank','Unit 6','frank@gmail.com',5550006,'fff');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(6,'George','Unit 7','george@gmail.com',5550007,'ggg');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(7,'Hugo','Unit 8','hugo@gmail.com',5550008,'hhh');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(8,'Ivan','Unit 9','ivan@gmail.com',5550009,'iii');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(9,'Jason','Unit 10','jason@gmail.com',5550010,'jjj');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(10,'Karen','Unit 11','karen@gmail.com',5550011,'kkk');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(11,'Lily','Unit 12','lily@gmail.com',5550012,'lll');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(12,'Mark','Unit 13','mark@gmail.com',5550013,'mmm');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(13,'Nathan','Unit 14','nathan@gmail.com',5550014,'nnn');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(14,'Otis','Unit 15','otis@gmail.com',5550015,'ooo');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(15,'Peony','Unit 16','peony@gmail.com',5550016,'ppp');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(16,'Queenie','Unit 17','queenie@gmail.com',5550017,'qqq');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(17,'Roger','Unit 18','roger@gmail.com',5550018,'rrr');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(18,'Steve','Unit 19','steve@gmail.com',5550019,'sss');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(19,'Tom','Unit 20','tom@gmail.com',5550020,'ttt');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(20,'Uber','Unit 21','uber@gmail.com',5550021,'uuu');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(21,'Vanessa','Unit 22','vanessa@gmail.com',5550022,'vvv');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(22,'Walter','Unit 23','walter@gmail.com',5550023,'www');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(23,'Xavier','Unit 24','xavier@gmail.com',5550024,'xxx');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(24,'Yoona','Unit 25','yoona@gmail.com',5550025,'yyy');
INSERT INTO Customer_Account (c_id,c_name,c_address, c_email,c_phone, c_pass) VALUES(25,'Zayne','Unit 26','zayne@gmail.com',5550026,'zzz');

INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('AMD',1690001,'Warehouse 1');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('ASRock',1690002,'Warehouse 2');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('Asus',1690003,'Warehouse 3');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('EVGA',1690004,'Warehouse 4');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('Gigabyte',1690005,'Warehouse 5');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('Intel',1690006,'Warehouse 6');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('Logitech',1690007,'Warehouse 7');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('MSI',1690008,'Warehouse 8');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('Samsung',1690009,'Warehouse 9');
INSERT INTO Supplier (s_name,s_phone_num,s_address) VALUES('Corsair',1690010,'Warehouse 10');

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('AMD','FX 6300',6300,5,'Processor',110);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('AMD','FX 6350',6301,3,'Processor',130);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('AMD','FX 8300',6302,6,'Processor',160);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('AMD','FX 8350',6303,7,'Processor',190);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('ASRock','Z97 Extreme Pro 

3',4500,13,'Motherboard',170);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('ASRock','Z97 Extreme Pro 

4',4501,25,'Motherboard',210);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('ASRock','Z97M Extreme Pro 4',4502,8,'Motherboard', 

220);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','Z97-A',4503,19,'Motherboard',110);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','Z97-E',4504,22,'Motherboard',150);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','Z97-C',4505,13,'Motherboard',190);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','X99-A',5500,8,'Motherboard',210);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','X99-WIFI',5501,12,'Motherboard',240);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','X99-DELUXE',5502,4,'Motherboard',280);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','GTX 960',3300,15,'Video Card',210);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','GTX 970',3301,31,'Video Card',420);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','GTX 970 Strix',3302,19,'Video Card',440);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','R9 270',3308,18,'Video Card',190);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','R9 280',3309,17,'Video Card',240);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','R9 290',3310,12,'Video Card',350);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Asus','R9 290x',3311,9,'Video Card',540);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','500W B1',8800,5,'Power Supply',45);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','650W B1',8801,7,'Power Supply',60);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','750W G2',8802,9,'Power Supply',90);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','850W G2',8803,11,'Power Supply',120);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','GTX 970 FTW',3304,11,'Video Card',390);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','GTX 970 ACX',3305,25,'Video Card',410);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','GTX 980 ACX',3306,9,'Video Card',650);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('EVGA','Titan X',3307,2,'Video Card',1300);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Gigabyte','GTX 960',3312,18,'Video Card',200);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Gigabyte','GTX 970',3313,20,'Video Card',410);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Gigabyte','GTX 970 G1',3314,22,'Video Card',440);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Gigabyte','GTX 980',3315,15,'Video Card',670);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Gigabyte','GTX 980 G1',3316,8,'Video Card',700);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','i3 4150',6304,10,'Processor',105);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','i5 4460',6305,18,'Processor',220);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','i5 4690',6306,22,'Processor',240);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','i5 4690k',6307,33,'Processor',270);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','i7 4790',6308,17,'Processor',330);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','i7 4790k',6309,27,'Processor',380);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','730 120GB',9800,10,'SSD',170);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','730 240GB',9801,10,'SSD',240);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','730 480GB',9802,10,'SSD',360);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Intel','730 960GB',9803,10,'SSD',480);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Logitech','G302',1100,10,'Mouse',35);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Logitech','G402',1101,10,'Mouse',42);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Logitech','G502',1102,10,'Mouse',55);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Logitech','G240',1200,10,'Headset',35);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Logitech','G430',1201,10,'Headset',50);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Logitech','G930',1202,10,'Headset',90);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','Z97 Gaming 3',4506,10,'Motherboard',150);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','Z97 Gaming 5',4507,10,'Motherboard',180);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','Z97 Gaming 7',4508,10,'Motherboard',210);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','X99 Gaming 3',5503,10,'Motherboard',190);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','X99 Gaming 5',5504,10,'Motherboard',240);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','X99 Gaming 7',5505,10,'Motherboard',270);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','GTX 980',3317,10,'Video Card',690);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','GTX 980 TwinFrozr',3318,10,'Video Card',720);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','R9 290',3319,10,'Video Card',380);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('MSI','R9 290x TwinFrozr',3320,10,'Video Card',610);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','S24in 1080p',2200,10,'Monitor',150);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','S27in 1080p',2201,10,'Monitor',220);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','X27in 1440p',2203,10,'Monitor',330);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','X27in 2160p',2204,10,'Monitor',550);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','850 Evo 250GB',9804,10,'SSD',160);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','850 Evo 500GB',9805,10,'SSD',240);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','850 Pro 256GB',9806,10,'SSD',190);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','850 Pro 512GB',9807,10,'SSD',280);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','1x4GB DDR3',7700,10,'RAM',50);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','2X4GB DDR3',7701,10,'RAM',100);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','1X8GB DDR3',7702,10,'RAM',90);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','2X8GB DDR3',7703,10,'RAM',180);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','2x8GB DDR4',7704,10,'RAM',220);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Samsung','4x8GB DDR4',7705,10,'RAM',440);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','1x4GB DDR3',7706,10,'RAM',50);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','2x4GB DDR3',7707,10,'RAM',100);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','1x8GB DDR3',7708,10,'RAM',90);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','2x8GB DDR3',7709,10,'RAM',180);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','2x8GB DDR4',7710,10,'RAM',220);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','4x8GB DDR4',7711,10,'RAM',440);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','250D mITX',9990,10,'Case',80);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','350D mATX',9991,10,'Case',90);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','550D ATX',9992,10,'Case',100);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','750D ATX',9993,10,'Case',150);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','Air 240 mATX',9994,10,'Case',115);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','Air 540 ATX',9995,10,'Case',95);

INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','CX430W',8804,10,'Power Supply',35);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','CX500W',8805,10,'Power Supply',60);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','CX650W',8806,10,'Power Supply',75);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','AX660i',8807,10,'Power Supply',85);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','AX760i',8808,10,'Power Supply',125);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','AX1000i',8809,10,'Power Supply',165);
INSERT INTO Supplies_Item (s_name,s_pname,s_pid,s_stock,s_type,s_price) VALUES('Corsair','AX1200i',8810,10,'Power Supply',220);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (1, 1102, 'Logitech', '01/01/15', 55);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (1, 9805, 'Samsung', '01/01/15', 240);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (1, 1201, 'Logitech', '01/01/15', 50);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 1);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (0, 1);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (2, 2204, 'Samsung', '01/01/15', 550);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (2, 6309, 'Intel', '01/01/15', 380);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (2, 3307, 'EVGA', '01/01/15', 1300);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 2);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (2, 2);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (3, 8804, 'Corsair', '01/02/15', 35);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (3, 7706, 'Corsair', '01/02/15', 50);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 3);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (4, 3);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (4, 9990, 'Corsair', '01/03/15', 80);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 4);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (6, 4);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (5, 9991, 'Corsair', '01/03/15', 90);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 5);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (8, 5);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (6, 9992, 'Corsair', '01/04/15', 100);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 6);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (10, 6);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (7, 9993, 'Corsair', '01/05/15', 150);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 7);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (12, 7);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (8, 4506, 'MSI', '01/06/15', 150);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 8);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (14, 8);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (9, 5503, 'MSI', '01/06/15', 190);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 9);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (16, 9);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (10, 7701, 'Samsung', '01/07/15', 100);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 10);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (17, 10);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (11, 7707, 'Corsair', '01/08/15', 100);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 11);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (17, 11);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (12, 7703, 'Samsung', '01/07/15', 180);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 12);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (17, 12);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (13, 7710, 'Corsair', '01/08/15', 220);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 13);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (0, 13);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (14, 3315, 'Gigabyte', '01/10/15', 670);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 14);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (0, 14);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (15, 3316, 'Gigabyte', '01/10/15', 690);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 15);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (5, 15);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (16, 3306, 'EVGA', '01/10/15', 650);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 16);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (20, 16);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (17, 3301, 'Asus', '01/10/15', 420);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 17);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (20, 17);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (18, 3302, 'Asus', '01/10/15', 440);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 18);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (2, 18);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (19, 3304, 'EVGA', '01/10/15', 390);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 19);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (6, 19);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (20, 3305, 'EVGA', '01/10/15', 410);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 20);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (19, 20);

INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (21, 6301, 'AMD', '01/11/15', 110);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Express', 21);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (23, 21);
INSERT INTO Purchase (tid, s_pid, s_name, date, amount) VALUES (22, 6306, 'Intel', '01/12/15', 240);
INSERT INTO Purchase_ShippingMethod (type, tid) VALUES ('Regular', 22);
INSERT INTO PurchaseHistory_Contains_Purchase (c_id, tid) VALUES (25, 22);

INSERT INTO ShippingMethod (type, cost, eta) VALUES ('Regular', 10, '5 days');
INSERT INTO ShippingMethod (type, cost, eta) VALUES ('Express', 25, '2 days');

INSERT INTO Admin_Manages (c_id, e_id) VALUES (0, 001);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (1, 002);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (2, 003);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (3, 004);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (4, 001);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (5, 002);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (6, 003);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (7, 004);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (8, 001);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (9, 002);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (10, 003);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (11, 004);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (12, 001);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (13, 002);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (14, 003);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (15, 004);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (16, 001);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (17, 002);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (18, 003);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (19, 004);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (20, 001);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (21, 002);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (22, 003);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (23, 004);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (24, 001);
INSERT INTO Admin_Manages (c_id, e_id) VALUES (25, 003);

INSERT INTO Admin_Edits (e_id, s_name, s_pid) VALUES (001, 'Asus', 4503);
INSERT INTO Admin_Edits (e_id, s_name, s_pid) VALUES (003, 'Corsair', 8810);
INSERT INTO Admin_Edits (e_id, s_name, s_pid) VALUES (004, 'ASRock', 4500);

INSERT INTO ShoppingCart(total_price, qty, c_id, c_email, c_phone) VALUES(1000, 5, 0, 'adrian@gmail.com',5550001);

INSERT INTO ShoppingCart(total_price, qty, c_id, c_email, c_phone) VALUES(200, 4, 1,'brandon@gmail.com',5550002);

INSERT INTO ShoppingCart(total_price, qty, c_id, c_email, c_phone) VALUES(500, 3, 2, 'charlie@gmail.com',5550003);

INSERT INTO ShoppingCart(total_price, qty, c_id, c_email, c_phone) VALUES(750, 8, 3, 'david@gmail.com',5550004);

INSERT INTO ShoppingCart(total_price, qty, c_id, c_email, c_phone) VALUES(20, 1, 4, 'emily@gmail.com',5550005);
