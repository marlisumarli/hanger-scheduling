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

alter table k2fs
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


CREATE TABLE `ref_k2f`
(
    `ref_k2f_id`               varchar(55) NOT NULL,
    `ref_name`                 varchar(11) NOT NULL,
    `ref_k2f_speedometer_a`    int              DEFAULT NULL,
    `ref_k2f_speedometer_b`    int              DEFAULT NULL,
    `ref_k2f_ring_speedometer` int              DEFAULT NULL,
    `ref_k2f_front_r`          int              DEFAULT NULL,
    `ref_k2f_front_l`          int              DEFAULT NULL,
    `ref_k2f_front_top`        int              DEFAULT NULL,
    `ref_k2f_fender`           int              DEFAULT NULL,
    `ref_k2f_under_rl`         int              DEFAULT NULL,
    `ref_k2f_lid_pocket`       int              DEFAULT NULL,
    `ref_k2f_body_rl`          int              DEFAULT NULL,
    `ref_k2f_center_upper`     int              DEFAULT NULL,
    `ref_k2f_rr_center`        int              DEFAULT NULL,
    `ref_k2f_center`           int              DEFAULT NULL,
    `ref_k2f_inner_upper`      int              DEFAULT NULL,
    `ref_k2f_inner`            int              DEFAULT NULL,
    `date_come`                date             DEFAULT NULL,
    `updated_at`               timestamp   NULL DEFAULT NULL,
    PRIMARY KEY (`ref_k2f_id`),
    KEY `ref_k2f_txK2f_null_fk` (`ref_k2f_id`),
    CONSTRAINT `ref_k2f_category_null_fk` FOREIGN KEY (`ref_k2f_id`) REFERENCES `tx_k2f` (`tx_k2f_id`) ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

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


CREATE TABLE supply
(
    supply_id   varchar(11) NOT NULL,
    supply_date date        NOT NULL,
    PRIMARY KEY (supply_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE line
(
    id            INT PRIMARY KEY AUTO_INCREMENT,
    supply_id     varchar(11) NOT NULL,
    subjig_id     varchar(11) NULL,
    jumlah_line_a integer     NULL,
    jumlah_line_b integer     NULL,
    jumlah_line_c integer     NULL,
    total         integer     NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

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

SELECT supply.supply_date,
       k2f.k2f_id,
       k2f.k2f_name,
       line.line_a,
       line.line_b,
       line.line_c,
       line.total
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.id
         INNER JOIN k2fs k2f on line.hanger_id = k2f.k2f_id
WHERE supply.id = '20221115K2F';

CREATE TABLE periode
(
    supply_id   varchar(11) NOT NULL,
    supply_date date        NOT NULL,
    PRIMARY KEY (supply_id)
) ENGINE = InnoDB;

CREATE TABLE types
(
    type_id    varchar(11) PRIMARY KEY NOT NULL,
    type_qty   INT                     NOT NULL,
    created_at TIMESTAMP               NOT NULL,
    updated_at TIMESTAMP               NOT NULL

) ENGINE = InnoDB;

CREATE TABLE subjigs
(
    subjig_id    VARCHAR(11) PRIMARY KEY NOT NULL,
    type_id      VARCHAR(11)             NOT NULL,
    order_number INT                     NOT NULL,
    subjig_name  VARCHAR(55)             NOT NULL,
    subjig_qty   INT                     NOT NULL,
    label        VARCHAR(55)             NULL,
    created_at   TIMESTAMP               NOT NULL,
    updated_at   TIMESTAMP               NULL

) ENGINE = InnoDB;

alter table hangers
    add constraint subjigs_types_null_fk
        foreign key (hanger_type_id) references hanger_types (id)
            on update cascade;


SELECT subjig.order_number,
       subjig.id,
       subjig.hanger_name,
       type.id,
       subjig.hanger_type_id,
       subjig.hanger_qty,
       subjig.created_at,
       subjig.updated_at
FROM hangers subjig
         INNER JOIN hanger_types type ON type.id = subjig.hanger_type_id

CREATE TABLE get_years
(
    year_id VARCHAR(11) PRIMARY KEY NOT NULL

) ENGINE = InnoDB;


SELECT *
FROM supplies supply
         INNER JOIN hanger_types type ON type.id = supply.hanger_type_id
where supply.hanger_type_id = ?;

SELECT supply.id,
       supply.supply_date,
       supply.target_set,
       order_number,
       hanger_name,
       hanger_qty,
       line.target_set,
       line_a,
       line_b,
       line_c,
       total
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.id
         INNER JOIN hangers subjig on line.hanger_id = subjig.id
         INNER JOIN hanger_types type on supply.hanger_type_id = type.id
WHERE type.id = 'WAWA';


CREATE TABLE schedules_subjig
(
    id         VARCHAR(55) PRIMARY KEY NOT NULL,
    month      DATE                    NOT NULL,
    type_id    VARCHAR(11)             NOT NULL,
    created_at TIMESTAMP               NOT NULL
) ENGINE = InnoDB;

CREATE TABLE schedules
(
    id                 INT PRIMARY KEY AUTO_INCREMENT,
    schedule_subjig_id VARCHAR(55) NOT NULL,
    tanggal            DATE        NOT NULL,
    created_at         TIMESTAMP   NOT NULL
) ENGINE = InnoDB;

SELECT subjig.id,
       subjig.order_number,
       subjig.hanger_name,
       subjig.hanger_qty,
       subjig.hanger_type_id,
       schedule_subjig.id,
       schedule_subjig.hanger_type_id,
       schedule_week.id,
       schedule_week.tanggal,
       schedule_week.is_done,
       schedule_week.supply_schedules_id,
       supply.id,
       supply.target_set,
       line.id,
       line.line_a,
       line.line_b,
       line.line_c,
       line.total,
       line.target_set,
       line.supply_id,
       line.hanger_id
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.id
         INNER JOIN hangers subjig ON subjig.id = line.hanger_id
         INNER JOIN hanger_types type ON type.id = supply.hanger_type_id
         INNER JOIN supply_schedules schedule_subjig ON schedule_subjig.hanger_type_id = type.id
         INNER JOIN schedule_weeks schedule_week ON schedule_week.supply_schedules_id = schedule_subjig.id
         INNER JOIN schedule_weeks schedule_week_supply ON schedule_week_supply.id = supply.schedule_week_id;

SELECT
    type.id AS type,
    type.qty,
    subjig.id,
    subjig.order_number,
    subjig.hanger_name,
    subjig.hanger_qty
FROM hangers subjig
         INNER JOIN hanger_types type ON type.id = subjig.hanger_type_id
WHERE type.id = ? ORDER BY order_number;

SELECT
    schedule_supply.created_at,
    type.id AS type_id,
    schedule_w.id AS schedule_week_id,
    schedule_w.tanggal,
    schedule_w.is_done
FROM schedule_weeks schedule_w
         INNER JOIN supply_schedules AS schedule_supply ON schedule_supply.id = schedule_w.supply_schedules_id
         INNER JOIN hanger_types type ON type.id = schedule_supply.hanger_type_id
WHERE type.id = ?;


SELECT schedule.id AS schedule_id,
    supply.id AS supply_id,
    schedule.tanggal,
    schedule.is_done
FROM supplies supply
         INNER JOIN schedule_weeks AS schedule ON schedule.id = supply.schedule_week_id
WHERE supply.hanger_type_id = ?;

SELECT
    supply.id AS supply_id,
    supply.target_set,
    order_number,
    hanger_name,
    hanger_qty,
    line.id AS line_id,
    line_a,
    line_b,
    line_c,
    total
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.id
         INNER JOIN hangers hanger ON hanger.id = line.hanger_id
         INNER JOIN hanger_types type ON type.id = supply.hanger_type_id
WHERE hanger.id = ?;

CREATE TABLE schedule_m_categories
(
    id                 VARCHAR(3) PRIMARY KEY
) ENGINE = InnoDB;

CREATE TABLE periods(
    id VARCHAR(11) PRIMARY KEY ,
    created_at TIMESTAMP NOT NULL
) ENGINE = InnoDB;

SELECT
    schedule_supply.id,
    schedule_supply.month,
    schedule_supply.period_id
FROM supply_schedules schedule_supply
         INNER JOIN hanger_types AS type ON type.id = schedule_supply.hanger_type_id;

SELECT
    schedule_supply.month,
    type.id AS type_id,
    schedule_w.id AS schedule_week_id,
    schedule_w.date,
    schedule_w.m_id,
    schedule_w.is_done,
    supply.id AS supply_id
FROM schedule_weeks schedule_w
         INNER JOIN supply_schedules schedule_supply ON schedule_supply.id = schedule_w.supply_schedules_id
         INNER JOIN hanger_types type ON type.id = schedule_supply.hanger_type_id
         INNER JOIN supplies supply ON supply.schedule_week_id = schedule_w.id;

SELECT
    schedule_supply.id,
    schedule_supply.month
FROM supply_schedules schedule_supply
         INNER JOIN hanger_types AS type ON type.id = schedule_supply.hanger_type_id
         INNER JOIN periods AS period ON period.id = schedule_supply.period_id
WHERE type.id = ? AND period.id = 0;

SELECT * FROM schedule_weeks WHERE m_id = ?;



SELECT
    supply.id AS supply_id,
    supply.target_set,
    hanger.order_number,
    name AS hanger_name,
    hanger.qty AS hanger_qty,
    line.id AS line_id,
    line.line_a,
    line.line_b,
    line.line_c,
    line.total
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.id
         INNER JOIN hangers hanger ON hanger.id = line.hanger_id
         INNER JOIN hanger_types type ON type.id = supply.hanger_type_id;

SELECT
    sl.hanger_id AS hanger_id,
    supply.id AS supply_id,
    sl.line_a,
    sl.line_b,
    sl.line_c,
    sl.total
FROM supply_lines AS sl
INNER JOIN supplies AS supply ON supply.id = sl.supply_id
INNER JOIN hangers AS hanger ON hanger.id = sl.hanger_id;
