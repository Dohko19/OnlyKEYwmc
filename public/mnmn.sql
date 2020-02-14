select
  `sucursals`.`id`,
  `sucursals`.`name`,
  `q`.`RI`
from
  `sucursals`
  left join `qresults` as `q` on `q`.`sucursal_id` = `sucursals`.`id`
where
  `sucursals`.`marca_id` = 2
order by
  `RI` ASC