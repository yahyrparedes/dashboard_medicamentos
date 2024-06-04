select *
from users u
         inner join user_doctor ur on u.id = ur.user_id
         inner  join reminders r on u.id = r.user_id
         inner join medications m on r.medication_id = m.id
where  r.created_at between '2024-01-01' and '2024-12-31' ;












