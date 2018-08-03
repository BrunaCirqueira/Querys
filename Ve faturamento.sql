select sum (total) from (
select count(distinct U_FLX_IdFatSIGEM) total from SBO_GERENCIADORA_PRODUCAO..OINV  where CreateDate between '13-07-2018' and '02-08-2018' and UserSign=1 
union all
select count(distinct U_FLX_IdFatSIGEM) total from SBO_GERENCIADORA_HOMOLOGACAO..OINV  where CreateDate between '13-07-2018' and '02-08-2018' and UserSign=1 
) Faturas


--205283 16:39


 
