CREATE SCHEMA subjig_report;
CREATE SCHEMA subjig_report_test;
CREATE SCHEMA kotretan;

CREATE TABLE karyawans
(
    username           VARCHAR(55) PRIMARY KEY,
    password           VARCHAR(255) NOT NULL,
    created_at         DATETIME     NOT NULL,
    update_password_at DATETIME     NOT NULL,
    online_status   BOOLEAN NOT NULL ,
    last_login DATETIME NOT NULL
)ENGINE = InnoDB
 CHARSET = utf8mb4;

CREATE TABLE karyawan_details
(
    username           VARCHAR(55) PRIMARY KEY,
    name           VARCHAR(55) NOT NULL,
    bagian_id INTEGER NOT NULL
)ENGINE = InnoDB
 CHARSET = utf8mb4;

CREATE TABLE karyawan_bagians
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    name           VARCHAR(55) NOT NULL
)ENGINE = InnoDB
 CHARSET = utf8mb4;

CREATE TABLE sessions
(
    username           VARCHAR(55) PRIMARY KEY,
    session_id           VARCHAR(120) NOT NULL
)ENGINE = InnoDB
 CHARSET = utf8mb4;


CREATE TABLE log
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    username           VARCHAR(55) NOT NULL,
    action           VARCHAR(55) NOT NULL,
    action_at         DATETIME     NOT NULL

) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE category
(
    id          INTEGER PRIMARY KEY NOT NULL,
    name      VARCHAR(55)       NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE category_surat_jalan
(
    id          INTEGER PRIMARY KEY NOT NULL,
    name      VARCHAR(55)       NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE k2f
(
    id          INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55) NOT NULL ,
    qty INT NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE k1a
(
    id          INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55) NOT NULL ,
    qty INT NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE mainjig
(
    id          INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55) NOT NULL ,
    qty INT NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE messboat
(
    id          INTEGER PRIMARY KEY NOT NULL,
    name VARCHAR(55) NOT NULL ,
    qty INT NOT NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_k2f
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL ,
    type VARCHAR(10) NOT NULL ,
    year DATE NULL ,
    speedometer_a INT NULL ,
    speedometer_b INT NULL ,
    ring_speedometer INT NULL ,
    front_r INT NULL ,
    front_l INT NULL ,
    front_top INT NULL ,
    fender INT NULL ,
    under_rL INT NULL ,
    lid_pocket INT NULL ,
    body_rl INT NULL ,
    center_upper INT NULL ,
    rr_center INT NULL ,
    center INT NULL ,
    inner_upper INT NULL ,
    cinner INT NULL ,
    supply_tanggal DATE NULL ,
    perbaikan_tanggal DATE NULL ,
    selesai_tanggal  DATE NULL,
        pic VARCHAR(55) NULL,
        datang_tanggal DATE NULL,
        keterangan VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_k1a
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL ,
    type VARCHAR(10) NOT NULL ,
    year DATE NULL ,
    chf  INT NULL ,
        spdmt  INT NULL,
        body_r INT NULL,
        body_l  INT NULL ,
        fender INT NULL,
    supply_tanggal DATE NULL ,
    perbaikan_tanggal DATE NULL ,
    selesai_tanggal  DATE NULL,
    pic VARCHAR(55) NULL,
    datang_tanggal DATE NULL,
    keterangan VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_mainjig
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL ,
    type VARCHAR(10) NOT NULL ,
    year DATE NULL ,
    jumlah INT NULL ,
    supply_tanggal DATE NULL ,
    perbaikan_tanggal DATE NULL ,
    selesai_tanggal  DATE NULL,
    pic VARCHAR(55) NULL,
    datang_tanggal DATE NULL,
    keterangan VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_messboat
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL ,
    type VARCHAR(10) NOT NULL ,
    year DATE NULL ,
    jumlah INT NULL ,
    supply_tanggal DATE NULL ,
    perbaikan_tanggal DATE NULL ,
    selesai_tanggal  DATE NULL,
    pic VARCHAR(55) NULL,
    datang_tanggal DATE NULL,
    keterangan VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8mb4;

CREATE TABLE tx_surat_jalan
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL ,
    tanggal DATE NOT NULL ,
    k2f INT,
    k1a INT ,
    mainjig_line_a INT,
    mainjig_line_b INT,
    mainjig_line_c INT ,
    messboat_line_a INT ,
    messboat_line_b INT ,
    messboat_line_c INT
) ENGINE = InnoDB
  CHARSET = utf8mb4;