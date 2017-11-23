ALTER TABLE `admin_base`.`devices`
ADD COLUMN `transmision` varchar(100) DEFAULT NULL,
ADD COLUMN `tipoCombustible` varchar(100) DEFAULT NULL,
ADD COLUMN `emisionesCO2` varchar(45) DEFAULT NULL,
ADD COLUMN `caballosPotencia` int(11) DEFAULT NULL,
ADD COLUMN `fechaAdquisicion` date DEFAULT NULL,
ADD COLUMN `valorCoche` varchar(45) DEFAULT NULL,
ADD COLUMN `numAsientos` int(11) DEFAULT NULL,
ADD COLUMN `numPuertas` int(11) DEFAULT NULL,
ADD COLUMN `color` varchar(45) DEFAULT NULL,
ADD COLUMN `image` varchar(2) DEFAULT NULL,
ADD COLUMN `file_id` int(11) DEFAULT NULL,
ADD COLUMN `telefono` varchar(45) DEFAULT NULL,
ADD COLUMN `vehicle` int(1) DEFAULT '1',
ADD COLUMN `company_id` int(11) DEFAULT NULL,
ADD COLUMN `reponsable_id` int(11) DEFAULT NULL,
ADD COLUMN `responsable_fisico_id` int(11) DEFAULT NULL,
ADD COLUMN `bastidor` varchar(45) DEFAULT NULL,
ADD COLUMN `odometro_inicial` varchar(45) DEFAULT NULL,
ADD COLUMN `placas` varchar(15) DEFAULT NULL,
ADD COLUMN `speed_max` int(5) DEFAULT NULL,
ADD COLUMN `unidad_speed` varchar(45) DEFAULT NULL,
ADD COLUMN `history` varchar(45) DEFAULT NULL,
ADD COLUMN `gps_name` varchar(45) DEFAULT NULL,
ADD COLUMN `speed_start` datetime DEFAULT NULL,
ADD COLUMN `speed_end` datetime DEFAULT NULL,
ADD COLUMN `status` varchar(1) DEFAULT '1',
ADD COLUMN `mail_speed` varchar(55) DEFAULT NULL;

insert into admin_base.devices ( id, name, uniqueid, lastupdate, positionid, groupid, attributes,  transmision, tipoCombustible, emisionesCO2, caballosPotencia, fechaAdquisicion, valorCoche, numAsientos, numPuertas, color, image, file_id, telefono, vehicle, company_id, reponsable_id, responsable_fisico_id, bastidor, odometro_inicial, placas, speed_max, unidad_speed, history, gps_name, speed_start, speed_end,  status, mail_speed)  SELECT id, name, uniqueid, lastupdate, positionid, groupid, attributes,  transmision, tipoCombustible, emisionesCO2, caballosPotencia, fechaAdquisicion, valorCoche, numAsientos, numPuertas, color, image, file_id, telefono, vehicle, company_id, reponsable_id, responsable_fisico_id, bastidor, odometro_inicial, placas, speed_max, unidad_speed, history, gps_name, speed_start, speed_end,  status, mail_speed FROM admin_master.devices;

insert into admin_base.user_device SELECT * FROM admin_master.user_device;

ALTER TABLE `admin_base`.`positions` 
ADD COLUMN `other` varchar(500) DEFAULT NULL,
ADD COLUMN `leido` int(1) DEFAULT '0',
ADD COLUMN `event` varchar(65) DEFAULT NULL,
ADD COLUMN `geofence` varchar(45) DEFAULT NULL;

ALTER TABLE `admin_base`.`users` 
ADD COLUMN `files_id` int(11) DEFAULT '0',
ADD COLUMN `language` varchar(128) DEFAULT NULL,
ADD COLUMN `sesion_start` varchar(45) DEFAULT NULL,
ADD COLUMN `company_id` varchar(45) DEFAULT NULL,
ADD COLUMN `acceso_inicio` date DEFAULT NULL,
ADD COLUMN `acceso_fin` date DEFAULT NULL,
ADD COLUMN `moduloInicio` varchar(200) DEFAULT NULL,
ADD COLUMN `password` varchar(35) DEFAULT NULL;

insert into admin_base.users (id,name,email,hashedpassword,salt,readonly,admin,map,distanceunit,speedunit,latitude,longitude,zoom,twelvehourformat,attributes,files_id,language,sesion_start,company_id,acceso_inicio,acceso_fin,moduloInicio,password)  SELECT id,name,email,hashedpassword,salt,readonly,admin,map,distanceunit,speedunit,latitude,longitude,zoom,twelvehourformat,attributes,files_id,language,sesion_start,company_id,acceso_inicio,acceso_fin,moduloInicio,password FROM admin_master.users;

CREATE TABLE IF NOT EXISTS `admin_base`.`company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razonSocial` varchar(50) DEFAULT NULL,
  `RFC` varchar(13) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `estatus` int(4) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL,
  `Id_detalleDatos` int(11) DEFAULT NULL,
  `files_id` int(11) DEFAULT NULL,
  `lema` varchar(45) DEFAULT NULL,
  `mail_from` varchar(45) DEFAULT NULL,
  `mail_cc` varchar(45) DEFAULT NULL,
  `mail_reply` varchar(45) DEFAULT NULL,
  `mail_bbc` varchar(45) DEFAULT NULL,
  `sistema_web` varchar(45) DEFAULT NULL,
  `domicilio_fiscal` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
create table company LIKE admin_master.company;
insert into admin_base.company SELECT * FROM admin_master.company;

CREATE TABLE IF NOT EXISTS `admin_base`.`alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `fechaEvento` datetime DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `asunto` varchar(45) DEFAULT NULL,
  `origen_user_id` int(11) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `fecha_siguiente` date DEFAULT NULL,
  `mensaje` int(1) DEFAULT '0',
  `menu_id` int(11) DEFAULT NULL,
  `submenu_id` int(11) DEFAULT NULL,
  `opcion_id` int(11) DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
DROP TABLE alert;
create table alert LIKE admin_master.alert;
insert into admin_base.alert SELECT * FROM admin_master.alert;

CREATE TABLE IF NOT EXISTS `admin_base`.`alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `event` varchar(45) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `geofence_in` varchar(90) DEFAULT NULL,
  `geofence_out` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
insert into admin_base.alerts SELECT * FROM admin_master.alerts;


CREATE TABLE IF NOT EXISTS `admin_base`.`alerts_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alerts_id` int(11) DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

insert into admin_base.alerts_device SELECT * FROM admin_master.alerts_device;


CREATE TABLE IF NOT EXISTS `admin_base`.`alerts_geofence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alerts_id` int(11) DEFAULT NULL,
  `geofence_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

insert into admin_base.alerts_geofence SELECT * FROM admin_master.alerts_geofence;


CREATE TABLE IF NOT EXISTS `admin_base`.`devices_geofences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceid` int(4) DEFAULT NULL,
  `geofenceid` int(5) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `del` int(1) DEFAULT NULL,
  `positionid` int(11) DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `alertid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
DROP TABLE devices_geofences;
create table devices_geofences LIKE admin_master.devices_geofences;

insert into admin_base.devices_geofences SELECT * FROM admin_master.devices_geofences;

CREATE TABLE IF NOT EXISTS `admin_base`.`events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(128) NOT NULL,
  `servertime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deviceid` int(11) DEFAULT NULL,
  `positionid` int(11) DEFAULT NULL,
  `geofenceid` int(11) DEFAULT NULL,
  `attributes` varchar(4096) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_event_deviceid` (`deviceid`)
);
insert into admin_base.events SELECT * FROM admin_master.events;

CREATE TABLE IF NOT EXISTS `admin_base`.`files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` text,
  `type` text,
  `table` text,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fecha` text,
  `extension` text,
  PRIMARY KEY (`id`)
);
insert into admin_base.files SELECT * FROM admin_master.files;



ALTER TABLE `admin_base`.`geofences` 
ADD COLUMN `points` varchar(3000) DEFAULT NULL,
ADD COLUMN `geofence_email_in` varchar(450) DEFAULT NULL,
ADD COLUMN `geofence_email_out` varchar(450) DEFAULT NULL,
ADD COLUMN `company_id` int(11) DEFAULT NULL,
ADD COLUMN `color` varchar(10) DEFAULT NULL,
ADD COLUMN `hidden` varchar(1) DEFAULT NULL;

DROP TABLE geofences;
create table geofences LIKE admin_master.geofences;


insert into admin_base.geofences SELECT * FROM admin_master.geofences;


ALTER TABLE `admin_base`.`groups` 
ADD COLUMN `menu_id` int(11) DEFAULT NULL,
ADD COLUMN `nivel` int(2) DEFAULT NULL,
ADD COLUMN `description` varchar(100) DEFAULT NULL;

insert into admin_base.groups  SELECT * FROM admin_master.groups;

CREATE TABLE IF NOT EXISTS `admin_base`.`menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

insert into admin_base.menu SELECT * FROM admin_master.menu;

CREATE TABLE IF NOT EXISTS `admin_base`.`modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clase` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
insert into admin_base.modulos SELECT * FROM admin_master.modulos;


CREATE TABLE IF NOT EXISTS `admin_base`.`permiso` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `usergroup_id` int(4) DEFAULT NULL,
  `menu_id` int(4) DEFAULT NULL,
  `s` int(1) DEFAULT NULL,
  `c` int(1) DEFAULT NULL,
  `w` int(1) DEFAULT NULL,
  `d` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
insert into admin_base.permiso SELECT * FROM admin_master.permiso;

CREATE TABLE IF NOT EXISTS `admin_base`.`route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `description` tinytext CHARACTER SET latin1,
  `start` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `end` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `costo` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `venta` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `distancia` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `text` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `tiempo` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `points` tinytext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
);
DROP TABLE route;
create table route LIKE admin_master.route;

insert into admin_base.route SELECT * FROM admin_master.route;


CREATE TABLE IF NOT EXISTS `admin_base`.`sesion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) DEFAULT NULL,
  `server_addr` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `http_user_agent` varchar(150) DEFAULT NULL,
  `remote_addr` varchar(45) DEFAULT NULL,
  `last_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `admin_base`.`tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ejecucion` datetime DEFAULT NULL,
  `now_time` datetime DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `codigo` varchar(200) DEFAULT NULL,
  `cantidad` int(3) DEFAULT NULL,
  `type_time` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
create table tareas LIKE admin_master.tareas;
insert into admin_base.tareas SELECT * FROM admin_master.tareas;

ALTER TABLE `admin_base`.`user_group` 
ADD COLUMN `active` int(1) DEFAULT NULL,
ADD COLUMN `id` int(6) NOT NULL,
ADD COLUMN `company_id` int(3) DEFAULT NULL,
ADD COLUMN `user_id` int(5) DEFAULT NULL,
ADD COLUMN `menu_id` int(3) DEFAULT NULL;

insert into admin_base.user_group SELECT * FROM admin_master.user_group;


CREATE TABLE IF NOT EXISTS `admin_base`.`event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estatus` varchar(20) COLLATE utf8_spanish_ci DEFAULT 'ACTIVO',
  `fechaRegistro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);
insert into admin_base.event SELECT * FROM admin_master.event;

CREATE TABLE IF NOT EXISTS `admin_base`.`crons_history` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `resume` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `cron_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
);






















