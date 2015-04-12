CREATE DATABASE CompuOrder CHARACTER SET utf8 COLLATE utf8_general_ci;

drop table if exists CompuOrder.region
drop table if exists CompuOrder.ciudad
drop table if exists CompuOrder.comuna
drop table if exists CompuOrder.sucursalEmpresa
drop table if exists CompuOrder.cargo
drop table if exists CompuOrder.personal
drop table if exists CompuOrder.clasificacionFalla
drop table if exists CompuOrder.falla
drop table if exists CompuOrder.familiaInsumo
drop table if exists CompuOrder.insumo
drop table if exists CompuOrder.estado
drop table if exists CompuOrder.servicio
drop table if exists CompuOrder.cliente
drop table if exists CompuOrder.sucursalCliente
drop table if exists CompuOrder.responsable
drop table if exists CompuOrder.planOT
drop table if exists CompuOrder.otDetalle
drop table if exists CompuOrder.posterga




create table CompuOrder.region
(
	reg_uid int auto_increment, 
	reg_snombre varchar(50), 
	reg_snumero_region varchar(50), 

	unique(reg_snombre),
	PRIMARY KEY(reg_uid)
);

create table CompuOrder.ciudad
(
	ciu_uid int auto_increment, 
	fk_reg_uid int not null, 
	ciu_snombre varchar(50),

	unique(ciu_snombre), 
	PRIMARY KEY(ciu_uid), 
	FOREIGN KEY(fk_reg_uid)
	REFERENCES CompuOrder.region(reg_uid)
);

create table CompuOrder.comuna
(
	com_uid int auto_increment, 
	fk_ciu_uid int not null, 
	com_snombre varchar(50), 

	unique(com_snombre), 
	PRIMARY KEY(com_uid), 
	FOREIGN KEY(fk_ciu_uid) 
	REFERENCES CompuOrder.ciudad(ciu_uid)
);

create table CompuOrder.sucursalEmpresa
(
	sucEmp_uid int auto_increment, 
	fk_com_uid int not null, 
	sucEmp_snombre varchar(50), 
	sucEmp_sdireccion varchar(50), 
	
	PRIMARY KEY(sucEmp_uid), 
	FOREIGN KEY(fk_com_uid)
	REFERENCES CompuOrder.comuna(com_uid)
);

create table CompuOrder.cargo
(
	car_uid int auto_increment, 
	car_snombre varchar(50), 
        car_sdescripcion varchar(255), 
	
	unique(car_snombre), 
	PRIMARY KEY(car_uid)
);

create table CompuOrder.personal
(
	per_uid int auto_increment, 
	fk_car_uid int not null, 
	fk_com_uid int not null, 
	per_srut varchar(12), 
	per_snombre varchar(50), 
	per_sapellido varchar(50), 
	per_dfechaIngreso timestamp, 
	per_semail varchar(50), 
	per_sfonoLocal varchar(15), 
	per_sfonoMovil varchar(15), 
	per_sdireccion varchar(50), 
	
	PRIMARY KEY(per_uid), 
	FOREIGN KEY(fk_car_uid)
	REFERENCES CompuOrder.cargo(car_uid), 
	FOREIGN KEY(fk_com_uid)
	REFERENCES CompuOrder.comuna(com_uid)
);

create table CompuOrder.sucursalTecnico
(
    sucTec_uid int auto_increment, 
    fk_sucEmp_uid int not null, 
    fk_per_uid int not null, 
    sucTec_snombreSede varchar(50), 
    sucTec_sdireccion varchar(50), 
    
    PRIMARY KEY(sucTec_uid), 
    FOREIGN KEY(fk_sucEmp_uid)
    REFERENCES CompuOrder.sucursalEmpresa(sucEmp_uid), 
    FOREIGN KEY(fk_per_uid)
    REFERENCES CompuOrder.personal(per_uid)
);

create table CompuOrder.clasificacionFalla
(
    cla_uid int auto_increment, 
    cla_snombre varchar(50),
 
    PRIMARY KEY(cla_uid)
);

create table CompuOrder.falla
(
    fal_uid int auto_increment,
    fk_cla_uid int not null, 
    fal_sdescripcion varchar(50), 
    
    PRIMARY KEY(fal_uid), 
    FOREIGN KEY(fk_cla_uid)
    REFERENCES CompuOrder.clasificacionFalla(cla_uid) 
);

create table CompuOrder.familiaInsumo
(
    fam_uid int auto_increment, 
    fam_snombre varchar(50), 
    PRIMARY KEY(fam_uid)
);

create table CompuOrder.insumo
(
    ins_uid int auto_increment, 
    fk_fam_uid int, 
    ins_snombre varchar(50), 
    ins_nprecio int, 
    ins_ncantidadDisponible int, 
    
    PRIMARY KEY(ins_uid), 
    FOREIGN KEY(fk_fam_uid)
    REFERENCES CompuOrder.familiaInsumo(fam_uid) 
);

create table CompuOrder.insumoOT
(
    insot_uid int auto_increment, 
    insot_ncantidad int, 
    fk_ins_uid int, 
    fk_det_uid int, 

    PRIMARY KEY(insot_uid), 
    FOREIGN KEY(fk_ins_uid)
    REFERENCES CompuOrder.insumo(ins_uid)
);


create table CompuOrder.estado
(
    est_uid int auto_increment, 
    est_snombre varchar(50), 
    est_sdescripcion varchar(50), 
    -- est_mimagen mediumblob, formato que permite guardar imagenes, 
    -- perfecto para los colores de los semaforos

    PRIMARY KEY(est_uid)
);

create table CompuOrder.servicio
(
    ser_uid int auto_increment, 
    ser_snombre varchar(50), 

    PRIMARY KEY(ser_uid)
);

create table CompuOrder.cliente
(
    cli_uid int auto_increment, 
    cli_srut varchar(11), 
    cli_snombre varchar(50), 
    cli_sacronimo varchar(50), 
    cli_srubro varchar(255), 

    PRIMARY KEY(cli_uid)
);

create table CompuOrder.sucursalCliente
(
    sucCli_uid int auto_increment, 
    sucCli_snombre varchar(50), 
    sucCli_sdireccion varchar(50), 
    sucCli_sfonoLocal varchar(15), 
    fk_com_uid int, 
    fk_cli_uid int, 

    PRIMARY KEY(sucCli_uid), 
    FOREIGN KEY(fk_com_uid)
    REFERENCES CompuOrder.comuna(com_uid), 
    FOREIGN KEY(fk_cli_uid)
    REFERENCES CompuOrder.cliente(cli_uid)
);

create table CompuOrder.responsable
(
    res_uid int auto_increment, 
    res_snombre varchar(50), 
    res_sapellido varchar(50), 
    res_sfono varchar(15), 
    res_semail varchar(50), 

    PRIMARY KEY(res_uid)
);

create table CompuOrder.planOT
(
    pln_uid int auto_increment, 
    pln_dfechaHoraPlan timestamp, 
    pln_sdescripcion varchar(255), 
    pln_dfechaHoraEmisionIdeal date, 
    fk_per_uid int, 
    fk_est_uid int, 

    PRIMARY KEY(pln_uid), 
    FOREIGN KEY(fk_per_uid)
    REFERENCES CompuOrder.personal(per_uid), 
    FOREIGN KEY(fk_est_uid)
    REFERENCES CompuOrder.estado(fk_est_uid) 
);

create table CompuOrder.otDetalle
(
    det_uid int auto_increment, 
    det_dfechaComienzo timestamp, 
    det_dfechaTermino date, 
    det_ncoordenadaX double, 
    det_ncoordenadaY double, 
    det_sdescripcion varchar(255), 
    fk_res_uid int, 
    fk_pln_uid int, 
    fk_fal_uid int, 
    fk_ser_uid int,
    
    PRIMARY KEY(det_uid), 
    FOREIGN KEY(fk_res_uid)
    REFERENCES CompuOrder.responsable(res_uid), 
    FOREIGN KEY(fk_pln_uid)
    REFERENCES CompuOrder.planOT(pln_uid), 
    FOREIGN KEY(fk_fal_uid)
    REFERENCES CompuOrder.falla(per_uid), 
    FOREIGN KEY(fk_ser_uid)
    REFERENCES CompuOrder.servicio(ser_uid)
);

create table CompuOrder.posterga
(
    pos_uid int auto_increment, 
    pos_dfechaInicio date, 
    pos_dfechaFinal date, 
    fk_per_uid int, 

    PRIMARY KEY(pos_uid), 
    FOREIGN KEY(fk_per_uid)
    REFERENCES CompuOrder.personal(per_uid)
);

