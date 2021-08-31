SELECT t.idtransaccion, t.tipo, DATE_FORMAT(t.fecha,'%d/%m/%Y') AS fecha, t.importe, t.notrans, t.glosa, tr.producto, p.declaracion_proyecto, p.`id_usuario`, IF(t.`tipo`= 'I', t.`importe`, 0) AS ingresos, IF(t.`tipo`= 'E', t.`importe`, 0) AS egresos
FROM transaccion t 
LEFT JOIN st_trabajos tr ON t.id_item = tr.id_item 
LEFT JOIN st_proyecto p  ON tr.id_st_proyecto = p.id_st_proyecto
WHERE t.idcuenta = 2
ORDER BY t.fecha
;


SELECT p.declaracion_proyecto, p.`id_usuario`, SUM(IF(t.`tipo`= 'I', t.`importe`, 0)) AS ingresos, SUM(IF(t.`tipo`= 'E', t.`importe`, 0)) AS egresos
FROM transaccion t 
LEFT JOIN st_trabajos tr ON t.id_item = tr.id_item 
LEFT JOIN st_proyecto p  ON tr.id_st_proyecto = p.id_st_proyecto
WHERE t.idcuenta = 2
GROUP BY p.declaracion_proyecto, p.`id_usuario`
;



SELECT t.idtransaccion, t.tipo, DATE_FORMAT(t.fecha,'%d/%m/%Y') AS fecha, t.importe, t.notrans, t.glosa, tr.producto, p.declaracion_proyecto, tr.`caracteristicas`, i.`id_usuario`, i.`detalles`,
IF(t.`tipo`= 'I', t.`importe`, 0) AS ingresos, IF(t.`tipo`= 'E', t.`importe`, 0) AS egresos
FROM transaccion t 
LEFT JOIN st_trabajos tr ON t.id_item = tr.id_item 
LEFT JOIN st_proyecto p  ON tr.id_st_proyecto = p.id_st_proyecto
LEFT JOIN st_cronograma_informes_f002 i ON tr.`id_item` = i.`id_item`
WHERE t.idcuenta = 2
ORDER BY t.fecha
;

SELECT p.declaracion_proyecto, tr.`caracteristicas`, i.`id_usuario`, SUM(IF(t.`tipo`= 'I', t.`importe`, 0)) AS ingresos, SUM(IF(t.`tipo`= 'E', t.`importe`, 0)) AS egresos
FROM transaccion t 
LEFT JOIN st_trabajos tr ON t.id_item = tr.id_item 
LEFT JOIN st_proyecto p  ON tr.id_st_proyecto = p.id_st_proyecto
LEFT JOIN st_cronograma_informes_f002 i ON tr.`id_item` = i.`id_item`
WHERE t.idcuenta = 2
GROUP BY p.declaracion_proyecto, tr.`caracteristicas`, i.`id_usuario`
;

