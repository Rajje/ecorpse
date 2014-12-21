create table Story (
	storyID varchar(255) primary key, 
	totalNumberOfPosts int,
	completed boolean not null default false,
	language varchar(63) references Languages(language),
	points int default 0,
	check (totalNumberOfPosts > 0),
	check (points >= 0)
);

create table Post (
	storyID varchar(255) references Story(storyID), 
	post text not null, 
	postNr varchar(11), 
	writtenBy varchar(63) references User(username) on update cascade,
	dateWritten date,
	language varchar(63) references Languages(language),
	primary key (storyID, postNr),
	check (postNr > 0)
);

create table StoryCharacter (
	characterID int primary key, 
	name varchar(255) not null, 
	description text,
	points int default 0,
	createdBy varchar(63) references User(username) on update cascade,
	check (points >= 0)
);

create table AppearsIn (
	storyID int references Story(storyID),
	characterID int references StoryCharacter(characterID)
);

create table User (
	username varchar(63) primary key,
	registered date,
	email varchar(255),
	picture mediumblob
);

create table Languages (
	language varchar(63) not null
);

create table MenuItems (
	itemOrder int,
	itemName varchar(63),
	itemLanguage varchar(63) references Languages(language)	
);