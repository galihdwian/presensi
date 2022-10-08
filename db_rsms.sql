/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL_RSMS
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : db_rsms

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 28/10/2021 13:53:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for abiyasaprofil_tb
-- ----------------------------
DROP TABLE IF EXISTS `abiyasaprofil_tb`;
CREATE TABLE `abiyasaprofil_tb`  (
  `id_profilabiyasa` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profil` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_profilabiyasa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for abiyasaslide_tb
-- ----------------------------
DROP TABLE IF EXISTS `abiyasaslide_tb`;
CREATE TABLE `abiyasaslide_tb`  (
  `id_slider` int NOT NULL AUTO_INCREMENT,
  `nama_slider` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gambar_slider` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aktivasi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_slider`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for album_tb
-- ----------------------------
DROP TABLE IF EXISTS `album_tb`;
CREATE TABLE `album_tb`  (
  `id_album` int NOT NULL AUTO_INCREMENT,
  `judul_album` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tema_album` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_album`) USING BTREE,
  INDEX `fk_tema`(`tema_album`) USING BTREE,
  CONSTRAINT `album_tb_ibfk_1` FOREIGN KEY (`tema_album`) REFERENCES `albumtema_tb` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for albumcontent_tb
-- ----------------------------
DROP TABLE IF EXISTS `albumcontent_tb`;
CREATE TABLE `albumcontent_tb`  (
  `id_albumcontent` int NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_album` int NULL DEFAULT NULL,
  `cover` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_albumcontent`) USING BTREE,
  INDEX `fk_idalbum`(`id_album`) USING BTREE,
  CONSTRAINT `albumcontent_tb_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album_tb` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 293 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for albumtema_tb
-- ----------------------------
DROP TABLE IF EXISTS `albumtema_tb`;
CREATE TABLE `albumtema_tb`  (
  `id_tema` int NOT NULL AUTO_INCREMENT,
  `nama_tema` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aktivasi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_create` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_tema`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for berita_tb
-- ----------------------------
DROP TABLE IF EXISTS `berita_tb`;
CREATE TABLE `berita_tb`  (
  `id_berita` int NOT NULL AUTO_INCREMENT,
  `judul_berita` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `isi_berita` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tanggal_berita` datetime NULL DEFAULT NULL,
  `author_berita` int NULL DEFAULT NULL,
  `img_berita` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe_berita` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `img_width` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_download` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_download_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `viewer` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_berita`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 259 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for beritafiles_tb
-- ----------------------------
DROP TABLE IF EXISTS `beritafiles_tb`;
CREATE TABLE `beritafiles_tb`  (
  `id_beritafile` int NOT NULL AUTO_INCREMENT,
  `id_berita` int NOT NULL,
  `nama_file` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_beritafile`) USING BTREE,
  INDEX `fk_idberitafilesberita`(`id_berita`) USING BTREE,
  CONSTRAINT `fk_idberitafilesberita` FOREIGN KEY (`id_berita`) REFERENCES `berita_tb` (`id_berita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 495 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for captcha
-- ----------------------------
DROP TABLE IF EXISTS `captcha`;
CREATE TABLE `captcha`  (
  `captcha_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `captcha_time` int UNSIGNED NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`captcha_id`) USING BTREE,
  INDEX `word`(`word`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1205139 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chat
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat`  (
  `idchat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `chat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `waktuchat` datetime NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `replychat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `replyto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `wakturead` datetime NULL DEFAULT NULL,
  `readbybot` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `chatid` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `message_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `chatcode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usertele` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idchat`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chat_adminsts
-- ----------------------------
DROP TABLE IF EXISTS `chat_adminsts`;
CREATE TABLE `chat_adminsts`  (
  `statusadmin` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chat_user
-- ----------------------------
DROP TABLE IF EXISTS `chat_user`;
CREATE TABLE `chat_user`  (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for content_tb
-- ----------------------------
DROP TABLE IF EXISTS `content_tb`;
CREATE TABLE `content_tb`  (
  `id_content` int NOT NULL AUTO_INCREMENT,
  `nama_content` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul_content` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_content`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contentsub_tb
-- ----------------------------
DROP TABLE IF EXISTS `contentsub_tb`;
CREATE TABLE `contentsub_tb`  (
  `id_contentsub` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_content` int NOT NULL,
  `judul_subcontent` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `profil_subcontent` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isi_subcontent` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_subcontent` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_subcontent` datetime NOT NULL,
  `id_user` int NOT NULL,
  `validasi_subcontent` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_contentsub`) USING BTREE,
  INDEX `fk_subcontent_content`(`id_content`) USING BTREE,
  CONSTRAINT `fk_subcontent_content` FOREIGN KEY (`id_content`) REFERENCES `content_tb` (`id_content`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contentsubfiles_tb
-- ----------------------------
DROP TABLE IF EXISTS `contentsubfiles_tb`;
CREATE TABLE `contentsubfiles_tb`  (
  `id_subfiles` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_subcontent` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `author` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_subfiles`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for counterhit_tb
-- ----------------------------
DROP TABLE IF EXISTS `counterhit_tb`;
CREATE TABLE `counterhit_tb`  (
  `id` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date` datetime NULL DEFAULT NULL,
  `browser` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `expired` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for dokter_tb
-- ----------------------------
DROP TABLE IF EXISTS `dokter_tb`;
CREATE TABLE `dokter_tb`  (
  `id_dokter` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_dokter` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `author` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokter`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for donasi
-- ----------------------------
DROP TABLE IF EXISTS `donasi`;
CREATE TABLE `donasi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal_donasi` date NULL DEFAULT NULL,
  `nama_item` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qty` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pengirim_donasi` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_donasi_mst_satuan` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 368 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for donasi_mst_satuan
-- ----------------------------
DROP TABLE IF EXISTS `donasi_mst_satuan`;
CREATE TABLE `donasi_mst_satuan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for download_tb
-- ----------------------------
DROP TABLE IF EXISTS `download_tb`;
CREATE TABLE `download_tb`  (
  `id_download` int NOT NULL AUTO_INCREMENT,
  `nama_download` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_file` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_upload` datetime NULL DEFAULT NULL,
  `jumlah_download` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_download`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for gkm_foto
-- ----------------------------
DROP TABLE IF EXISTS `gkm_foto`;
CREATE TABLE `gkm_foto`  (
  `id_gkm_foto` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_gkm` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `urut` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_gkm_foto`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for gkm_list
-- ----------------------------
DROP TABLE IF EXISTS `gkm_list`;
CREATE TABLE `gkm_list`  (
  `id_gkm` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_gkm` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `unit_kerja` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tema` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `risalah` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `th_gkm` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_upload` datetime NULL DEFAULT NULL,
  `user_upload` int NULL DEFAULT NULL,
  `slug` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_gkm`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_adminmenu
-- ----------------------------
DROP TABLE IF EXISTS `hww_adminmenu`;
CREATE TABLE `hww_adminmenu`  (
  `idmenu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namamenu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menuurl` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menuicon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idmenuparent` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  PRIMARY KEY (`idmenu`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_adminmenu_access
-- ----------------------------
DROP TABLE IF EXISTS `hww_adminmenu_access`;
CREATE TABLE `hww_adminmenu_access`  (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idmenu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `stsactive` bit(1) NULL DEFAULT b'1',
  PRIMARY KEY (`username`, `idmenu`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_agenda_kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `hww_agenda_kegiatan`;
CREATE TABLE `hww_agenda_kegiatan`  (
  `idagenda` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggalagenda` date NULL DEFAULT NULL,
  `agendakegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `materi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idprofil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idagenda`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_files_media_kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `hww_files_media_kegiatan`;
CREATE TABLE `hww_files_media_kegiatan`  (
  `idfiles` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idgrupmedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isfotocover` bit(1) NULL DEFAULT NULL,
  `fotofile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupload` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateentryfoto` datetime NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `urlvideo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `typemedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupdate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateupdate` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idfiles`, `idgrupmedia`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_grup_media_kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `hww_grup_media_kegiatan`;
CREATE TABLE `hww_grup_media_kegiatan`  (
  `idgrupmedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namagrupmedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isigrupmedia` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `userupload` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateentry` datetime NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  PRIMARY KEY (`idgrupmedia`, `idkegiatan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_kategori
-- ----------------------------
DROP TABLE IF EXISTS `hww_kategori`;
CREATE TABLE `hww_kategori`  (
  `idkategorikegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namakategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `iconkategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `dateentrykategori` datetime NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idprofil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idkategorikegiatan`, `idprofil`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_kategorikegiatan
-- ----------------------------
DROP TABLE IF EXISTS `hww_kategorikegiatan`;
CREATE TABLE `hww_kategorikegiatan`  (
  `idkategorikegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateentry` datetime NULL DEFAULT NULL,
  `userset` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idkategorikegiatan`, `idkegiatan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `hww_kegiatan`;
CREATE TABLE `hww_kegiatan`  (
  `idkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judulkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggalkegiatan` date NULL DEFAULT NULL,
  `isikegiatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `userupload` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `dateentrykegiatan` datetime NULL DEFAULT NULL,
  `fotocover` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsvalid` bit(1) NULL DEFAULT NULL,
  `uservalid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `datevalid` datetime NULL DEFAULT NULL,
  `ringkasankegiatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `slugkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupdate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateupdate` datetime NULL DEFAULT NULL,
  `jmlview` int NULL DEFAULT NULL,
  `lastview` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idkegiatan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_kegiatan_logrevisi
-- ----------------------------
DROP TABLE IF EXISTS `hww_kegiatan_logrevisi`;
CREATE TABLE `hww_kegiatan_logrevisi`  (
  `idkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judulkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggalkegiatan` date NULL DEFAULT NULL,
  `isikegiatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `userupload` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `dateentrykegiatan` datetime NULL DEFAULT NULL,
  `fotocover` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsvalid` bit(1) NULL DEFAULT NULL,
  `uservalid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `datevalid` datetime NULL DEFAULT NULL,
  `userrevisi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `daterevisi` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idkegiatan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_profil
-- ----------------------------
DROP TABLE IF EXISTS `hww_profil`;
CREATE TABLE `hww_profil`  (
  `idprofil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namaprofil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `lastupdateprofil` datetime NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `banerbackgroundimage` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `banercssimagebackground` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profilsectiontitle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profiltitle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profilcuplikan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `profilimage` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imglogo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profilisi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `cuplikankegiatantipemedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cuplikankegiatanmedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cuplikankegiatanisi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`idprofil`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_profilkegiatan
-- ----------------------------
DROP TABLE IF EXISTS `hww_profilkegiatan`;
CREATE TABLE `hww_profilkegiatan`  (
  `idkegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idprofil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idkegiatan`, `idprofil`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_testimoni
-- ----------------------------
DROP TABLE IF EXISTS `hww_testimoni`;
CREATE TABLE `hww_testimoni`  (
  `idtestimoni` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idprofil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `waktutestimoni` datetime NULL DEFAULT NULL,
  `responden` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isitestimoni` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `stsactive` bit(1) NULL DEFAULT b'0',
  `stsvalid` bit(1) NULL DEFAULT b'0',
  `datevalid` datetime NULL DEFAULT NULL,
  `uservalid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imageresponden` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idtestimoni`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_upload_files
-- ----------------------------
DROP TABLE IF EXISTS `hww_upload_files`;
CREATE TABLE `hww_upload_files`  (
  `iduploadfile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `juduluploadfile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `namafile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `dateentry` datetime NULL DEFAULT NULL,
  `dateupdate` datetime NULL DEFAULT NULL,
  `userentry` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupdate` datetime NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `viewer` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`iduploadfile`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_upload_files_kategori
-- ----------------------------
DROP TABLE IF EXISTS `hww_upload_files_kategori`;
CREATE TABLE `hww_upload_files_kategori`  (
  `iduploadkategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `iduploadfile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`iduploadkategori`, `iduploadfile`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_upload_kategori
-- ----------------------------
DROP TABLE IF EXISTS `hww_upload_kategori`;
CREATE TABLE `hww_upload_kategori`  (
  `iduploadkategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namauploadkategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateentry` datetime NULL DEFAULT NULL,
  `dateupdate` datetime NULL DEFAULT NULL,
  `userentry` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupdate` varchar(0) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`iduploadkategori`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_user_access
-- ----------------------------
DROP TABLE IF EXISTS `hww_user_access`;
CREATE TABLE `hww_user_access`  (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `stsactive` bit(1) NULL DEFAULT NULL,
  `usergrantedaccess` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateentry` datetime NULL DEFAULT NULL,
  `idprofil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`username`, `idprofil`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hww_user_validasi_kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `hww_user_validasi_kegiatan`;
CREATE TABLE `hww_user_validasi_kegiatan`  (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idprofile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`username`, `idprofile`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for igd_tb
-- ----------------------------
DROP TABLE IF EXISTS `igd_tb`;
CREATE TABLE `igd_tb`  (
  `id_igd` int NOT NULL AUTO_INCREMENT,
  `ruang` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kelas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kapasitas` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_igd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for informasi_tb
-- ----------------------------
DROP TABLE IF EXISTS `informasi_tb`;
CREATE TABLE `informasi_tb`  (
  `id_informasi` int NOT NULL AUTO_INCREMENT,
  `judul_informasi` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isi_informasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tgl_expired` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bln_expired` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `th_expired` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_informasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_dip
-- ----------------------------
DROP TABLE IF EXISTS `ip_dip`;
CREATE TABLE `ip_dip`  (
  `id_dip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun_dip` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_sub` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_parent` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aktif_dip` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_dip`) USING BTREE,
  INDEX `fk_subdip`(`id_sub`) USING BTREE,
  CONSTRAINT `fk_subdip` FOREIGN KEY (`id_sub`) REFERENCES `ip_sub` (`id_sub`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_dip_copy1
-- ----------------------------
DROP TABLE IF EXISTS `ip_dip_copy1`;
CREATE TABLE `ip_dip_copy1`  (
  `id_dip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun_dip` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_sub` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_parent` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aktif_dip` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_dip`) USING BTREE,
  INDEX `fk_subdip`(`id_sub`) USING BTREE,
  CONSTRAINT `ip_dip_copy1_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `ip_sub` (`id_sub`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_dipstatus
-- ----------------------------
DROP TABLE IF EXISTS `ip_dipstatus`;
CREATE TABLE `ip_dipstatus`  (
  `tahun_dip` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_dip` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`tahun_dip`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_galeri
-- ----------------------------
DROP TABLE IF EXISTS `ip_galeri`;
CREATE TABLE `ip_galeri`  (
  `id_image` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption_heading` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption_content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `sorting_data` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_image`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_klasifikasi
-- ----------------------------
DROP TABLE IF EXISTS `ip_klasifikasi`;
CREATE TABLE `ip_klasifikasi`  (
  `id_ppid` int NOT NULL AUTO_INCREMENT,
  `nama_ppid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  `judul_dip` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sorting` int NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `url_alias` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penjelasan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `show_dip` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_ppid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_master_lokasi
-- ----------------------------
DROP TABLE IF EXISTS `ip_master_lokasi`;
CREATE TABLE `ip_master_lokasi`  (
  `lokasi_ID` int NOT NULL AUTO_INCREMENT,
  `lokasi_kode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `lokasi_nama` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `lokasi_propinsi` int NOT NULL,
  `lokasi_kabupatenkota` int(2) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `lokasi_kecamatan` int(2) UNSIGNED ZEROFILL NOT NULL,
  `lokasi_kelurahan` int(4) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`lokasi_ID`) USING BTREE,
  INDEX `lokasi_kode`(`lokasi_kode`) USING BTREE,
  INDEX `lokasi_propinsi`(`lokasi_propinsi`) USING BTREE,
  INDEX `lokasi_kabupatenkota`(`lokasi_kabupatenkota`) USING BTREE,
  INDEX `lokasi_kecamatan`(`lokasi_kecamatan`) USING BTREE,
  INDEX `lokasi_kelurahan`(`lokasi_kelurahan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 68427 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_pemohon
-- ----------------------------
DROP TABLE IF EXISTS `ip_pemohon`;
CREATE TABLE `ip_pemohon`  (
  `id_pemohon` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanda_pengenal` char(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_identitas` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jk` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tempat_lahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `telp` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pekerjaan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_pos` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `provinsi` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kabupaten_kota` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pwd` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_register` datetime NULL DEFAULT NULL,
  `lampiran` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `active` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_active` datetime NULL DEFAULT NULL,
  `foto` char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `provinsi_plain` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kabupaten_plain` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kecamatan_plain` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desa_plain` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe_pemohon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemohon`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_pengaduan_epotter
-- ----------------------------
DROP TABLE IF EXISTS `ip_pengaduan_epotter`;
CREATE TABLE `ip_pengaduan_epotter`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pojok_pengaduan_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_akses` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_bentuk_informasi
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_bentuk_informasi`;
CREATE TABLE `ip_permohonan_bentuk_informasi`  (
  `bentuk_inf` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_bentuk_informasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`bentuk_inf`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_intern
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_intern`;
CREATE TABLE `ip_permohonan_intern`  (
  `id_permohonan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_permohonan` datetime NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `telp` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `informasi_diminta` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tujuan_permintaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bentuk_informasi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keputusan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alasan_penolakan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `melihat` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `salinan` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pemebritahuan` datetime NULL DEFAULT NULL,
  `pemberian_inf` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_permohonan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_keberatan
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_keberatan`;
CREATE TABLE `ip_permohonan_keberatan`  (
  `id_keberatan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `id_permohonan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ditolak` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tdk_disediakan` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tdk_ditanggapi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tdk_sesuaipermintaan` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tdk_dipenuhi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tdk_wajar` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `overtime` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kasus` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kuasa_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_telp` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` datetime NULL DEFAULT NULL,
  `verifikasi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_tanggapan` datetime NULL DEFAULT NULL,
  `kuasa_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_provinsi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_kabupaten` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_kecamatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_desa` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_kodepos` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kuasa_nomor_identitas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_register` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_akses` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_keberatan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_keberatan_tanggapan
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_keberatan_tanggapan`;
CREATE TABLE `ip_permohonan_keberatan_tanggapan`  (
  `id_verifikasi` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_keberatan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_keberatan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_tanggapan` datetime NOT NULL,
  `isi_tanggapan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `send_email` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_verifikasi`, `id_keberatan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_online
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_online`;
CREATE TABLE `ip_permohonan_online`  (
  `id_permohonan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_user` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `informasi_diminta` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kandungan_isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tujuan_permohoan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `bentuk_inf` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_permohonan` datetime NULL DEFAULT NULL,
  `tgl_dikonfirmasi` datetime NULL DEFAULT NULL,
  `user_konfirm` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keputusan_permohonan` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alasan_penolakan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tgl_keputusan` datetime NULL DEFAULT NULL,
  `user_keputusan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_register` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_akses` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cara_mendapkan_salinan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_permohonan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_online_keputusan
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_online_keputusan`;
CREATE TABLE `ip_permohonan_online_keputusan`  (
  `id_keputusan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_permohonan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_keputusan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_keputusan` datetime NOT NULL,
  `pesan_keputusan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_keputusan` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alasan_penolakan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `send_mail` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_keputusan`, `id_permohonan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_online_konfirmasi
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_online_konfirmasi`;
CREATE TABLE `ip_permohonan_online_konfirmasi`  (
  `id_konfirmasi` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_permohonan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_konfirmasi` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_konfirmasi` datetime NOT NULL,
  `pesan_konfirmasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `send_mail` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_konfirmasi`, `id_permohonan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_permohonan_sosmed
-- ----------------------------
DROP TABLE IF EXISTS `ip_permohonan_sosmed`;
CREATE TABLE `ip_permohonan_sosmed`  (
  `id_permohononan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_permohonan` datetime NULL DEFAULT NULL,
  `nama_pemohon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dijawab` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_permohononan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_rekapitulasi_permohonan_informasi
-- ----------------------------
DROP TABLE IF EXISTS `ip_rekapitulasi_permohonan_informasi`;
CREATE TABLE `ip_rekapitulasi_permohonan_informasi`  (
  `id_rekapitulasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tahun` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bulan` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `permohonan_medsos_diterima` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `permohonan_medsos_disetujui` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `permohonan_langsung_diterima` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `permohonan_langsung_disetujui` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_update` datetime NULL DEFAULT NULL,
  `user_update` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_rekapitulasi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_ruangpublik
-- ----------------------------
DROP TABLE IF EXISTS `ip_ruangpublik`;
CREATE TABLE `ip_ruangpublik`  (
  `id_topik` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `topik` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_topik` datetime NULL DEFAULT NULL,
  `user_topi` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_topik`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_ruangpublik_respon
-- ----------------------------
DROP TABLE IF EXISTS `ip_ruangpublik_respon`;
CREATE TABLE `ip_ruangpublik_respon`  (
  `id_respontopik` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `id_topik` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `respon` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `waktu_respon` datetime NULL DEFAULT NULL,
  `tampil` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_respontopik`) USING BTREE,
  INDEX `fk_irp_respon`(`id_topik`) USING BTREE,
  CONSTRAINT `fk_irp_respon` FOREIGN KEY (`id_topik`) REFERENCES `ip_ruangpublik` (`id_topik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_slide
-- ----------------------------
DROP TABLE IF EXISTS `ip_slide`;
CREATE TABLE `ip_slide`  (
  `slide_id` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `heading` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sort_slide` int NULL DEFAULT NULL,
  `background` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`slide_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_sub
-- ----------------------------
DROP TABLE IF EXISTS `ip_sub`;
CREATE TABLE `ip_sub`  (
  `id_sub` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_klasifikasi` int NULL DEFAULT NULL,
  `sorting_informasi` int NULL DEFAULT NULL,
  `heading_dip` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul_informasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `isi_informasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `penanggung_jawab` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `waktu_pembuatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bentuk_informasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `jangka_waktu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `media` varchar(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_upoad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe_view` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url_page` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tag_categori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_upload` datetime NULL DEFAULT NULL,
  `file_download` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url_spesific` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dasar_hukum` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `akibat_dibuka` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `akibat_ditutup` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `batas_waktu` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `klasifikasi_heading` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `slug` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `stsdisplay` bit(1) NULL DEFAULT b'1',
  `display_detail` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_update` datetime NULL DEFAULT NULL,
  `user_update` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_sub`) USING BTREE,
  INDEX `fk_klasifikasisub`(`id_klasifikasi`) USING BTREE,
  INDEX `fk_tipeview`(`tipe_view`) USING BTREE,
  CONSTRAINT `fk_klasifikasisub` FOREIGN KEY (`id_klasifikasi`) REFERENCES `ip_klasifikasi` (`id_ppid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tipeview` FOREIGN KEY (`tipe_view`) REFERENCES `ip_view` (`id_view`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_sub_copy1
-- ----------------------------
DROP TABLE IF EXISTS `ip_sub_copy1`;
CREATE TABLE `ip_sub_copy1`  (
  `id_sub` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_klasifikasi` int NULL DEFAULT NULL,
  `sorting_informasi` int NULL DEFAULT NULL,
  `heading_dip` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul_informasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `isi_informasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `penanggung_jawab` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `waktu_pembuatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bentuk_informasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `jangka_waktu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `media` varchar(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_upoad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe_view` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url_page` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tag_categori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_upload` datetime NULL DEFAULT NULL,
  `file_download` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url_spesific` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dasar_hukum` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `akibat_dibuka` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `akibat_ditutup` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `batas_waktu` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `klasifikasi_heading` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `slug` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `stsdisplay` bit(1) NULL DEFAULT b'1',
  `display_detail` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_sub`) USING BTREE,
  INDEX `fk_klasifikasisub`(`id_klasifikasi`) USING BTREE,
  INDEX `fk_tipeview`(`tipe_view`) USING BTREE,
  CONSTRAINT `ip_sub_copy1_ibfk_1` FOREIGN KEY (`id_klasifikasi`) REFERENCES `ip_klasifikasi` (`id_ppid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ip_sub_copy1_ibfk_2` FOREIGN KEY (`tipe_view`) REFERENCES `ip_view` (`id_view`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_sub_file
-- ----------------------------
DROP TABLE IF EXISTS `ip_sub_file`;
CREATE TABLE `ip_sub_file`  (
  `id_file` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `display_name` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun_file` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sorting_data` int NULL DEFAULT NULL,
  `alias_group` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_sub` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `page` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `fileindex` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `userupload` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateupload` datetime NULL DEFAULT NULL,
  `userupdate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateupdate` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_file`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_sub_file_trans
-- ----------------------------
DROP TABLE IF EXISTS `ip_sub_file_trans`;
CREATE TABLE `ip_sub_file_trans`  (
  `id_sub` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_file` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sort_display` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_sub`, `id_file`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_tag
-- ----------------------------
DROP TABLE IF EXISTS `ip_tag`;
CREATE TABLE `ip_tag`  (
  `id_tag` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name_tag` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ordertag` int NULL DEFAULT NULL,
  `displaytag` bit(1) NULL DEFAULT b'1',
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_tag`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_tag_content
-- ----------------------------
DROP TABLE IF EXISTS `ip_tag_content`;
CREATE TABLE `ip_tag_content`  (
  `id_tagcontent` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_tag` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `location` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `display_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `page` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slug` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `sorting_data` int NULL DEFAULT NULL,
  `userupdate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateupdate` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_tagcontent`) USING BTREE,
  INDEX `fk_tag_tagcontent`(`id_tag`) USING BTREE,
  CONSTRAINT `fk_tag_tagcontent` FOREIGN KEY (`id_tag`) REFERENCES `ip_tag` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ip_view
-- ----------------------------
DROP TABLE IF EXISTS `ip_view`;
CREATE TABLE `ip_view`  (
  `id_view` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_view` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_view`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for irna_tb
-- ----------------------------
DROP TABLE IF EXISTS `irna_tb`;
CREATE TABLE `irna_tb`  (
  `id_irna` int NOT NULL AUTO_INCREMENT,
  `ruang` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kelas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kapasitas` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `orderdata` int NULL DEFAULT NULL,
  `show_data` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_irna`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jumlahkamar_tb
-- ----------------------------
DROP TABLE IF EXISTS `jumlahkamar_tb`;
CREATE TABLE `jumlahkamar_tb`  (
  `id_ruang` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_ruang` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kelas` char(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah_tersedia` int NULL DEFAULT NULL,
  `date_update` datetime NULL DEFAULT NULL,
  `sorting_data` int NULL DEFAULT NULL,
  `jumlahkamar` int NULL DEFAULT NULL,
  `jumlahterisi` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_ruang`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jumlahpasien_tb
-- ----------------------------
DROP TABLE IF EXISTS `jumlahpasien_tb`;
CREATE TABLE `jumlahpasien_tb`  (
  `id` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_update` datetime NULL DEFAULT NULL,
  `irna` int NULL DEFAULT NULL,
  `irja` int NULL DEFAULT NULL,
  `igd` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kematangan_org_akses_user
-- ----------------------------
DROP TABLE IF EXISTS `kematangan_org_akses_user`;
CREATE TABLE `kematangan_org_akses_user`  (
  `idpokja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idpokja`, `username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kematangan_org_files
-- ----------------------------
DROP TABLE IF EXISTS `kematangan_org_files`;
CREATE TABLE `kematangan_org_files`  (
  `idfile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idpokja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namafile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `datecreate` datetime NULL DEFAULT NULL,
  `lastdateupdate` datetime NULL DEFAULT NULL,
  `usercreate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupdate` datetime NULL DEFAULT NULL,
  `stsactive` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nourut` int NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idindikator` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `filetype` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idfile`, `idpokja`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kematangan_org_indikator
-- ----------------------------
DROP TABLE IF EXISTS `kematangan_org_indikator`;
CREATE TABLE `kematangan_org_indikator`  (
  `idindikator` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namaindikator` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `idpokja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penjelasan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`idindikator`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kematangan_org_mpokja
-- ----------------------------
DROP TABLE IF EXISTS `kematangan_org_mpokja`;
CREATE TABLE `kematangan_org_mpokja`  (
  `idpokja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namapokja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penjelasan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`idpokja`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for kematangan_org_muser
-- ----------------------------
DROP TABLE IF EXISTS `kematangan_org_muser`;
CREATE TABLE `kematangan_org_muser`  (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `namauser` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for komentar_tb
-- ----------------------------
DROP TABLE IF EXISTS `komentar_tb`;
CREATE TABLE `komentar_tb`  (
  `id_komen` bigint NOT NULL AUTO_INCREMENT,
  `email_komentator` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_komentator` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isi_komen` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_komen` datetime NULL DEFAULT NULL,
  `id_berita` int NULL DEFAULT NULL,
  `approve_komen` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_view` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pict` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_komen`) USING BTREE,
  INDEX `fk_berita`(`id_berita`) USING BTREE,
  CONSTRAINT `komentar_tb_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita_tb` (`id_berita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4039 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for komentreply_tb
-- ----------------------------
DROP TABLE IF EXISTS `komentreply_tb`;
CREATE TABLE `komentreply_tb`  (
  `id_reply` varchar(17) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_komen` bigint NOT NULL,
  `date` datetime NOT NULL,
  `author` int NOT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_reply`) USING BTREE,
  INDEX `fkidkoment`(`id_komen`) USING BTREE,
  INDEX `fkiduserkoment`(`author`) USING BTREE,
  CONSTRAINT `fkidkoment` FOREIGN KEY (`id_komen`) REFERENCES `komentar_tb` (`id_komen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkiduserkoment` FOREIGN KEY (`author`) REFERENCES `user_tb` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for level_tb
-- ----------------------------
DROP TABLE IF EXISTS `level_tb`;
CREATE TABLE `level_tb`  (
  `id_level` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_level` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for link_tb
-- ----------------------------
DROP TABLE IF EXISTS `link_tb`;
CREATE TABLE `link_tb`  (
  `id_link` int NOT NULL AUTO_INCREMENT,
  `nama_link` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_link`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for manajamenfiles_tb
-- ----------------------------
DROP TABLE IF EXISTS `manajamenfiles_tb`;
CREATE TABLE `manajamenfiles_tb`  (
  `id_filemanajemen` int NOT NULL AUTO_INCREMENT,
  `files` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  `id_manajamen` int NOT NULL,
  PRIMARY KEY (`id_filemanajemen`) USING BTREE,
  INDEX `fk_manajemenfile`(`id_manajamen`) USING BTREE,
  CONSTRAINT `fk_manajemenfile` FOREIGN KEY (`id_manajamen`) REFERENCES `manajemen_tb` (`id_manajamen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = cp850 COLLATE = cp850_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for manajemen_tb
-- ----------------------------
DROP TABLE IF EXISTS `manajemen_tb`;
CREATE TABLE `manajemen_tb`  (
  `id_manajamen` int NOT NULL AUTO_INCREMENT,
  `nama_manajemen` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gambar` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profil` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_manajamen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for manajemensub_tb
-- ----------------------------
DROP TABLE IF EXISTS `manajemensub_tb`;
CREATE TABLE `manajemensub_tb`  (
  `id_submanajemen` int NOT NULL AUTO_INCREMENT,
  `nama_submanajemen` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profil` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sub_isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  `id_manajamen` int NOT NULL,
  PRIMARY KEY (`id_submanajemen`) USING BTREE,
  INDEX `fk_manajemen`(`id_manajamen`) USING BTREE,
  CONSTRAINT `fk_manajemen` FOREIGN KEY (`id_manajamen`) REFERENCES `manajemen_tb` (`id_manajamen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for manajemensubfiles_tb
-- ----------------------------
DROP TABLE IF EXISTS `manajemensubfiles_tb`;
CREATE TABLE `manajemensubfiles_tb`  (
  `id_filesubmanajemen` int NOT NULL AUTO_INCREMENT,
  `files` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  `id_submanajemen` int NOT NULL,
  PRIMARY KEY (`id_filesubmanajemen`) USING BTREE,
  INDEX `fk_submanajemenfile`(`id_submanajemen`) USING BTREE,
  CONSTRAINT `fk_submanajemenfile` FOREIGN KEY (`id_submanajemen`) REFERENCES `manajemensub_tb` (`id_submanajemen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menu_tb
-- ----------------------------
DROP TABLE IF EXISTS `menu_tb`;
CREATE TABLE `menu_tb`  (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `induk` tinyint NOT NULL,
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktivasi` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tress` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for modal_video
-- ----------------------------
DROP TABLE IF EXISTS `modal_video`;
CREATE TABLE `modal_video`  (
  `id_video` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `urlvideo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `durasi` int NULL DEFAULT NULL,
  `waktumulai` date NULL DEFAULT NULL,
  `tipe_modal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prioritas_tayang` bit(1) NULL DEFAULT b'0',
  `waktu_mulai_prioritas` datetime NULL DEFAULT NULL,
  `waktu_akhir_prioritas` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_video`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pengadaan_dokumen_paket
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan_dokumen_paket`;
CREATE TABLE `pengadaan_dokumen_paket`  (
  `id_paket` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `iddokumen` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idlistdokumen` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_file` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_set_dokumen` datetime NULL DEFAULT NULL,
  `user_set_dokumen` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link_lpse` bit(1) NULL DEFAULT b'0',
  `deleted` bit(1) NULL DEFAULT b'0',
  `direct_link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_paket`, `iddokumen`, `idlistdokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pengadaan_dokumen_rs
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan_dokumen_rs`;
CREATE TABLE `pengadaan_dokumen_rs`  (
  `tahunpengadaan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_file` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted` bit(1) NULL DEFAULT b'0',
  `datecreate` datetime NULL DEFAULT NULL,
  `usercreate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `iddokumen` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`tahunpengadaan`, `iddokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pengadaan_master_dokumen
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan_master_dokumen`;
CREATE TABLE `pengadaan_master_dokumen`  (
  `iddokumen` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namadokumen` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `lpsesufix` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpseprefix` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipedokumen` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '01:dokumen lelang, 02: dokumen pengadaan tahunan',
  PRIMARY KEY (`iddokumen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pengadaan_tb
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan_tb`;
CREATE TABLE `pengadaan_tb`  (
  `id_paket` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_paket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jadwal` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hps` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` int NOT NULL,
  `verivikasi` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_upload` datetime NULL DEFAULT NULL,
  `downloaded` int NULL DEFAULT NULL,
  `deleted` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `expired` date NULL DEFAULT NULL,
  `tahunpengadaan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pengumumanlpse` bit(1) NULL DEFAULT NULL,
  `idtender` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sumber_anggaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pagu_anggaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai_kontrak` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_pengadaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penyedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_kontrak` date NULL DEFAULT NULL,
  `nomor_kontrak` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_paket`) USING BTREE,
  INDEX `fk_iduploader`(`id_user`) USING BTREE,
  CONSTRAINT `pengadaan_tb_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_tb` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pengadaan_tb_old
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan_tb_old`;
CREATE TABLE `pengadaan_tb_old`  (
  `id_paket` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_paket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jadwal` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hps` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_user` int NOT NULL,
  `verivikasi` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_upload` datetime NULL DEFAULT NULL,
  `downloaded` int NULL DEFAULT NULL,
  `deleted` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `expired` date NULL DEFAULT NULL,
  `tahunpengadaan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pengumumanlpse` bit(1) NULL DEFAULT NULL,
  `idtender` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sumber_anggaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pagu_anggaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai_kontrak` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_pengadaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penyedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_kontrak` date NULL DEFAULT NULL,
  `nomor_kontrak` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_paket`) USING BTREE,
  INDEX `fk_iduploader`(`id_user`) USING BTREE,
  CONSTRAINT `fk_iduploader` FOREIGN KEY (`id_user`) REFERENCES `user_tb` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for poli_tb
-- ----------------------------
DROP TABLE IF EXISTS `poli_tb`;
CREATE TABLE `poli_tb`  (
  `id_poli` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_poli` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_poli`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for polidokter_tb
-- ----------------------------
DROP TABLE IF EXISTS `polidokter_tb`;
CREATE TABLE `polidokter_tb`  (
  `id_poldok` int NOT NULL AUTO_INCREMENT,
  `id_poli` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_dokter` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_poldok`) USING BTREE,
  INDEX `fk_dokter`(`id_dokter`) USING BTREE,
  INDEX `fk_polidokter`(`id_poli`) USING BTREE,
  CONSTRAINT `polidokter_tb_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter_tb` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `polidokter_tb_ibfk_2` FOREIGN KEY (`id_poli`) REFERENCES `poli_tb` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 90 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for poligambarprofil_tb
-- ----------------------------
DROP TABLE IF EXISTS `poligambarprofil_tb`;
CREATE TABLE `poligambarprofil_tb`  (
  `id_gambarprofil` int NOT NULL AUTO_INCREMENT,
  `id_poli` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_files` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `caption` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_gambarprofil`) USING BTREE,
  INDEX `fk_idpoligambarpoli`(`id_poli`) USING BTREE,
  CONSTRAINT `fk_idpoligambarpoli` FOREIGN KEY (`id_poli`) REFERENCES `poli_tb` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for polijadwal_tb
-- ----------------------------
DROP TABLE IF EXISTS `polijadwal_tb`;
CREATE TABLE `polijadwal_tb`  (
  `id_polijadwal` int NOT NULL AUTO_INCREMENT,
  `id_poli` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `senin` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `selasa` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rabu` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kamis` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumat` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sabtu` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `minggu` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_polijadwal`) USING BTREE,
  INDEX `fk_poli_polijadwal`(`id_poli`) USING BTREE,
  CONSTRAINT `polijadwal_tb_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli_tb` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for poliprofil_tb
-- ----------------------------
DROP TABLE IF EXISTS `poliprofil_tb`;
CREATE TABLE `poliprofil_tb`  (
  `id_poliprofil` int NOT NULL AUTO_INCREMENT,
  `id_poli` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `profil` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_poliprofil`, `id_poli`) USING BTREE,
  INDEX `fk_poli`(`id_poli`) USING BTREE,
  CONSTRAINT `poliprofil_tb_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli_tb` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ppid_tb
-- ----------------------------
DROP TABLE IF EXISTS `ppid_tb`;
CREATE TABLE `ppid_tb`  (
  `id_ppid` int NOT NULL AUTO_INCREMENT,
  `nama_ppid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_ppid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ppidfiles_tb
-- ----------------------------
DROP TABLE IF EXISTS `ppidfiles_tb`;
CREATE TABLE `ppidfiles_tb`  (
  `id_fileppid` int NOT NULL AUTO_INCREMENT,
  `id_ppid` int NULL DEFAULT NULL,
  `judul_file` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  `files` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `gambar` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_fileppid`) USING BTREE,
  INDEX `fk_ppid`(`id_ppid`) USING BTREE,
  CONSTRAINT `ppidfiles_tb_ibfk_1` FOREIGN KEY (`id_ppid`) REFERENCES `ppid_tb` (`id_ppid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 148 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ppidnew
-- ----------------------------
DROP TABLE IF EXISTS `ppidnew`;
CREATE TABLE `ppidnew`  (
  `id_ppid` int NOT NULL AUTO_INCREMENT,
  `nama_ppid` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fileppid` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateppid` datetime NOT NULL,
  `perkip` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `subpermenpan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aktivasi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_ppid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 66 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ppidnewlampiran
-- ----------------------------
DROP TABLE IF EXISTS `ppidnewlampiran`;
CREATE TABLE `ppidnewlampiran`  (
  `id_files` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_ppid` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_files` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_files`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ppidpermenpan
-- ----------------------------
DROP TABLE IF EXISTS `ppidpermenpan`;
CREATE TABLE `ppidpermenpan`  (
  `id_permenpan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_permenpan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_permenpan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ppidsubpermenpan
-- ----------------------------
DROP TABLE IF EXISTS `ppidsubpermenpan`;
CREATE TABLE `ppidsubpermenpan`  (
  `idsubpermenpan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_permenpan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_subpermenpan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idsubpermenpan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for prestasi_tb
-- ----------------------------
DROP TABLE IF EXISTS `prestasi_tb`;
CREATE TABLE `prestasi_tb`  (
  `id_prestasi` int NOT NULL AUTO_INCREMENT,
  `tahun_prestasi` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_prestasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_prestasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sdm_medis
-- ----------------------------
DROP TABLE IF EXISTS `sdm_medis`;
CREATE TABLE `sdm_medis`  (
  `id_medis` int NOT NULL AUTO_INCREMENT,
  `nama_medis` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_medis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sdm_nonmedis
-- ----------------------------
DROP TABLE IF EXISTS `sdm_nonmedis`;
CREATE TABLE `sdm_nonmedis`  (
  `id_nonmedis` int NOT NULL AUTO_INCREMENT,
  `nama_nonmedis` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_nonmedis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sdm_spesialis
-- ----------------------------
DROP TABLE IF EXISTS `sdm_spesialis`;
CREATE TABLE `sdm_spesialis`  (
  `id_spesialis` int NOT NULL AUTO_INCREMENT,
  `nama_spesialis` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_spesialis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sdm_subspesialis
-- ----------------------------
DROP TABLE IF EXISTS `sdm_subspesialis`;
CREATE TABLE `sdm_subspesialis`  (
  `id_subspesialis` int NOT NULL AUTO_INCREMENT,
  `nama_subspesialis` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_subspesialis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for simrsproduct_tb
-- ----------------------------
DROP TABLE IF EXISTS `simrsproduct_tb`;
CREATE TABLE `simrsproduct_tb`  (
  `id_simrs` int NOT NULL AUTO_INCREMENT,
  `nama_product` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profil_product` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `profil_img` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `detail_product` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_simrs`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for simrsproductfiles_tb
-- ----------------------------
DROP TABLE IF EXISTS `simrsproductfiles_tb`;
CREATE TABLE `simrsproductfiles_tb`  (
  `id_simrsfiles` int NOT NULL AUTO_INCREMENT,
  `nama_files` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_simrs` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_simrsfiles`) USING BTREE,
  INDEX `fk_idsimprodfile`(`id_simrs`) USING BTREE,
  CONSTRAINT `simrsproductfiles_tb_ibfk_1` FOREIGN KEY (`id_simrs`) REFERENCES `simrsproduct_tb` (`id_simrs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for status_tb
-- ----------------------------
DROP TABLE IF EXISTS `status_tb`;
CREATE TABLE `status_tb`  (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_jenispendidikan
-- ----------------------------
DROP TABLE IF EXISTS `str_jenispendidikan`;
CREATE TABLE `str_jenispendidikan`  (
  `id_jenispendidikan` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pendidikan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sort` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenispendidikan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_master
-- ----------------------------
DROP TABLE IF EXISTS `str_master`;
CREATE TABLE `str_master`  (
  `id_str` int NOT NULL,
  `str_alias` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_struktur` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pegawai` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_parent` int NULL DEFAULT NULL,
  `eselon` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sortjabatan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_str`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_master_old
-- ----------------------------
DROP TABLE IF EXISTS `str_master_old`;
CREATE TABLE `str_master_old`  (
  `id_str` int NOT NULL,
  `str_alias` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_struktur` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pegawai` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_parent` int NULL DEFAULT NULL,
  `eselon` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tipe` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sortjabatan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_str`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `str_pegawai`;
CREATE TABLE `str_pegawai`  (
  `id_pegawai` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pegawai` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tempat_lhr` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tg_lhr` date NULL DEFAULT NULL,
  `jk` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `agama` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pangkat_gol` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tmt_gol` date NULL DEFAULT NULL,
  `tmt_jabatan` date NULL DEFAULT NULL,
  `eselon` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `masa_kerja` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `npwp` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto_profil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `str_display` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_pelatihan
-- ----------------------------
DROP TABLE IF EXISTS `str_pelatihan`;
CREATE TABLE `str_pelatihan`  (
  `id_pelatihan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `id_pegawai` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_pelatihan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `th_pelatihan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelatihan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_penghargaan
-- ----------------------------
DROP TABLE IF EXISTS `str_penghargaan`;
CREATE TABLE `str_penghargaan`  (
  `id_penghargaan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pegawai` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penghargaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tgl_penghargaan` date NULL DEFAULT NULL,
  `no_sk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `asal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `th_penghargaan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urut` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_penghargaan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_riwayatpekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `str_riwayatpekerjaan`;
CREATE TABLE `str_riwayatpekerjaan`  (
  `id_riwayatpekerjaan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pegawai` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_jabatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `eselon` char(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sk_jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tmt_sk` date NULL DEFAULT NULL,
  `tmt_jabatan` date NULL DEFAULT NULL,
  `sorting_data` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_riwayatpekerjaan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for str_riwayatpendidikan
-- ----------------------------
DROP TABLE IF EXISTS `str_riwayatpendidikan`;
CREATE TABLE `str_riwayatpendidikan`  (
  `id_pendidikan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pegawai` varchar(21) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenispendidikan` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_sekolah` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jurusan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_sekolah` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kepala_sekolah` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_sttb` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_sttb` date NULL DEFAULT NULL,
  `th_lulus` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pendidikan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tarif
-- ----------------------------
DROP TABLE IF EXISTS `tarif`;
CREATE TABLE `tarif`  (
  `id_tarif` int NOT NULL AUTO_INCREMENT,
  `kat_layanan` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `js_sarana` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `js_pelayanan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kode_kls` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tarif`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_covid
-- ----------------------------
DROP TABLE IF EXISTS `tb_covid`;
CREATE TABLE `tb_covid`  (
  `idbulan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namaperiode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lastupdate` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idbulan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_covid_konfirmasi
-- ----------------------------
DROP TABLE IF EXISTS `tb_covid_konfirmasi`;
CREATE TABLE `tb_covid_konfirmasi`  (
  `idbulan_konfirmasi` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `totalkasus_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lakilaki_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `perempuan_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_satu_sepuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '1-10th',
  `usia_sebelas_duapuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_duasatu_tigapuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_tigasatu_empatpuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_empatsatu_limapuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_limasatu_enampuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_enamsatu_tujuhpuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_tujuhsatu_delapapuluh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_delapansatu_seratus_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_dirawat_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dirawat_laki_laki_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dirawat_perempuan_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_sembuh_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sembuh_laki_laki_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sembuh_perempuan_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_meninggal_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `meninggal_laki_laki_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `meninggal_perempuan_konfirmasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idbulan_konfirmasi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_covid_skrining_grup_pertanyaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_covid_skrining_grup_pertanyaan`;
CREATE TABLE `tb_covid_skrining_grup_pertanyaan`  (
  `id_grup` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_grup` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_grup`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_covid_skrining_identitas
-- ----------------------------
DROP TABLE IF EXISTS `tb_covid_skrining_identitas`;
CREATE TABLE `tb_covid_skrining_identitas`  (
  `id_skrining` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir` date NULL DEFAULT NULL,
  `nohp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hasilakhir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_skrining`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_covid_skrining_pertanyaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_covid_skrining_pertanyaan`;
CREATE TABLE `tb_covid_skrining_pertanyaan`  (
  `id_pertanyaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pertanyaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai_ya` int NULL DEFAULT NULL,
  `nilai_tidak` int NULL DEFAULT NULL,
  `id_grup` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `jawaban_ya` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jawaban_tidak` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pertanyaan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_covid_skrining_record
-- ----------------------------
DROP TABLE IF EXISTS `tb_covid_skrining_record`;
CREATE TABLE `tb_covid_skrining_record`  (
  `id_skrining` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pertanyaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jawaban` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_skrining`, `id_pertanyaan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_covid_suspect
-- ----------------------------
DROP TABLE IF EXISTS `tb_covid_suspect`;
CREATE TABLE `tb_covid_suspect`  (
  `idbulan_suspect` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `totalkasus_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lakilaki_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `perempuan_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_satu_sepuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '1-10th',
  `usia_sebelas_duapuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_duasatu_tigapuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_tigasatu_empatpuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_empatsatu_limapuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_limasatu_enampuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_enamsatu_tujuhpuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_tujuhsatu_delapapuluh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usia_delapansatu_seratus_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_dirawat_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dirawat_laki_laki_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dirawat_perempuan_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_sembuh_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sembuh_laki_laki_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sembuh_perempuan_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_meninggal_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `meninggal_laki_laki_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `meninggal_perempuan_suspect` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idbulan_suspect`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_xlmdua
-- ----------------------------
DROP TABLE IF EXISTS `tb_xlmdua`;
CREATE TABLE `tb_xlmdua`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_rs` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_penyakit` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah` int NULL DEFAULT NULL,
  `minggu` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `periode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rawat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_xmllogin
-- ----------------------------
DROP TABLE IF EXISTS `tb_xmllogin`;
CREATE TABLE `tb_xmllogin`  (
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_xmlsatu
-- ----------------------------
DROP TABLE IF EXISTS `tb_xmlsatu`;
CREATE TABLE `tb_xmlsatu`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_rs` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `penjamin` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `minggu` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `periode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for teleapik_klinik
-- ----------------------------
DROP TABLE IF EXISTS `teleapik_klinik`;
CREATE TABLE `teleapik_klinik`  (
  `KODEBAGIAN` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PERIODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABAGIAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `MAXANTRI` int NULL DEFAULT NULL,
  `JMLPX` int NULL DEFAULT NULL,
  `JMLRJUTTD` int NULL DEFAULT NULL,
  `DATEUPDATE` datetime NULL DEFAULT NULL,
  `JMLBYLISTPX` int NULL DEFAULT NULL,
  `DTUPDTJMLBYLISTPX` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`KODEBAGIAN`, `PERIODE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for teleapik_pendaftaran
-- ----------------------------
DROP TABLE IF EXISTS `teleapik_pendaftaran`;
CREATE TABLE `teleapik_pendaftaran`  (
  `PERIODEANTRIAN` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NONPBI` int NULL DEFAULT NULL,
  `PBI` int NULL DEFAULT NULL,
  `UMUM` int NULL DEFAULT NULL,
  `JAMKESDA` int NULL DEFAULT NULL,
  `A_NONPBI` int NULL DEFAULT NULL,
  `A_PBI` int NULL DEFAULT NULL,
  `A_UMUM` int NULL DEFAULT NULL,
  `A_JAMKESDA` int NULL DEFAULT NULL,
  `DATEUPDATE` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`PERIODEANTRIAN`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for thread_content
-- ----------------------------
DROP TABLE IF EXISTS `thread_content`;
CREATE TABLE `thread_content`  (
  `idtopik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idcontent` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `headingcontent` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isicontent` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `idmedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `meditype` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mediaposition` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `contentlinkdisplay` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `directlink` bit(1) NULL DEFAULT b'0',
  `urldirectlink` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `statusaktif` bit(1) NULL DEFAULT b'1',
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idtopik`, `idcontent`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for thread_main
-- ----------------------------
DROP TABLE IF EXISTS `thread_main`;
CREATE TABLE `thread_main`  (
  `idtopik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judultopik` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idparent` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `statuspublish` bit(1) NULL DEFAULT b'0',
  `datecreate` datetime NULL DEFAULT NULL,
  `datepublish` datetime NULL DEFAULT NULL,
  `usercreate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userpublish` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lastmodified` datetime NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jmlview` int NULL DEFAULT 0,
  PRIMARY KEY (`idtopik`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for thread_media
-- ----------------------------
DROP TABLE IF EXISTS `thread_media`;
CREATE TABLE `thread_media`  (
  `idmedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namafile` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `typefile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `datecreate` datetime NULL DEFAULT NULL,
  `urutan` int NULL DEFAULT NULL,
  `idfile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_sub_file` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupload` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_tagcontent` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judulmedia` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judulnarasi` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `narasi` varchar(6000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userupdate` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dateupdate` datetime NULL DEFAULT NULL,
  `statusaktif` bit(1) NULL DEFAULT b'1',
  PRIMARY KEY (`idmedia`, `idfile`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for today_tb
-- ----------------------------
DROP TABLE IF EXISTS `today_tb`;
CREATE TABLE `today_tb`  (
  `id_today` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` datetime NULL DEFAULT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `author` int NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_today`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for todaycoment_tb
-- ----------------------------
DROP TABLE IF EXISTS `todaycoment_tb`;
CREATE TABLE `todaycoment_tb`  (
  `id_todaycoment` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_today` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date` datetime NULL DEFAULT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_todaycoment`) USING BTREE,
  INDEX `fk_today`(`id_today`) USING BTREE,
  CONSTRAINT `fk_today` FOREIGN KEY (`id_today`) REFERENCES `today_tb` (`id_today`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_tb
-- ----------------------------
DROP TABLE IF EXISTS `user_tb`;
CREATE TABLE `user_tb`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level_user` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_user` int NULL DEFAULT NULL,
  `last_login` datetime NULL DEFAULT NULL,
  `aktivasi` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_klinik` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `fk_statususer`(`status_user`) USING BTREE,
  INDEX `fk_level`(`level_user`) USING BTREE,
  CONSTRAINT `fk_level` FOREIGN KEY (`level_user`) REFERENCES `level_tb` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_statususer` FOREIGN KEY (`status_user`) REFERENCES `status_tb` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for video_tb
-- ----------------------------
DROP TABLE IF EXISTS `video_tb`;
CREATE TABLE `video_tb`  (
  `id_video` int NOT NULL AUTO_INCREMENT,
  `url_video` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_create` datetime NULL DEFAULT NULL,
  `nama_video` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_video`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_contentfull
-- ----------------------------
DROP TABLE IF EXISTS `w_contentfull`;
CREATE TABLE `w_contentfull`  (
  `id_fullpage` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `urlalias` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `group_page` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_content` int NULL DEFAULT NULL,
  `sub_data` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `img_width` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_fullpage`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_contentfullimg
-- ----------------------------
DROP TABLE IF EXISTS `w_contentfullimg`;
CREATE TABLE `w_contentfullimg`  (
  `id_imgfullpage` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `id_fullpage` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_imgfullpage`) USING BTREE,
  INDEX `fk_img_contentfull`(`id_fullpage`) USING BTREE,
  CONSTRAINT `fk_img_contentfull` FOREIGN KEY (`id_fullpage`) REFERENCES `w_contentfull` (`id_fullpage`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_dokter_list
-- ----------------------------
DROP TABLE IF EXISTS `w_dokter_list`;
CREATE TABLE `w_dokter_list`  (
  `id_dokter` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `nama_dokter` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pns` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `blud` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `unsoed` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mitra` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_smf` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokter`) USING BTREE,
  INDEX `fk_wds_wdl`(`id_smf`) USING BTREE,
  CONSTRAINT `fk_wds_wdl` FOREIGN KEY (`id_smf`) REFERENCES `w_dokter_smf` (`id_smf`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_dokter_smf
-- ----------------------------
DROP TABLE IF EXISTS `w_dokter_smf`;
CREATE TABLE `w_dokter_smf`  (
  `id_smf` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `nama_smf` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sorting_smf` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_smf`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_flashinfo
-- ----------------------------
DROP TABLE IF EXISTS `w_flashinfo`;
CREATE TABLE `w_flashinfo`  (
  `id_flashinfo` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_flashinfo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` datetime NULL DEFAULT NULL,
  `sorting_flash` int NULL DEFAULT NULL,
  `active_flash` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `caption` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_flashinfo`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_sdm_jenistenaga
-- ----------------------------
DROP TABLE IF EXISTS `w_sdm_jenistenaga`;
CREATE TABLE `w_sdm_jenistenaga`  (
  `id_sdm` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `jenis_tenaga` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pns` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `blud` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_klasifikasisdm` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_sdm`) USING BTREE,
  INDEX `fk_wjt_wk`(`id_klasifikasisdm`) USING BTREE,
  CONSTRAINT `fk_wjt_wk` FOREIGN KEY (`id_klasifikasisdm`) REFERENCES `w_sdm_klasifikasi` (`id_klasifikasismd`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_sdm_klasifikasi
-- ----------------------------
DROP TABLE IF EXISTS `w_sdm_klasifikasi`;
CREATE TABLE `w_sdm_klasifikasi`  (
  `id_klasifikasismd` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `nama_klasifikasi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sorting_data` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_klasifikasismd`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for w_slide
-- ----------------------------
DROP TABLE IF EXISTS `w_slide`;
CREATE TABLE `w_slide`  (
  `id_slide` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` datetime NULL DEFAULT NULL,
  `file_slide` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sorting_slide` int NULL DEFAULT NULL,
  `active_slide` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_slide`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
