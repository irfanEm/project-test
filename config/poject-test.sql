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