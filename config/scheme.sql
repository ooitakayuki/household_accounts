create table budgets (
    id bigint unsigned not null auto_increment,
    type enum('spending', 'income') not null,
    item_name varchar(1024),
    expense_id int(10) not null,
    amount bigint not null,
    created_at timestamp not null default current_timestamp,
    primary key (id),
    key idx_type (type),
    key idx_expense (expense_id),
    key idx_type_expense (type, expense_id)
);

create table expense (
    id bigint unsigned not null auto_increment,
    expense_name varchar(256) not null, 
    primary key (id)
);

insert into expense (expense_name) values ('食費');
insert into expense (expense_name) values ('水道光熱費');
insert into expense (expense_name) values ('通信費');
insert into expense (expense_name) values ('レジャー費');
insert into expense (expense_name) values ('交通費');
insert into expense (expense_name) values ('美容費');
insert into expense (expense_name) values ('医療費');
insert into expense (expense_name) values ('被服費');
insert into expense (expense_name) values ('生活雑貨・日用品');
insert into expense (expense_name) values ('住宅費');
insert into expense (expense_name) values ('税金');
insert into expense (expense_name) values ('保険');
insert into expense (expense_name) values ('給与・賞与');
insert into expense (expense_name) values ('その他');
