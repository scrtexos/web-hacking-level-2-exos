/*drop table person;
drop table shares;
drop table friends;*/

create table person (
	id INTEGER auto_increment,
	name VARCHAR(100),
	password VARCHAR(100),
	bday DATE,
	sex VARCHAR(10),
	status VARCHAR(100),
	PRIMARY KEY (id)
);

create table shares (
	id INTEGER auto_increment,
	person_id INTEGER REFERENCES person,
	content TEXT,
	submission DATETIME,
	PRIMARY KEY(id)
);

create table friends (
	id INTEGER auto_increment,
	person1 INTEGER REFERENCES person,
	person2 INTEGER REFERENCES person,
	PRIMARY KEY(id)
);

insert into person (name,password) VALUES ('admin',sha1('truite||admin'));
insert into person (name,password) VALUES ('alain',sha1('truite||alain'));
insert into friends (person1,person2) VALUES ((SELECT id FROM person WHERE name = 'admin'),(SELECT id FROM person WHERE name = 'alain'));
