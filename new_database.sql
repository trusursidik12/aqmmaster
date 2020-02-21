-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2020 pada 15.05
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Database: `trusur_aqm`
--
CREATE DATABASE IF NOT EXISTS `trusur_aqm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trusur_aqm`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_authorized_number`
--

DROP TABLE IF EXISTS `aqm_authorized_number`;
CREATE TABLE IF NOT EXISTS `aqm_authorized_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_calibration_factor`
--

DROP TABLE IF EXISTS `aqm_calibration_factor`;
CREATE TABLE IF NOT EXISTS `aqm_calibration_factor` (
  `faktor` varchar(50) NOT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`faktor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aqm_calibration_factor`
--

INSERT INTO `aqm_calibration_factor` (`faktor`, `nilai`) VALUES
('aco', 1),
('acs2', -0.0343),
('ah2s', 1),
('ahc', 1),
('ano2', 1),
('ao3', 1),
('aso2', 1),
('bco', 0),
('bh2s', 8.64),
('bhc', 0),
('bno2', -0.08282095100730658),
('bo3', 0),
('bso2', 182.798);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_configuration`
--

DROP TABLE IF EXISTS `aqm_configuration`;
CREATE TABLE IF NOT EXISTS `aqm_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(50) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `is_view` smallint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aqm_configuration`
--

INSERT INTO `aqm_configuration` (`id`, `data`, `content`) VALUES
(1, 'sta_nama', 'BALIKPAPAN_BARU'),
(2, 'sta_id', 'BALIKPAPAN_BB'),
(3, 'sta_alamat', 'Jl. Kelapa Dua Wetan no.23'),
(4, 'sta_kota', 'Jakarta'),
(5, 'sta_prov', 'DKI Jakarta'),
(6, 'sta_lat', '112.567'),
(7, 'sta_lon', '1.5427'),
(8, 'com_ws', 'COM8'),
(9, 'com_modem', 'COM21'),
(10, 'baud_ws', '19200'),
(11, 'baud_modem', '115200'),
(12, 'data_server', 'trusur-ispudev.ddns.net'),
(13, 'server_sim_number', '081296471251'),
(14, 'com_apc', 'COM17'),
(15, 'alert_sim_number', '081231394658'),
(16, 'power_failure_message', '{0} mati pada {1}, batt {2}%'),
(17, 'power_online_message', '{0} menyala pada {1}'),
(18, 'baud_apc', '2400'),
(19, 'com_pm10', 'COM9'),
(20, 'com_pm25', 'COM5'),
(21, 'baud_pm10', '9600'),
(22, 'baud_pm25', '9600'),
(23, 'e_pm10', '1'),
(24, 'e_pm25', '0'),
(25, 'e_so2', '1'),
(26, 'e_co', '1'),
(27, 'e_o3', '1'),
(28, 'e_no2', '1'),
(29, 'e_hc', '0'),
(30, 'e_ws', '1'),
(31, 'e_wd', '1'),
(32, 'e_humidity', '0'),
(33, 'e_temperature', '1'),
(34, 'e_pressure', '1'),
(35, 'e_sr', '0'),
(36, 'e_voc', '1'),
(37, 'e_nh3', '0'),
(38, 'e_rain_intensity', '0'),
(39, 'e_no', '0'),
(40, 'heidi', 'C:\\Program Files\\Common Files\\MariaDBShared\\HeidiSQL\\heidisql.exe'),
(41, 'gas_simulation', '1'),
(42, 'weather_simulation', '1'),
(43, 'weather_city_id', '1642911'),
(44, 'controller', 'COM3'),
(45, 'controller_baud', '9600'),
(46, 'pump_interval', '185'),
(47, 'pump_state', '1'),
(48, 'pump_last', '2020-02-18 12:04:30'),
(87, 'formula_pm10', 'substr($PM10,2,7)'),
(88, 'formula_pm10_flow', 'substr($PM10,10,3)'),
(89, 'formula_pm25', 'substr($PM25,2,7)'),
(90, 'formula_pm25_flow', 'substr($PM10,10,3)'),
(91, 'formula_so2', 'round((125 * $AIN2 - 5) * $factor[\'aso2\'] - $factor[\'bso2\'], 3)'),
(92, 'formula_co', '0'),
(93, 'formula_o3', '0'),
(94, 'formula_no2', '0'),
(95, 'formula_voc', '0'),
(96, 'formula_hc', '0'),
(97, 'formula_h2s', 'round(3.2 * ((8 + $factor[\'ah2s\']) * $AIN0) - $factor[\'bh2s\'], 3)'),
(98, 'formula_cs2', '0'),
(99, 'formula_WindSpeed', 'explode(\";\",$WS)[6]'),
(100, 'formula_WindDir', 'explode(\";\",$WS)[8]'),
(101, 'formula_TempIn', 'explode(\";\",$WS)[3]'),
(102, 'formula_TempOut', 'explode(\";\",$WS)[5]'),
(103, 'formula_Barometer', 'explode(\";\",$WS)[2]'),
(104, 'formula_RainDay', 'explode(\";\",$WS)[15]'),
(105, 'formula_RainRate', 'explode(\";\",$WS)[10]'),
(106, 'formula_SolarRad', 'explode(\";\",$WS)[12]'),
(107, 'formula_HumIn', 'explode(\";\",$WS)[4]'),
(108, 'formula_HumOut', 'explode(\";\",$WS)[9]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_data`
--

DROP TABLE IF EXISTS `aqm_data`;
CREATE TABLE IF NOT EXISTS `aqm_data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_stasiun` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `pm10` double DEFAULT NULL,
  `pm25` double DEFAULT NULL,
  `so2` double DEFAULT NULL,
  `co` double DEFAULT NULL,
  `o3` double DEFAULT NULL,
  `no2` double DEFAULT NULL,
  `hc` double DEFAULT NULL,
  `ws` double DEFAULT NULL,
  `wd` double DEFAULT NULL,
  `humidity` double DEFAULT NULL,
  `temperature` double DEFAULT NULL,
  `pressure` double DEFAULT NULL,
  `sr` double DEFAULT NULL,
  `sent` int(11) DEFAULT NULL,
  `voc` double DEFAULT NULL,
  `nh3` double DEFAULT NULL,
  `rain_intensity` double DEFAULT NULL,
  `no` double DEFAULT NULL,
  `stat_pm10` tinyint(4) DEFAULT 1,
  `stat_so2` tinyint(4) DEFAULT 1,
  `stat_co` tinyint(4) DEFAULT 1,
  `stat_o3` tinyint(4) DEFAULT 1,
  `stat_no2` tinyint(4) DEFAULT 1,
  `sent2` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_ispu`
--

DROP TABLE IF EXISTS `aqm_ispu`;
CREATE TABLE IF NOT EXISTS `aqm_ispu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_stasiun` varchar(50) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `pm10` int(11) DEFAULT NULL,
  `so2` int(11) DEFAULT NULL,
  `co` int(11) DEFAULT NULL,
  `o3` int(11) DEFAULT NULL,
  `no2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_log`
--

DROP TABLE IF EXISTS `aqm_log`;
CREATE TABLE IF NOT EXISTS `aqm_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(4) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `trace` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_params`
--

DROP TABLE IF EXISTS `aqm_params`;
CREATE TABLE IF NOT EXISTS `aqm_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param_id` varchar(10) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `default_unit` varchar(10) NOT NULL,
  `satuan` VARCHAR(20) NOT NULL,
  `is_view` smallint(6) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `param_id` (`param_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aqm_params`
--

INSERT INTO `aqm_params` (`id`, `param_id`, `caption`, `default_unit`, `is_view`, `xtimestamp`) VALUES
(1, 'pm10', 'PM10', '', 1, '2020-02-19 06:44:38'),
(2, 'pm10_flow', 'PM10 Flow', '', 1, '2020-02-19 06:44:38'),
(3, 'pm25', 'PM25', '', 1, '2020-02-19 06:44:38'),
(4, 'pm25_flow', 'PM25 Flow', '', 1, '2020-02-19 06:44:38'),
(5, 'so2', 'SO2', '', 1, '2020-02-19 06:44:38'),
(6, 'co', 'CO', '', 1, '2020-02-19 06:44:38'),
(7, 'o3', 'O3', '', 1, '2020-02-19 06:44:38'),
(8, 'no2', 'NO2', '', 1, '2020-02-19 06:44:38'),
(9, 'voc', 'VOC', '', 1, '2020-02-19 06:44:38'),
(10, 'hc', 'HC', '', 1, '2020-02-19 06:44:38'),
(11, 'h2s', 'H2S', '', 1, '2020-02-19 06:44:38'),
(12, 'cs2', 'CS2', '', 1, '2020-02-19 06:44:38'),
(13, 'WindSpeed', 'Kecepatan&nbsp;Angin', '', 1, '2020-02-19 06:44:38'),
(14, 'WindDir', 'Arah Angin', '', 1, '2020-02-19 06:44:38'),
(15, 'TempIn', 'Temperatur Dalam', '', 0, '2020-02-19 06:44:38'),
(16, 'TempOut', 'Temperatur', '', 1, '2020-02-19 06:44:38'),
(17, 'Barometer', 'Tekanan', '', 1, '2020-02-19 06:44:38'),
(18, 'RainDay', 'Curah Hujan', '', 1, '2020-02-19 06:44:38'),
(19, 'RainRate', 'Tingkat Hujan', '', 0, '2020-02-19 06:44:38'),
(20, 'SolarRad', 'Solar Radiasi', '', 1, '2020-02-19 06:44:38'),
(21, 'HumIn', 'Kelembaban Dalam', '', 0, '2020-02-19 06:44:38'),
(22, 'HumOut', 'Kelembaban', '', 1, '2020-02-19 06:44:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_sensor_values`
--

DROP TABLE IF EXISTS `aqm_sensor_values`;
CREATE TABLE IF NOT EXISTS `aqm_sensor_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AIN0` double DEFAULT NULL,
  `AIN1` double DEFAULT NULL,
  `AIN2` double DEFAULT NULL,
  `AIN3` double DEFAULT NULL,
  `PM25` varchar(255) NOT NULL,
  `PM10` varchar(255) NOT NULL,
  `WS` TEXT DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_stasiun`
--

DROP TABLE IF EXISTS `aqm_stasiun`;
CREATE TABLE IF NOT EXISTS `aqm_stasiun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stasiun` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `use_internet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aqm_stasiun`
--

INSERT INTO `aqm_stasiun` (`id`, `id_stasiun`, `nama`, `lat`, `lon`, `alamat`, `kota`, `provinsi`, `use_internet`) VALUES
(1, 'SIMPANG_TIGA', 'Simpang Tiga Cilegon', -6.0113513, 106.0431854, 'Provinsi Banten', 'Cilegon', 'Banten', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aqm_user`
--

DROP TABLE IF EXISTS `aqm_user`;
CREATE TABLE IF NOT EXISTS `aqm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `serial_ports`;
CREATE TABLE IF NOT EXISTS `serial_ports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `port` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

COMMIT;
