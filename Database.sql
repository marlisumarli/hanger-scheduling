create table hanger_types
(
    id  varchar(55) not null
        primary key,
    qty int         not null
);

create table hangers
(
    id             varchar(55) not null
        primary key,
    hanger_type_id varchar(55) not null,
    order_number   int         not null,
    name           varchar(55) not null,
    qty            int         not null,
    constraint subjigs_types_null_fk
        foreign key (hanger_type_id) references hanger_types (id)
            on update cascade
);

create table periods
(
    id         varchar(11) not null
        primary key,
    created_at timestamp   not null
);

create table schedule_m_categories
(
    id varchar(3) not null
        primary key
);

create table supply_schedules
(
    id             varchar(55) not null
        primary key,
    hanger_type_id varchar(55) not null,
    period_id      varchar(11) not null,
    month          int         not null,
    is_done        tinyint     not null,
    constraint supply_schedules_hanger_types_null_fk
        foreign key (hanger_type_id) references hanger_types (id)
            on update cascade,
    constraint supply_schedules_periods_null_fk
        foreign key (period_id) references periods (id)
            on update cascade
);

create table schedule_weeks
(
    id                  varchar(55) not null
        primary key,
    supply_schedules_id varchar(55) not null,
    is_done             tinyint     not null,
    date                date        not null,
    m_id                varchar(3)  not null,
    constraint schedule_weeks_schedule_m_categories_null_fk
        foreign key (m_id) references schedule_m_categories (id),
    constraint schedules_schedules_subjig_null_fk
        foreign key (supply_schedules_id) references supply_schedules (id)
            on update cascade on delete cascade
);

create table supplies
(
    id               varchar(55) not null
        primary key,
    target_set       int         not null,
    hanger_type_id   varchar(55) null,
    schedule_week_id varchar(55) not null,
    constraint supplies_pk
        unique (schedule_week_id),
    constraint supplies_schedule_weeks_null_fk
        foreign key (schedule_week_id) references schedule_weeks (id)
            on update cascade on delete cascade,
    constraint supplies_types_null_fk
        foreign key (hanger_type_id) references hanger_types (id)
            on update cascade
);

create table supply_lines
(
    id        int auto_increment
        primary key,
    supply_id varchar(55) not null,
    hanger_id varchar(55) null,
    line_a    int         null,
    line_b    int         null,
    line_c    int         null,
    total     int         null,
    constraint supply_lines_subjigs_null_fk
        foreign key (hanger_id) references hangers (id)
            on update cascade,
    constraint supply_lines_supplies_null_fk
        foreign key (supply_id) references supplies (id)
            on update cascade on delete cascade
);

create table user_roles
(
    id        int         not null
        primary key,
    role_name varchar(55) not null,
    constraint karyawan_bagians_pk
        unique (role_name)
);

create table users
(
    username   varchar(55)  not null
        primary key,
    password   varchar(255) not null,
    full_name  varchar(125) not null,
    role_id    int          not null,
    last_login timestamp    null,
    constraint users_user_roles_null_fk
        foreign key (role_id) references user_roles (id)
);

create table sessions
(
    id       varchar(55)  not null
        primary key,
    username varchar(120) not null,
    constraint fk_sessions_user
        foreign key (username) references users (username)
            on update cascade on delete cascade
);

