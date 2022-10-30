CREATE SCHEMA subjig_report;
CREATE SCHEMA subjig_report_test;
CREATE SCHEMA kotretan;

# CREATE TABLE karyawans(
#   username VARCHAR(55) PRIMARY KEY,
#   password VARCHAR(255) NOT NULL ,
#   created_at DATE NOT NULL ,
#
# );

CREATE TABLE subjig_k2f_supply
(
    id                  VARCHAR(55) PRIMARY KEY,
    supply_tanggal      DATE       NOT NULL,
    line_a_spdmt_a      INTEGER(3) NULL,
    line_a_spdmt_b      INTEGER(3) NULL,
    line_a_front_r      INTEGER(3) NULL,
    line_a_front_l      INTEGER(3) NULL,
    line_a_front_top    INTEGER(3) NULL,
    line_a_fender       INTEGER(3) NULL,
    line_a_under_rl     INTEGER(3) NULL,
    line_a_body_rl      INTEGER(3) NULL,
    line_a_center_upper INTEGER(3) NULL,
    line_a_inner_upper  INTEGER(3) NULL,
    line_a_inner        INTEGER(3) NULL,
    line_b_spdmt_a      INTEGER(3) NULL,
    line_b_spdmt_b      INTEGER(3) NULL,
    line_b_front_r      INTEGER(3) NULL,
    line_b_front_l      INTEGER(3) NULL,
    line_b_front_top    INTEGER(3) NULL,
    line_b_fender       INTEGER(3) NULL,
    line_b_under_rl     INTEGER(3) NULL,
    line_b_body_rl      INTEGER(3) NULL,
    line_b_center_upper INTEGER(3) NULL,
    line_b_inner_upper  INTEGER(3) NULL,
    line_b_inner        INTEGER(3) NULL,
    line_c_spdmt_a      INTEGER(3) NULL,
    line_c_spdmt_b      INTEGER(3) NULL,
    line_c_front_r      INTEGER(3) NULL,
    line_c_front_l      INTEGER(3) NULL,
    line_c_front_top    INTEGER(3) NULL,
    line_c_fender       INTEGER(3) NULL,
    line_c_under_rl     INTEGER(3) NULL,
    line_c_body_rl      INTEGER(3) NULL,
    line_c_center_upper INTEGER(3) NULL,
    line_c_inner_upper  INTEGER(3) NULL,
    line_c_inner        INTEGER(3) NULL
) ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE subjig_k2vg_supply
(
    id               VARCHAR(55) PRIMARY KEY,
    supply_tanggal   DATE       NOT NULL,
    line_a_cht       INTEGER(3) NULL,
    line_a_chf       INTEGER(3) NULL,
    line_a_front_r   INTEGER(3) NULL,
    line_a_front_l   INTEGER(3) NULL,
    line_a_front_top INTEGER(3) NULL,
    line_a_rack      INTEGER(3) NULL,
    line_a_body_r    INTEGER(3) NULL,
    line_a_body_l    INTEGER(3) NULL,
    line_b_cht       INTEGER(3) NULL,
    line_b_chf       INTEGER(3) NULL,
    line_b_front_r   INTEGER(3) NULL,
    line_b_front_l   INTEGER(3) NULL,
    line_b_front_top INTEGER(3) NULL,
    line_b_rack      INTEGER(3) NULL,
    line_b_body_r    INTEGER(3) NULL,
    line_b_body_l    INTEGER(3) NULL,
    line_c_cht       INTEGER(3) NULL,
    line_c_chf       INTEGER(3) NULL,
    line_c_front_r   INTEGER(3) NULL,
    line_c_front_l   INTEGER(3) NULL,
    line_c_front_top INTEGER(3) NULL,
    line_c_rack      INTEGER(3) NULL,
    line_c_body_r    INTEGER(3) NULL,
    line_c_body_l    INTEGER(3) NULL
) ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE subjig_k2f_perbaikan
(
    id              VARCHAR(55) PRIMARY KEY,
    tanggal_op      DATE        NOT NULL,
    op_spdmt_a      INTEGER(3)  NULL,
    op_spdmt_b      INTEGER(3)  NULL,
    op_front_r      INTEGER(3)  NULL,
    op_front_l      INTEGER(3)  NULL,
    op_front_top    INTEGER(3)  NULL,
    op_fender       INTEGER(3)  NULL,
    op_under_rl     INTEGER(3)  NULL,
    op_body_rl      INTEGER(3)  NULL,
    op_center_upper INTEGER(3)  NULL,
    op_inner_upper  INTEGER(3)  NULL,
    op_inner        INTEGER(3)  NULL,
    tanggal_cl      DATE        NULL,
    cl_spdmt_a      INTEGER(3)  NULL,
    cl_spdmt_b      INTEGER(3)  NULL,
    cl_front_r      INTEGER(3)  NULL,
    cl_front_l      INTEGER(3)  NULL,
    cl_front_top    INTEGER(3)  NULL,
    cl_fender       INTEGER(3)  NULL,
    cl_under_rl     INTEGER(3)  NULL,
    cl_body_rl      INTEGER(3)  NULL,
    cl_center_upper INTEGER(3)  NULL,
    cl_inner_upper  INTEGER(3)  NULL,
    cl_inner        INTEGER(3)  NULL,
    pic             VARCHAR(55) NULL,
    keterangan      VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE subjig_k2vg_perbaikan
(
    id           VARCHAR(55) PRIMARY KEY,
    tanggal_op   DATE        NOT NULL,
    op_cht       INTEGER(3)  NULL,
    op_chf       INTEGER(3)  NULL,
    op_front_r   INTEGER(3)  NULL,
    op_front_l   INTEGER(3)  NULL,
    op_front_top INTEGER(3)  NULL,
    op_rack      INTEGER(3)  NULL,
    op_body_r    INTEGER(3)  NULL,
    op_body_l    INTEGER(3)  NULL,
    tanggal_cl   DATE        NULL,
    cl_cht       INTEGER(3)  NULL,
    cl_chf       INTEGER(3)  NULL,
    cl_front_r   INTEGER(3)  NULL,
    cl_front_l   INTEGER(3)  NULL,
    cl_front_top INTEGER(3)  NULL,
    cl_rack      INTEGER(3)  NULL,
    cl_body_r    INTEGER(3)  NULL,
    cl_body_l    INTEGER(3)  NULL,
    pic          VARCHAR(55) NULL,
    keterangan   VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE subjig_k2f_cuci
(
    id              VARCHAR(55) PRIMARY KEY,
    tanggal_op      DATE        NOT NULL,
    op_spdmt_a      INTEGER(3)  NULL,
    op_spdmt_b      INTEGER(3)  NULL,
    op_front_r      INTEGER(3)  NULL,
    op_front_l      INTEGER(3)  NULL,
    op_front_top    INTEGER(3)  NULL,
    op_fender       INTEGER(3)  NULL,
    op_under_rl     INTEGER(3)  NULL,
    op_body_rl      INTEGER(3)  NULL,
    op_center_upper INTEGER(3)  NULL,
    op_inner_upper  INTEGER(3)  NULL,
    op_inner        INTEGER(3)  NULL,
    tanggal_cl      DATE        NULL,
    cl_spdmt_a      INTEGER(3)  NULL,
    cl_spdmt_b      INTEGER(3)  NULL,
    cl_front_r      INTEGER(3)  NULL,
    cl_front_l      INTEGER(3)  NULL,
    cl_front_top    INTEGER(3)  NULL,
    cl_fender       INTEGER(3)  NULL,
    cl_under_rl     INTEGER(3)  NULL,
    cl_body_rl      INTEGER(3)  NULL,
    cl_center_upper INTEGER(3)  NULL,
    cl_inner_upper  INTEGER(3)  NULL,
    cl_inner        INTEGER(3)  NULL,
    keterangan      VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE subjig_k2vg_cuci
(
    id           VARCHAR(55) PRIMARY KEY,
    tanggal_op   DATE        NOT NULL,
    op_cht       INTEGER(3)  NULL,
    op_chf       INTEGER(3)  NULL,
    op_front_r   INTEGER(3)  NULL,
    op_front_l   INTEGER(3)  NULL,
    op_front_top INTEGER(3)  NULL,
    op_rack      INTEGER(3)  NULL,
    op_body_r    INTEGER(3)  NULL,
    op_body_l    INTEGER(3)  NULL,
    tanggal_cl   DATE        NULL,
    cl_cht       INTEGER(3)  NULL,
    cl_chf       INTEGER(3)  NULL,
    cl_front_r   INTEGER(3)  NULL,
    cl_front_l   INTEGER(3)  NULL,
    cl_front_top INTEGER(3)  NULL,
    cl_rack      INTEGER(3)  NULL,
    cl_body_r    INTEGER(3)  NULL,
    cl_body_l    INTEGER(3)  NULL,
    keterangan   VARCHAR(55) NULL
) ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE subjig_k2f
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    subjig_nama VARCHAR(55)            NOT NULL,
    qty         INTEGER(2)             NOT NULL,
    stok_gudang INTEGER(4)             NOT NULL,
    stok_line   INTEGER(4)             NOT NULL,
    jumlah_cuci INTEGER(4)             NOT NULL,
    perbaikan   INTEGER(3)             NOT NULL

) ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE subjig_k2vg
(
    id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    subjig_nama VARCHAR(55)            NOT NULL,
    qty         INTEGER(2)             NOT NULL,
    stok_gudang INTEGER(4)             NOT NULL,
    stok_line   INTEGER(4)             NOT NULL,
    jumlah_cuci INTEGER(4)             NOT NULL,
    perbaikan   INTEGER(3)             NOT NULL

) ENGINE = InnoDB
  CHARSET = utf8;

ALTER TABLE subjig_k2f_supply
    ADD COLUMN supply_target_line_c INTEGER(3) AFTER supply_tanggal,
    ADD COLUMN supply_target_line_b INTEGER(3) AFTER supply_tanggal,
    ADD COLUMN supply_target_line_a INTEGER(3) AFTER supply_tanggal;
ALTER TABLE subjig_k2vg_supply
    ADD COLUMN supply_target_line_c INTEGER(3) AFTER supply_tanggal,
    ADD COLUMN supply_target_line_b INTEGER(3) AFTER supply_tanggal,
    ADD COLUMN supply_target_line_a INTEGER(3) AFTER supply_tanggal;

DROP TABLE subjig_k2vg;
DROP TABLE subjig_k2f;