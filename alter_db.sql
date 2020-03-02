USE `trusur_aqm`;

INSERT INTO aqm_configuration (`data`, content)
SELECT * FROM (SELECT 'pump_control', '1') AS tmp
WHERE NOT EXISTS (
    SELECT `data` FROM aqm_configuration WHERE `data` = 'pump_control'
) LIMIT 1;

INSERT INTO aqm_params (param_id, caption, default_unit,molecular_mass,formula,is_view)
SELECT * FROM (SELECT 'pm10_bar', 'Tekanan PM10','MBar',0,'explode(",",$PM10)[4]',0 as view) AS tmp
WHERE NOT EXISTS (
    SELECT `param_id` FROM aqm_params WHERE `param_id` = 'pm10_bar'
) LIMIT 1;

INSERT INTO aqm_params (param_id, caption, default_unit,molecular_mass,formula,is_view)
SELECT * FROM (SELECT 'pm10_humid', 'Kelembaban PM10','%',0,'explode(",",$PM10)[3]',0 as view) AS tmp
WHERE NOT EXISTS (
    SELECT `param_id` FROM aqm_params WHERE `param_id` = 'pm10_humid'
) LIMIT 1;

INSERT INTO aqm_params (param_id, caption, default_unit,molecular_mass,formula,is_view)
SELECT * FROM (SELECT 'pm10_temp', 'Suhu PM10','Celcius',0,'explode(",",$PM10)[2]',0 as view) AS tmp
WHERE NOT EXISTS (
    SELECT `param_id` FROM aqm_params WHERE `param_id` = 'pm10_temp'
) LIMIT 1;

INSERT INTO aqm_params (param_id, caption, default_unit,molecular_mass,formula,is_view)
SELECT * FROM (SELECT 'pm25_bar', 'Tekanan PM25','MBar',0,'explode(",",$PM25)[4]',1) AS tmp
WHERE NOT EXISTS (
    SELECT `param_id` FROM aqm_params WHERE `param_id` = 'pm25_bar'
) LIMIT 1;

INSERT INTO aqm_params (param_id, caption, default_unit,molecular_mass,formula,is_view)
SELECT * FROM (SELECT 'pm25_humid', 'Kelembaban PM25','%',0,'explode(",",$PM25)[3]',1) AS tmp
WHERE NOT EXISTS (
    SELECT `param_id` FROM aqm_params WHERE `param_id` = 'pm25_humid'
) LIMIT 1;

INSERT INTO aqm_params (param_id, caption, default_unit,molecular_mass,formula,is_view)
SELECT * FROM (SELECT 'pm25_temp', 'Suhu PM25','Celcius',0,'explode(",",$PM25)[2]',1) AS tmp
WHERE NOT EXISTS (
    SELECT `param_id` FROM aqm_params WHERE `param_id` = 'pm25_temp'
) LIMIT 1;