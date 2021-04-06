select p.`id_st_proyecto`, p.`id_cliente`, p.`fecha_inicio`, p.`fecha_final`, t.`id_item`, t.`producto`, t.`ubicacion`, i.`id_st_cronograma_informes_f001`
from st_proyecto p
left join st_trabajos t 		  on p.`id_st_proyecto` = t.`id_st_proyecto`
left join `st_cronograma_informes_f001` i on t.`id_item` = i.`id_item`
where p.`id_st_proyecto` = 'ST00031'
;

-- Eliminando archivos
delete from `st_cronograma_informes_f001_archivos`
where id_st_cronograma_informes_f001 in (

	select i.`id_st_cronograma_informes_f001`
	from st_proyecto p
	left join st_trabajos t 		  on p.`id_st_proyecto` = t.`id_st_proyecto`
	left join `st_cronograma_informes_f001` i on t.`id_item` = i.`id_item`
	where p.`id_st_proyecto` in (
	'ST00111'
	)

);

-- Eliminando archivos
delete from `st_cronograma_informes_f002_archivos`
where id_st_cronograma_informes_f002 in (

	select i.`id_st_cronograma_informes_f002`
	from st_proyecto p
	left join st_trabajos t 		  on p.`id_st_proyecto` = t.`id_st_proyecto`
	left join `st_cronograma_informes_f002` i on t.`id_item` = i.`id_item`
	where p.`id_st_proyecto` in (
'ST00111'
	)
);

-- Eliminando informes
delete from st_cronograma_informes_f001 
where id_st_proyecto in (
'ST00111'
);

-- Eliminando informes
delete from st_cronograma_informes_f002 
where id_st_proyecto in (
'ST00111'
);


-- Eliminando trabajos
delete from st_trabajos
where id_st_proyecto in (
'ST00111'
);

-- Eliminando proyecto
delete from st_proyecto
where id_st_proyecto in (
'ST00111'
);

-- --
delete from usuarios where id not in ('A42', 'A44');

update parametrica p set p.`descripcion` = 'Tecnico' where p.`descripcion` = 'Técnico';

delete from transaccion where idtransaccion not in (1);

update cuenta c set c.`numero` = '10000033455177', c.`idbanco` = 2, c.`descripcion` = 'Caja Ahorros MN' where c.`idcuenta` = 1;
update cuenta c set c.`numero` = '10000021119587', c.`idbanco` = 2, c.`descripcion` = 'Caja Ahorros P. Juridica MN' where c.`idcuenta` = 2;

delete from st_cronograma_informes_f001;
delete from st_trabajos;
delete from estacion_nueva;

delete from documento;
delete from documentoacta;
delete from evento;
delete from st_ticket;
delete from estacion;

update secuencias s set s.`valor` = 'C00004' where s.`id_secuencia` = 'clientes';
update secuencias s set s.`valor` = 'B01' where s.`id_secuencia` = 'usuarios';

update secuencias s set s.`valor` = 'ST00003' where s.`id_secuencia` = 'seguimiento_tecnico';

update parametrica p set p.`descripcion` = 0 where p.`sub_grupo` = '0 Estrellas';
update parametrica p set p.`descripcion` = 1 where p.`sub_grupo` = '1 Estrellas';
update parametrica p set p.`descripcion` = 2 where p.`sub_grupo` = '2 Estrellas';
update parametrica p set p.`descripcion` = 3 where p.`sub_grupo` = '3 Estrellas';
update parametrica p set p.`descripcion` = 4 where p.`sub_grupo` = '4 Estrellas';
update parametrica p set p.`descripcion` = 5 where p.`sub_grupo` = '5 Estrellas';


esta


