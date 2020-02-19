DROP TABLE IF EXISTS `aqm_params`;
CREATE TABLE `aqm_params` (
  `id` int(11) NOT NULL,
  `param_id` varchar(10) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `default_unit` varchar(10) NOT NULL,
  `is_view` smallint(6) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `aqm_params` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `param_id` (`param_id`);
ALTER TABLE `aqm_params` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO aqm_params (param_id,caption,default_unit,is_view) VALUES
('pm10','PM10','',1),
('pm10_flow','PM10 Flow','',1),
('pm25','PM25','',1),
('pm25_flow','PM25 Flow','',1),
('so2','SO2','',1),
('co','CO','',1),
('o3','O3','',1),
('no2','NO2','',1),
('voc','VOC','',1),
('hc','HC','',1),
('h2s','H2S','',1),
('cs2','CS2','',1),
('WindSpeed','Kecepatan Angin','',1),
('WindDir','Arah Angin','',1),
('TempIn','Temperatur Dalam','',1),
('TempOut','Temperatur Luar','',1),
('Barometer','Tekanan','',1),
('RainDay','Curah Hujan','',1),
('RainRate','Tingkat Hujan','',1),
('SolarRad','Solar Radiasi','',1),
('HumIn','Kelembapan Dalam','',1),
('HumOut','Kelembapan Luar','',1);


DELETE FROM aqm_configuration WHERE data LIKE 'formula_%';
INSERT INTO `aqm_configuration` (`data`, `content`) VALUES
('formula_pm10', 'substr($PM10,2,7)'),
('formula_pm10_flow', 'substr($PM10,10,3)'),
('formula_pm25', 'substr($PM25,2,7)'),
('formula_pm25_flow', 'substr($PM10,10,3)'),
('formula_so2', '0'),
('formula_co', '0'),
('formula_o3', '0'),
('formula_no2', '0'),
('formula_voc', '0'),
('formula_hc', '0'),
('formula_h2s', 'round(3.2 * ((8 + $factor[\'ah2s\']) * $AIN0) - 1.994, 3)'),
('formula_cs2', 'round(5 * ((8 + $factor[\'acs2\']) * $AIN1) - 2, 3)'),
('formula_WindSpeed', 'explode(\";\",$WS)[6]'),
('formula_WindDir', 'explode(\";\",$WS)[8]'),
('formula_TempIn', 'explode(\";\",$WS)[3]'),
('formula_TempOut', 'explode(\";\",$WS)[5]'),
('formula_Barometer', 'explode(\";\",$WS)[2]'),
('formula_RainDay', 'explode(\";\",$WS)[15]'),
('formula_RainRate', 'explode(\";\",$WS)[10]'),
('formula_SolarRad', 'explode(\";\",$WS)[12]'),
('formula_HumIn', 'explode(\";\",$WS)[4]'),
('formula_HumOut', 'explode(\";\",$WS)[9]');