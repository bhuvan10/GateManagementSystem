-- GATE MANAGEMENT SYSTEM
-- BHUVAN GUPTA (2020B4A71654P) 
-- AKSHAJ DIXIT (2020B4A70948)

create Database gate_management;
use gate_management;

create table user(
 USER_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 FIRST_NAME CHAR(25),
 LAST_NAME CHAR(25),
 username  varchar(30) unique not null ,
 password   varchar(30) not null
);
CREATE TABLE vehicle(
  PLATE_NUMBER varchar(25) not null,
  COLOR varchar(25),
  VEHICLE_TYPE varchar(200),
  PRIMARY KEY(PLATE_NUMBER)
 );
CREATE TABLE owner(
 USER_ID int not null references  user on delete cascade on update cascade,
 PLATE_NUMBER varchar(25) not null,
 PRIMARY KEY(USER_ID,PLATE_NUMBER),
 FOREIGN KEY (USER_ID) REFERENCES user(USER_ID) ON DELETE CASCADE ON UPDATE CASCADE,
 FOREIGN KEY (PLATE_NUMBER) REFERENCES vehicle(PLATE_NUMBER) ON DELETE CASCADE ON UPDATE CASCADE
);

 CREATE TABLE gate_log(
   ENTRY_TIME datetime default current_timestamp,
   USER_ID int not null ,
   PLATE_NUMBER varchar(25) ,
   EXIT_TIME datetime default NULL,
   PRIMARY KEY(ENTRY_TIME,USER_ID,PLATE_NUMBER),
 FOREIGN KEY (PLATE_NUMBER) REFERENCES vehicle(PLATE_NUMBER ) ON UPDATE CASCADE,
 FOREIGN KEY (USER_ID) REFERENCES user(USER_ID ) ON UPDATE CASCADE
   );

 INSERT INTO user (FIRST_NAME,LAST_NAME,username,password) VALUES
('Amit','Kumar','hello','amitkumar'),
('Sumit','Wilson','heilo','sumitwilson'),
('Rajesh','Kumar','mathematicalmethods','rajeshkumar'),
('Trilok','Mathur','Topo','trilokmathur'),
('Krishan','Kumar','graphs','krishankumar'),
('Balram','Dubey','Funal','balramdubey'),
('Devendra','Kumar','pde','devendrakumar'),
('Sangeeta','Yadav','diffgeo','sangeetayadav'),
('Ankit','Sharma','arrays','ankitsharma'),
('Amita','Kumari','hell','amitakumari');

INSERT INTO vehicle (PLATE_NUMBER,COLOR,VEHICLE_TYPE) VALUES
('RJ15FD9951','black','Two-wheeler'),
('RJ65FD9051','red','Four-wheeler'),
('RJ61YD3251','blue','Two-wheeler'),
('RJ69HD5286','black','Four-wheeler'),
('RJ17FD5789','green','Two-wheeler'),
('RJ22FD5771','golden','Two-wheeler'),
('RJ17YD5251','black','Four-wheeler'),
('RJ35PP9251','grey','Four-wheeler'),
('RJ85KD5251','white','Two-wheeler'),
('RJ11SD5251','white','Four-wheeler');


INSERT INTO owner (USER_ID,PLATE_NUMBER) VALUES
(2,'RJ15FD9951'),
(1,'RJ65FD9051'),
(3,'RJ61YD3251'),
(4,'RJ69HD5286'),
(5,'RJ17FD5789'),
(6,'RJ22FD5771'),
(7,'RJ17YD5251'),
(8,'RJ35PP9251'),
(9,'RJ85KD5251'),
(10,'RJ11SD5251');

INSERT INTO gate_log (USER_ID,PLATE_NUMBER) VALUES
(2,'RJ15FD9951'),
(1,'RJ65FD9051'),
(3,'RJ61YD3251'),
(4,'RJ69HD5286'),
(5,'RJ17FD5789'),
(6,'RJ22FD5771'),
(7,'RJ17YD5251'),
(8,'RJ35PP9251'),
(9,'RJ85KD5251'),
(10,'RJ11SD5251');

select * from user;
select * from vehicle;
select * from owner;
select * from gate_log;

-- user authentication

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION
`password_auth`(username varchar(25),password varchar(25)) RETURNS varchar(50)
 DETERMINISTIC
begin
declare result varchar(30);
 IF EXISTS (SELECT * FROM user WHERE password=password AND username=username)
 THEN SET result = 'User Authenticated';
 ELSEIF NOT EXISTS (SELECT * FROM user WHERE password=password AND username=username)
 THEN SET result = 'User not Authenticated';
 END IF;
 return result;
end$$
DELIMITER ;

-- calling user authentication function
select gate_management.password_auth('hello', 'amitkumar');

-- to reset password
update user set password="1234" where username = "hello" AND FIRST_NAME="Amit";

select gate_management.password_auth('hello', '1234');

-- to register vehicle by user
start TRANSACTION;
insert into vehicle (PLATE_NUMBER,COLOR,VEHICLE_TYPE) VALUES ("RJ15ZX2233","white","Two-wheeler");
insert into owner (USER_ID,PLATE_NUMBER) VALUES (5,"RJ15ZX2233");
commit ;

select * from vehicle NATURAL JOIN owner;

-- to search for vehicle record based on user FIRST NAME AND LAST NAME
select PLATE_NUMBER,COLOR,VEHICLE_TYPE from user NATURAL JOIN owner NATURAL JOIN vehicle where FIRST_NAME="Amit";

-- gate authority to record entry exit time
update gate_log set EXIT_TIME =current_timestamp()  where USER_ID=1 AND PLATE_NUMBER="RJ65FD9051";

select * from gate_log;

-- entry/exit time received by user
select PLATE_NUMBER,ENTRY_TIME,EXIT_TIME from  gate_log where USER_ID=1;

-- vehicle types
select VEHICLE_TYPE,count(*) from vehicle group by VEHICLE_TYPE;

-- peak hour wise
select extract(hour from ENTRY_TIME) as hr,count(*) from gate_log group by extract(hour from ENTRY_TIME)order by 1;
