create table budgets (
    id bigint unsigned not null auto_increment,
    type enum('spending', 'income') not null,
    item_name varchar(1024),
    expense_id int(10) not null,
    amount bigint not null,
    created_at timestamp not null default current_timestamp,
    primary key (id)
);

create table expense (
    id bigint unsigned not null auto_increment,
    expense_name varchar(256) not null, 
    primary key (id)
);
