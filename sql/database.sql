CREATE DATABASE test

CREATE TABLE Account(
    id int NOT NULL PRIMARY KEY,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    fullName varchar(255) NOT NULL,
    email nvarchar(255) NOT NULL,
    phone int,   
);
CREATE TABLE Message(
	idMess int NOT NULL PRIMARY KEY,
	id int NOT NULL references Account(id),
	sender varchar(255) NOT NULL,
	content varchar(255),
);
CREATE TABLE Game(
	challID varchar(255) NOT NULL PRIMARY KEY,
	challenge varchar(255) NOT NULL,
	hint varchar(255),
	id int references Account(id),
);
INSERT INTO Account(id,username,password,fullName,email,phone)
VALUES ('1', 'quynhnn', '1234', 'nguyen nhu quynh', 'quynhnnhe140094@fpt.edu.vn', '01231231234');
INSERT INTO Message(idMess,id,sender,content)
VALUES ('1', '1', 'quynhnn', 'helloworld');
INSERT INTO Game(challID, challenge, hint, id)
VALUES ('1', 'acm', 'tungdlm', '1');

