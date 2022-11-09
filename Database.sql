CREATE SCHEMA subjig_report;
CREATE SCHEMA subjig_report_test;
CREATE SCHEMA kotretan;

CREATE TABLE karyawans
(
    username           VARCHAR(55) PRIMARY KEY,
    password           VARCHAR(255) NOT NULL,
    created_at         DATETIME     NOT NULL,
    update_password_at DATETIME     NOT NULL,
    online_status      BOOLEAN      NOT NULL,
    last_login         DATETIME     NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE karyawan_details
(
    id        INT PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(55) NOT NULL,
    name      VARCHAR(55) NOT NULL,
    bagian_id INTEGER     NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE karyawan_bagians
(
    id   INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(55) NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE sessions
(
    id       VARCHAR(55) PRIMARY KEY,
    username VARCHAR(120) NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;


CREATE TABLE log
(
    id        INTEGER PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(55) NOT NULL,
    action    VARCHAR(55) NOT NULL,
    action_at DATETIME    NOT NULL

) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE category
(
    id   INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55)         NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE category_surat_jalan
(
    id   INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55)         NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE k2f
(
    id   INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55)         NOT NULL,
    qty  INT                 NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE k1a
(
    id   INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55)         NOT NULL,
    qty  INT                 NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE mainjig
(
    id   INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55)         NOT NULL,
    qty  INT                 NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE messboat
(
    id   INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55)         NOT NULL,
    qty  INT                 NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_k2f
(
    id                INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id       INT         NOT NULL,
    type              VARCHAR(10) NOT NULL,
    year              DATE        NULL,
    speedometer_a     INT         NULL,
    speedometer_b     INT         NULL,
    ring_speedometer  INT         NULL,
    front_r           INT         NULL,
    front_l           INT         NULL,
    front_top         INT         NULL,
    fender            INT         NULL,
    under_rL          INT         NULL,
    lid_pocket        INT         NULL,
    body_rl           INT         NULL,
    center_upper      INT         NULL,
    rr_center         INT         NULL,
    center            INT         NULL,
    inner_upper       INT         NULL,
    cinner            INT         NULL,
    supply_tanggal    DATE        NULL,
    perbaikan_tanggal DATE        NULL,
    selesai_tanggal   DATE        NULL,
    pic               VARCHAR(55) NULL,
    datang_tanggal    DATE        NULL,
    keterangan        VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_k1a
(
    id                INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id       INT         NOT NULL,
    type              VARCHAR(10) NOT NULL,
    year              DATE        NULL,
    chf               INT         NULL,
    spdmt             INT         NULL,
    body_r            INT         NULL,
    body_l            INT         NULL,
    fender            INT         NULL,
    supply_tanggal    DATE        NULL,
    perbaikan_tanggal DATE        NULL,
    selesai_tanggal   DATE        NULL,
    pic               VARCHAR(55) NULL,
    datang_tanggal    DATE        NULL,
    keterangan        VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_mainjig
(
    id                INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id       INT         NOT NULL,
    type              VARCHAR(10) NOT NULL,
    year              DATE        NULL,
    jumlah            INT         NULL,
    supply_tanggal    DATE        NULL,
    perbaikan_tanggal DATE        NULL,
    selesai_tanggal   DATE        NULL,
    pic               VARCHAR(55) NULL,
    datang_tanggal    DATE        NULL,
    keterangan        VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_messboat
(
    id                INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id       INT         NOT NULL,
    type              VARCHAR(10) NOT NULL,
    year              DATE        NULL,
    jumlah            INT         NULL,
    supply_tanggal    DATE        NULL,
    perbaikan_tanggal DATE        NULL,
    selesai_tanggal   DATE        NULL,
    pic               VARCHAR(55) NULL,
    datang_tanggal    DATE        NULL,
    keterangan        VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE coba
(
    kode varchar(11) PRIMARY KEY NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

alter table category
    add created_at DATETIME not null,
    add updated_at DATETIME NULL;

alter table category_surat_jalan
    add created_at datetime not null,
    add updated_at datetime null;

alter table k1a
    add created_at datetime not null,
    add updated_at datetime null;

alter table k2f
    add created_at datetime not null,
    add updated_at datetime null;

alter table karyawan_details
    add created_at datetime not null,
    add updated_at datetime null;

alter table mainjig
    add created_at datetime not null,
    add updated_at datetime null;

alter table messboat
    add created_at datetime not null,
    add updated_at datetime null;

alter table karyawan_details
    add constraint karyawan_details_karyawans_null_fk
        foreign key (username) references subjig_report.karyawans (username)
            on update cascade on delete cascade;


SELECT karyawans.username, karyawan_details.name
FROM karyawan_details
         JOIN karyawans ON karyawan_details.username = karyawans.username;

SELECT usr.username,
       usr_d.full_name,
       usr_r.name,
       usr.created_at,
       usr_d.updated_at,
       usr.update_password_at,
       usr.password
FROM user_details as usr_d
         INNER JOIN users as usr ON usr.username = usr_d.credential
         INNER JOIN user_roles as usr_r ON usr_r.id = usr_d.role_id
WHERE usr_r.id = 2;

alter table category
#     modify created_at timestamp not null,
    modify updated_at timestamp null;


alter table category
    add constraint category_pk
        unique (name);

alter table tx_k2f
    add constraint fk_tx_k2f_category
        FOREIGN KEY (kode_category) REFERENCES category (kode);



CREATE DATABASE subjig_report;

create table category
(
    kode       varchar(55) not null
        primary key,
    name       varchar(55) not null,
    created_at timestamp   not null,
    updated_at timestamp   null,
    constraint category_pk
        unique (name)
);

create table category_surat_jalan
(
    id         varchar(11) not null
        primary key,
    name       varchar(55) not null,
    created_at timestamp   not null,
    updated_at timestamp   null
);

create table k1a
(
    kode       varchar(55) not null
        primary key,
    name       varchar(55) not null,
    qty        int         not null,
    created_at timestamp   not null,
    updated_at timestamp   null
);

create table k2f
(
    kode       varchar(55) not null
        primary key,
    name       varchar(55) not null,
    qty        int         not null,
    created_at timestamp   not null,
    updated_at timestamp   null
);

create table karyawan_bagians
(
    id         int         not null
        primary key,
    name       varchar(55) not null,
    created_at timestamp   not null,
    updated_at timestamp   null,
    constraint karyawan_bagians_pk
        unique (name)
);

create table karyawans
(
    username           varchar(55)          not null
        primary key,
    password           varchar(255)         not null,
    created_at         datetime             not null,
    update_password_at datetime             null,
    online_status      tinyint(1) default 0 not null,
    last_login         timestamp            null
);

create table karyawan_details
(
    id         int auto_increment
        primary key,
    username   varchar(55) not null,
    name       varchar(55) not null,
    bagian_id  int         not null,
    updated_at timestamp   null,
    constraint karyawan_details_pk
        unique (username),
    constraint karyawan_details_karyawan_bagians_null_fk
        foreign key (bagian_id) references karyawan_bagians (id)
            on update cascade,
    constraint karyawan_details_karyawans_null_fk
        foreign key (username) references karyawans (username)
            on update cascade on delete cascade
);

create table log
(
    id        int auto_increment
        primary key,
    username  varchar(55) not null,
    action    varchar(55) not null,
    action_at datetime    not null
);

create table mainjig
(
    kode       varchar(55) not null
        primary key,
    name       varchar(55) not null,
    qty        int         not null,
    created_at timestamp   not null,
    updated_at timestamp   null
);

create table messboat
(
    id         int         not null
        primary key,
    name       varchar(55) not null,
    qty        int         not null,
    created_at timestamp   not null,
    updated_at timestamp   null
);

create table sessions
(
    id       varchar(55)  not null
        primary key,
    username varchar(120) not null,
    constraint fk_sessions_user
        foreign key (username) references karyawans (username)
            on update cascade on delete cascade
);

create table tx_k1a
(
    id                varchar(55) not null
        primary key,
    category_code     varchar(11) not null,
    type              varchar(10) not null,
    year              year        null,
    chf               int         null,
    spdmt             int         null,
    body_r            int         null,
    body_l            int         null,
    fender            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null,
    updated_at        timestamp   null,
    constraint tx_k1a_category_null_fk
        foreign key (category_code) references category (kode)
);

create table tx_k2f
(
    id                varchar(55) not null
        primary key,
    category_code     varchar(11) not null,
    type              varchar(10) not null,
    year              year        null,
    speedometer_a     int         null,
    speedometer_b     int         null,
    ring_speedometer  int         null,
    front_r           int         null,
    front_l           int         null,
    front_top         int         null,
    fender            int         null,
    under_rl          int         null,
    lid_pocket        int         null,
    body_rl           int         null,
    center_upper      int         null,
    rr_center         int         null,
    center            int         null,
    inner_upper       int         null,
    cinner            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null,
    updated_at        timestamp   null,
    constraint tx_k2f_category_null_fk
        foreign key (category_code) references category (kode)
);

create table tx_mainjig
(
    id                int auto_increment
        primary key,
    category_id       int         not null,
    type              varchar(10) not null,
    year              date        null,
    jumlah            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null
);

create table tx_messboat
(
    id                int auto_increment
        primary key,
    category_id       int         not null,
    type              varchar(10) not null,
    year              date        null,
    jumlah            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null
);

create table tx_surat_jalan
(
    id              int auto_increment
        primary key,
    category_id     int  not null,
    tanggal         date not null,
    k2f             int  null,
    k1a             int  null,
    mainjig_line_a  int  null,
    mainjig_line_b  int  null,
    mainjig_line_c  int  null,
    messboat_line_a int  null,
    messboat_line_b int  null,
    messboat_line_c int  null
);

alter table subjig_report_test.user_details
    add constraint user_details_users_null_fk
        foreign key (credential) references subjig_report_test.users (username);



CREATE DATABASE subjig_report;

create table category
(
    kode       varchar(55) not null
        primary key,
    name       varchar(55) not null,
    created_at timestamp   not null,
    updated_at timestamp   null,
    constraint category_pk
        unique (name)
);

create table category_surat_jalan
(
    id         varchar(11) charset utf8mb3 not null
        primary key,
    name       varchar(55) charset utf8mb3 not null,
    created_at timestamp                   not null,
    updated_at timestamp                   null
);

create table k1a
(
    kode       varchar(55) charset utf8mb3 not null
        primary key,
    name       varchar(55) charset utf8mb3 not null,
    qty        int                         not null,
    created_at timestamp                   not null,
    updated_at timestamp                   null
);

create table k2f
(
    kode       varchar(55) charset utf8mb3 not null
        primary key,
    name       varchar(55) charset utf8mb3 not null,
    qty        int                         not null,
    created_at timestamp                   not null,
    updated_at timestamp                   null
);

create table log
(
    id        int auto_increment
        primary key,
    username  varchar(55) not null,
    action    varchar(55) not null,
    action_at datetime    not null
);

create table mainjig
(
    kode       varchar(55) charset utf8mb3 not null
        primary key,
    name       varchar(55) charset utf8mb3 not null,
    qty        int                         not null,
    created_at timestamp                   not null,
    updated_at timestamp                   null
);

create table messboat
(
    id         int                         not null
        primary key,
    name       varchar(55) charset utf8mb3 not null,
    qty        int                         not null,
    created_at timestamp                   not null,
    updated_at timestamp                   null
);

create table tx_k1a
(
    id                varchar(55) not null
        primary key,
    category_code     varchar(11) not null,
    type              varchar(10) not null,
    year              year        null,
    chf               int         null,
    spdmt             int         null,
    body_r            int         null,
    body_l            int         null,
    fender            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null,
    updated_at        timestamp   null,
    constraint tx_k1a_category_null_fk
        foreign key (category_code) references category (kode)
);

create table tx_k2f
(
    id                varchar(55) not null
        primary key,
    category_code     varchar(11) not null,
    type              varchar(10) not null,
    year              year        null,
    speedometer_a     int         null,
    speedometer_b     int         null,
    ring_speedometer  int         null,
    front_r           int         null,
    front_l           int         null,
    front_top         int         null,
    fender            int         null,
    under_rl          int         null,
    lid_pocket        int         null,
    body_rl           int         null,
    center_upper      int         null,
    rr_center         int         null,
    center            int         null,
    inner_upper       int         null,
    cinner            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null,
    updated_at        timestamp   null,
    constraint tx_k2f_category_null_fk
        foreign key (category_code) references category (kode)
);

create table tx_mainjig
(
    id                int auto_increment
        primary key,
    category_id       int         not null,
    type              varchar(10) not null,
    year              date        null,
    jumlah            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null
);

create table tx_messboat
(
    id                int auto_increment
        primary key,
    category_id       int         not null,
    type              varchar(10) not null,
    year              date        null,
    jumlah            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null
);

create table tx_surat_jalan
(
    id              int auto_increment
        primary key,
    category_id     int  not null,
    tanggal         date not null,
    k2f             int  null,
    k1a             int  null,
    mainjig_line_a  int  null,
    mainjig_line_b  int  null,
    mainjig_line_c  int  null,
    messboat_line_a int  null,
    messboat_line_b int  null,
    messboat_line_c int  null
);

create table user_roles
(
    id         int         not null
        primary key,
    name       varchar(55) not null,
    created_at timestamp   not null,
    updated_at timestamp   null,
    constraint karyawan_bagians_pk
        unique (name)
);

create table users
(
    username           varchar(55)          not null
        primary key,
    password           varchar(255)         not null,
    created_at         datetime             not null,
    update_password_at datetime             null,
    online_status      tinyint(1) default 0 not null,
    last_login         timestamp            null
);

create table sessions
(
    id
             varchar(55)  not null
        primary key,
    username varchar(120) not null,
    constraint fk_sessions_user
        foreign key (username) references users (username)
            on update cascade on delete cascade
);

create table user_details
(
    id         varchar(55) not null
        primary key,
    credential varchar(55) not null,
    full_name  varchar(55) not null,
    role_id    int         not null,
    updated_at timestamp   null,
    constraint karyawan_details_pk
        unique (credential),
    constraint user_details_user_roles_null_fk
        foreign key (role_id) references user_roles (id)
            on update cascade,
    constraint user_details_users_null_fk
        foreign key (credential) references users (username)
);


#
create table category
(
    category_id   varchar(55) not null
        primary key,
    category_name varchar(55) not null,
    created_at    timestamp   not null,
    updated_at    timestamp   null,
    constraint category_pk
        unique (category_name)
);

create table category_surat_jalan
(
    category_surat_jalan_id   varchar(11) charset utf8mb3 not null
        primary key,
    category_surat_jalan_name varchar(55) charset utf8mb3 not null,
    created_at                timestamp                   not null,
    updated_at                timestamp                   null
);

create table k1a
(
    k1a_id   varchar(55) charset utf8mb3 not null
        primary key,
    k1a_name varchar(55) charset utf8mb3 not null,
    k1a_qty  int                         not null
);

create table k2f
(
    k2f_id   varchar(55) charset utf8mb3 not null
        primary key,
    k2f_name varchar(55) charset utf8mb3 not null,
    k2f_qty  int                         not null,
    constraint k2f_pk
        unique (k2f_name)
);

create table log
(
    id        int auto_increment
        primary key,
    username  varchar(55) not null,
    action    varchar(55) not null,
    action_at datetime    not null
);

create table mainjig
(
    mainjig_id   varchar(55) charset utf8mb3 not null
        primary key,
    mainjig_name varchar(55) charset utf8mb3 not null,
    mainjig_qty  int                         not null
);

create table messboat
(
    messboat_id   int                         not null
        primary key,
    messboat_name varchar(55) charset utf8mb3 not null,
    messboat_qty  int                         not null
);

create table tx_k1a
(
    tx_k1a_id                varchar(55) not null
        primary key,
    category_id              varchar(11) not null,
    tx_k1a_type              varchar(10) not null,
    tx_k1a_year              year        null,
    tx_k1a_chf               int         null,
    tx_k1a_speedometer       int         null,
    tx_k1a_body_r            int         null,
    tx_k1a_body_l            int         null,
    tx_k1a_fender            int         null,
    tx_k1a_supply_tanggal    date        null,
    tx_k1a_perbaikan_tanggal date        null,
    tx_k1a_selesai_tanggal   date        null,
    tx_k1a_pic               varchar(55) null,
    tx_k1a_datang_tanggal    date        null,
    tx_k1a_keterangan        varchar(55) null,
    updated_at               timestamp   null,
    constraint tx_k1a_category_null_fk
        foreign key (category_id) references category (category_id)
);

create table tx_k2f
(
    tx_k2f_id                varchar(55) not null
        primary key,
    category_id              varchar(11) not null,
    tx_k2f_type              varchar(10) not null,
    tx_k2f_year              year        null,
    tx_k2f_speedometer_a     int         null,
    tx_k2f_speedometer_b     int         null,
    tx_k2f_ring_speedometer  int         null,
    tx_k2f_front_r           int         null,
    tx_k2f_front_l           int         null,
    tx_k2f_front_top         int         null,
    tx_k2f_fender            int         null,
    tx_k2f_under_rl          int         null,
    tx_k2f_lid_pocket        int         null,
    tx_k2f_body_rl           int         null,
    tx_k2f_center_upper      int         null,
    tx_k2f_rr_center         int         null,
    tx_k2f_center            int         null,
    tx_k2f_inner_upper       int         null,
    tx_k2f_inner             int         null,
    tx_k2f_supply_tanggal    date        null,
    tx_k2f_perbaikan_tanggal date        null,
    tx_k2f_selesai_tanggal   date        null,
    tx_k2f_pic               varchar(55) null,
    tx_k2f_datang_tanggal    date        null,
    tx_k2f_keterangan        varchar(55) null,
    updated_at               timestamp   null,
    constraint tx_k2f_category_null_fk
        foreign key (category_id) references category (category_id)
);

create table tx_mainjig
(
    tx_mainjig_id                int auto_increment
        primary key,
    category_id                  int         not null,
    tx_mainjig_type              varchar(10) not null,
    tx_mainjig_year              date        null,
    tx_mainjig_qty               int         null,
    tx_mainjig_supply_tanggal    date        null,
    tx_mainjig_perbaikan_tanggal date        null,
    tx_mainjig_selesai_tanggal   date        null,
    tx_mainjig_pic               varchar(55) null,
    tx_mainjig_datang_tanggal    date        null,
    tx_mainjig_keterangan        varchar(55) null
);

create table tx_messboat
(
    id                int auto_increment
        primary key,
    category_id       int         not null,
    type              varchar(10) not null,
    year              date        null,
    jumlah            int         null,
    supply_tanggal    date        null,
    perbaikan_tanggal date        null,
    selesai_tanggal   date        null,
    pic               varchar(55) null,
    datang_tanggal    date        null,
    keterangan        varchar(55) null
);

create table tx_surat_jalan
(
    id              int auto_increment
        primary key,
    category_id     int  not null,
    tanggal         date not null,
    k2f             int  null,
    k1a             int  null,
    mainjig_line_a  int  null,
    mainjig_line_b  int  null,
    mainjig_line_c  int  null,
    messboat_line_a int  null,
    messboat_line_b int  null,
    messboat_line_c int  null
);

create table user_roles
(
    user_role_id   int         not null
        primary key,
    user_role_name varchar(55) not null,
    created_at     timestamp   not null,
    updated_at     timestamp   null,
    constraint karyawan_bagians_pk
        unique (user_role_name)
);

create table users
(
    username           varchar(55)  not null
        primary key,
    password           varchar(255) not null,
    created_at         datetime     not null,
    update_password_at datetime     null,
    last_login         timestamp    null
);

create table sessions
(
    session_id varchar(55)  not null
        primary key,
    username   varchar(120) not null,
    constraint fk_sessions_user
        foreign key (username) references users (username)
            on update cascade on delete cascade
);

create table user_details
(
    user_detail_id varchar(55) not null
        primary key,
    username       varchar(55) not null,
    full_name      varchar(55) not null,
    role_id        int         not null,
    updated_at     timestamp   null,
    constraint karyawan_details_pk
        unique (username),
    constraint user_details_user_roles_null_fk
        foreign key (role_id) references user_roles (user_role_id)
            on update cascade,
    constraint user_details_users_null_fk
        foreign key (username) references users (username)
            on update cascade on delete cascade
);


