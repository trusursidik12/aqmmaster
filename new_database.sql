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
('acs2', 0),
('ah2s', 1),
('ahc', 1),
('ano2', 1),
('ao3', 1),
('aso2', 1),
('bco', 0),
('bh2s', 0),
('bhc', 0),
('bno2', 0),
('bo3', 0),
('bso2', 0),
('bcs2', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aqm_configuration`
--

INSERT INTO `aqm_configuration` (`data`, `content`) VALUES
('device_id', '1'),
('server', '127.0.0.1'),
('sta_id', 'CIBUBUR'),
('sta_nama', 'CIBUBUR'),
('sta_alamat', 'Jl. Kelapa Dua Wetan no.23'),
('sta_kota', 'Jakarta'),
('sta_prov', 'DKI Jakarta'),
('sta_lat', '112.567'),
('sta_lon', '1.5427'),
('com_pm10', 'COM9'),
('baud_pm10', '9600'),
('com_pm25', 'COM5'),
('baud_pm25', '9600'),
('com_ws', 'COM8'),
('baud_ws', '19200'),
('controller', 'COM3'),
('controller_baud', '9600'),
('com_modem', 'COM21'),
('baud_modem', '115200'),
('pump_interval', '185'),
('pump_state', '1'),
('pump_last', '2020-02-18 12:04:30'),
('data_server', 'trusur-ispudev.ddns.net'),
('server_sim_number', '081296471251'),
('com_apc', 'COM17'),
('alert_sim_number', '081231394658'),
('power_failure_message', '{0} mati pada {1}, batt {2}%'),
('power_online_message', '{0} menyala pada {1}'),
('baud_apc', '2400'),
('e_pm10', '1'),
('e_pm25', '0'),
('e_so2', '1'),
('e_co', '1'),
('e_o3', '1'),
('e_no2', '1'),
('e_hc', '0'),
('e_ws', '1'),
('e_wd', '1'),
('e_humidity', '0'),
('e_temperature', '1'),
('e_pressure', '1'),
('e_sr', '0'),
('e_voc', '1'),
('e_nh3', '0'),
('e_rain_intensity', '0'),
('e_no', '0'),
('heidi', 'C:\\Program Files\\Common Files\\MariaDBShared\\HeidiSQL\\heidisql.exe'),
('gas_simulation', '1'),
('weather_simulation', '1'),
('weather_city_id', '1642911');

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
  `molecular_mass` double NOT NULL,
  `formula` varchar(255) DEFAULT NULL,
  `gain` double DEFAULT 0,
  `offset` double DEFAULT 0,
  `is_view` smallint(6) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `param_id` (`param_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aqm_params`
--

INSERT INTO `aqm_params` (`param_id`, `caption`, `default_unit`, `molecular_mass`, `formula`,`is_view`, `xtimestamp`) VALUES
('pm10', 'PM10', 'ug/m3',0,'substr($PM10,2,7)', 1, '2020-02-19 06:44:38'),
('pm10_flow', 'PM10 Flow', 'l/mnt',0,'substr($PM10,10,3)', 1, '2020-02-19 06:44:38'),
('pm25', 'PM25', 'ug/m3',0,'substr($PM25,2,7)', 1, '2020-02-19 06:44:38'),
('pm25_flow', 'PM25 Flow', 'l/mnt',0,'substr($PM25,10,3)', 1, '2020-02-19 06:44:38'),
('so2', 'SO2', 'ppm',64.06,'round((125 * $AIN0 - 5) * $gain - $offset, 3)', 1, '2020-02-19 06:44:38'),
('co', 'CO', 'ppm',28.01,'round((1250.0 * $AIN1 - 50.0) * $gain + $offset, 3)', 1, '2020-02-19 06:44:38'),
('o3', 'O3', 'ppm',48,'round((625.0 * $AIN2 - 25.0) * $gain + $offset, 3)', 1, '2020-02-19 06:44:38'),
('no2', 'NO2', 'ppm',46.01,'round((125.0 * $AIN3 - 5.0) * $gain + $offset, 3)', 1, '2020-02-19 06:44:38'),
('voc', 'VOC', 'ppm',78.9516,'0', 1, '2020-02-19 06:44:38'),
('h2s', 'H2S', 'ppm',34.08,'round(3.2 * ((8 + $gain) * $AIN0) - $offset, 3)', 1, '2020-02-19 06:44:38'),
('hc', 'HC', 'ppm',13.0186,'round((364002231.0 * pow($AIN1, 4.0) - 108931228.4 * pow($AIN1, 3.0) + 11924488.64 * pow($AIN1, 2.0) - 574919.2456 * $AIN1 + 10778.05204) * $gain + $offset, 3)', 1, '2020-02-19 06:44:38'),
('cs2', 'CS2', 'ppm',76.1407,'round(1.2 * ((24 + $gain) * $AIN2) - $offset, 3)', 1, '2020-02-19 06:44:38'),
('Barometer', 'Tekanan', 'MBar',0,'explode(";",$WS)[2]', 1, '2020-02-19 06:44:38'),
('TempIn', 'Temperatur Dalam', 'Celcius',0,'explode(";",$WS)[3]', 0, '2020-02-19 06:44:38'),
('HumIn', 'Kelembaban Dalam', '%',0,'explode(";",$WS)[4]', 0, '2020-02-19 06:44:38'),
('TempOut', 'Temperatur', 'Celcius',0,'explode(";",$WS)[5]', 1, '2020-02-19 06:44:38'),
('WindSpeed', 'Kec.&nbsp;Angin', 'Km/jam',0,'explode(";",$WS)[6]', 1, '2020-02-19 06:44:38'),
('WindSpeed10Min', 'Kec.&nbsp;Angin&nbsp;10Min', 'Km/jam',0,'explode(";",$WS)[7]', 1, '2020-02-19 06:44:38'),
('WindDir', 'Arah Angin', '°',0,'explode(";",$WS)[8]', 1, '2020-02-19 06:44:38'),
('HumOut', 'Kelembaban', '%',0,'explode(";",$WS)[9]', 1, '2020-02-19 06:44:38'),
('RainRate', 'Tingkat Hujan', 'mm/jam',0,'explode(";",$WS)[10]', 0, '2020-02-19 06:44:38'),
('UV', 'UV', '',0,'explode(";",$WS)[11]', 0, '2020-02-19 06:44:38'),
('SolarRad', 'Solar Radiasi', 'watt/m2',0,'explode(";",$WS)[12]', 1, '2020-02-19 06:44:38'),
('RainDay', 'Curah Hujan', 'mm/jam',0,'explode(";",$WS)[15]', 1, '2020-02-19 06:44:38');

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
  `PM25` varchar(255) DEFAULT NULL,
  `PM10` varchar(255) DEFAULT NULL,
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
