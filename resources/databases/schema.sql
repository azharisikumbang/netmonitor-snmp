create table 
	`roles` (
    `id` int unsigned not null auto_increment primary key,
    `name` varchar(255) null
);

create table
  `users` (
    `id` int unsigned not null auto_increment primary key,
    `name` varchar(255) null,
    `username` varchar(255) null,
    `password` varchar(255) null,
    `role_id` INTEGER UNSIGNED null,
    `created_at` timestamp not null default CURRENT_TIMESTAMP,
    
    foreign key (`role_id`) references roles(id)
  );