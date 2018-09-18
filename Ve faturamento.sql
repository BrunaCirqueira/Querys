select sum(valor) from(
select sum (total)valor,CreateDate from (
select count(distinct U_FLX_IdFatSIGEM) total,CreateDate from SBO_GERENCIADORA_PRODUCAO..OINV  where CreateDate between '27-08-2018' and '17-09-2018' and UserSign=1 and CANCELED = 'N' group by CreateDate
union all
select count(distinct U_FLX_IdFatSIGEM) total,CreateDate from SBO_GERENCIADORA_HOMOLOGACAO..OINV  where CreateDate between '27-08-2018' and '17-09-2018' and UserSign=1 and CANCELED = 'N' group by CreateDate
) Faturas
group by CreateDate
--order by CreateDate desc
) todos


--205283 16:39


 
