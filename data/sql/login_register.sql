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


CREATE TABLE IF NOT EXISTS friend(
	id INT PRIMARY KEY auto_increment,
	to_user VARCHAR(100),
	from_user VARCHAR(100),
 	friend_date DATETIME,
 	friend_content TEXT,
 	friend_state TINYINT(1) DEFAULT 0
 );

CREATE TABLE IF NOT EXISTS flower(
 	id INT PRIMARY KEY auto_increment,
 	to_user VARCHAR(100),
 	from_user VARCHAR(100),
  flower_date DATETIME,
  flower_content TEXT,
	flower_count INT
);
CREATE TABLE IF NOT EXISTS article(
 	id INT PRIMARY KEY auto_increment,
 	username VARCHAR(100),
 	put_title VARCHAR(100),
  pub_date DATETIME,
  pub_content LONGTEXT,
	pub_readCount INT,
	pub_commentCount INT
);

CREATE TABLE IF NOT EXISTS comment(
 	id INT PRIMARY KEY auto_increment,
 	comment_username VARCHAR(100),
 	comment_title VARCHAR(100),
  comment_content LONGTEXT,
	comment_date DATETIME,
	comment_count INT,
  article_id INT,
	article_username VARCHAR(100)
);

INSERT INTO user VALUE(NULL,'18300093372','123456');