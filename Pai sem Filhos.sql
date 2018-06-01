select teste, [U_FLX_IdFatSIGEM],TransId,hah
from (
select  COUNT(T0.[DocEntry]) over (PARTITION BY [U_FLX_IdFatSIGEM]) teste,count (t1.ItemCode) hah,[U_FLX_IdFatSIGEM], TransId FROM OINV t0
INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry] 
where DocDueDate between '01-04-2017' and '30-04-2017' and itemcode <> '1000029'
--and [U_FLX_IdFatSIGEM] =  2356376-- 2267474
and t1.itemcode not in ('0800124','0800123','0800122','0800188')
group by [U_FLX_IdFatSIGEM],T0.[DocEntry],TransId) as t
group by  teste, [U_FLX_IdFatSIGEM],TransId,hah

having teste=1 and hah>1


-- ADD TAble OITM para tirar os itens pai

select teste, [U_FLX_IdFatSIGEM],TransId,hah
from (
select  COUNT(T0.[DocEntry]) over (PARTITION BY [U_FLX_IdFatSIGEM]) teste,count (t1.ItemCode) hah,[U_FLX_IdFatSIGEM], TransId FROM OINV t0
INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry] inner join OITM T2 on t1.ItemCode = t2.ItemCode and t2.TreeType = 'N'
where DocDueDate between '01-03-2018' and '31-03-2018' and t1.itemcode <> '1000029'
--and [U_FLX_IdFatSIGEM] =  2356376-- 2267474
and t1.itemcode not in ('0800124','0800123','0800122','0800188')
group by [U_FLX_IdFatSIGEM],T0.[DocEntry],TransId) as t
group by  teste, [U_FLX_IdFatSIGEM],TransId,hah

having teste=1 and hah>1