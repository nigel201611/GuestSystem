DROP DATABASE IF EXISTS nigel;
CREATE DATABASE IF NOT EXISTS nigel;
USE nigel;
CREATE TABLE IF NOT EXISTS user(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) UNIQUE,
	pwd VARCHAR(50),

);

ALTER TABLE user ADD (
	uniq VARCHAR(60),
	active VARCHAR(60),
	email VARCHAR(60),
	qq VARCHAR(20),
	time DATETIME,
	user_ip VARCHAR(40),
	login_count SMALLINT UNSIGNED,
	head_img VARCHAR(60),
	person_info TEXT
);


CREATE TABLE IF NOT EXISTS message(
	id INT PRIMARY KEY auto_increment,
	to_user VARCHAR(100),
	from_user VARCHAR(100),
	message_date DATETIME,
	message_content TEXT,
	message_state TINYINT(1)
);


INSERT INTO user VALUE(NULL,'18300093372','123456');