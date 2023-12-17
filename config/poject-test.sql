-- buat database project_test
create database project_test;

-- buat database test_project_test
create database test_project_test;

-- gunakan database project_test
use project_test;

-- gunakan database test
use test_project_test;

-- buat table users
CREATE table users (
	id int(11) not null auto_increment,
	nama varchar(255) not null,
	username varchar(255) not null,
	password varchar(255) not null,
	primary key(id)
)engine = innodb;

-- buat table sessions
CREATE table sessions(
	id varchar(255) not null,
	user_id varchar(255) not null,
	primary key (id)
)engine=innodb;