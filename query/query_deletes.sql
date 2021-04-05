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

