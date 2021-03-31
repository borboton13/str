--
create table banco (
  idbanco int(10) not null,
  codigo varchar(20) ,
  nombre varchar(100),
  primary key (idbanco)
);

create table cuenta (
  idcuenta int(10) not null,
  numero varchar(100) not null,
  moneda varchar(3) not null,
  descripcion varchar (100),
  idbanco int(10) not null,
  primary key (idcuenta)
);

alter table cuenta add foreign key (idbanco) references banco(idbanco);

create table transaccion (
  idtransaccion int(10) not null auto_increment,
  importe decimal(16,2) not null,
  tipo varchar(1) not null,
  notrans varchar(100),
  glosa varchar (255) not null,
  idcuenta int(10) not null,
  id_item int(10) unsigned,
  primary key (idtransaccion)
);

alter table transaccion add foreign key (idcuenta) references cuenta(idcuenta);
alter table transaccion add foreign key (id_item) references st_trabajos(id_item);


alter table transaccion add column fecha date after idtransaccion;
alter table transaccion add column fechacre datetime;



