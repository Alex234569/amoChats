create table blocks
(
    blockId int,
    blockName varchar(500) not null
);

create unique index blocks_blockId_uindex
	on blocks (blockId);

alter table blocks
    add constraint blocks_pk
        primary key (blockId);

alter table blocks modify blockId int auto_increment;





create table issues
(
    issueId int,
    message varchar(10000) not null,
    `from` boolean not null,
    date date not null,
    status boolean default 0 null
);

create unique index issues_issueId_uindex
	on issues (issueId);

alter table issues
    add constraint issues_pk
        primary key (issueId);

alter table issues modify issueId int auto_increment;





CREATE TABLE `compound` (
    `block` int NOT NULL,
    `issue` int NOT NULL
) ENGINE=InnoDB;