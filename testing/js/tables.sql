create table if not exists blocks
(
    blockId int auto_increment,
    blockName varchar(500) not null,
    constraint blocks_blockId_uindex
    unique (blockId)
    );

alter table blocks
    add primary key (blockId);

create table if not exists issues
(
    issueId int auto_increment,
    caption varchar(100) not null,
    status tinyint(1) default 0 null,
    constraint issues_issueId_uindex
    unique (issueId)
    );

alter table issues
    add primary key (issueId);

create table if not exists issueCompound
(
    block int not null,
    issue int not null,
    constraint IssueCompound_blocks_blockId_fk
    foreign key (block) references blocks (blockId)
    on delete cascade,
    constraint IssueCompound_issues_issueId_fk
    foreign key (issue) references issues (issueId)
    on delete cascade
    );

create table if not exists main
(
    id_main int auto_increment
    primary key,
    question varchar(1000) not null,
    answer varchar(3000) not null,
    url varchar(255) null,
    date date null
    );

create table if not exists messages
(
    messageId int auto_increment,
    text varchar(10000) not null,
    `from` tinyint(1) not null,
    date varchar(100) not null,
    constraint messages_messageId_uindex
    unique (messageId)
    );

alter table messages
    add primary key (messageId);

create table if not exists issueToMessageCompound
(
    issue int not null,
    message int not null,
    constraint issueToMessageCompound_issues_issueId_fk
    foreign key (issue) references issues (issueId)
    on delete cascade,
    constraint issueToMessageCompound_messages_messageId_fk
    foreign key (issue) references messages (messageId)
    on delete cascade
    );

create table if not exists tegs
(
    id_teg int auto_increment
    primary key,
    teg varchar(255) not null
    );

create table if not exists compound
(
    id_main int null,
    id_teg int null,
    constraint compound_ibfk_1
    foreign key (id_main) references main (id_main)
    on delete cascade,
    constraint compound_ibfk_2
    foreign key (id_teg) references tegs (id_teg)
    on delete cascade
    );

create index id_main
	on compound (id_main, id_teg);

