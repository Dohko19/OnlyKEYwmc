select
  *
from
  `sucursals`
where
  `marca_id` = 2
  and `puntuacion_total` <= 2
order by
  `puntuacion_total` asc