CREATE DATABASE users

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE message(
	idMess int NOT NULL PRIMARY KEY,
	id int NOT NULL references account(id),
	sender varchar(255) NOT NULL,
	content varchar(255),
);
CREATE TABLE game(
	challID varchar(255) NOT NULL PRIMARY KEY,
	challenge varchar(255) NOT NULL,
	hint varchar(255),
	id int references account(id),
);
INSERT INTO account(id,username,password,fullName,email,phone)
VALUES ('1', 'quynhnn', '1234', 'nguyen nhu quynh', 'quynhnnhe140094@fpt.edu.vn', '01231231234');
INSERT INTO Message(idMess,id,sender,content)
VALUES ('1', '1', 'quynhnn', 'helloworld');
INSERT INTO game(challID, challenge, hint, id)
VALUES ('1', 'acm', 'tungdlm', '1');

