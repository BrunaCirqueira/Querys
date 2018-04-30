-- TODOS---

select DISTINCT [U_FLX_IdFatSIGEM],Valor from (

select  TOP 100 PERCENT 
 
[U_FLX_IdFatSIGEM],filiacao,
     (CASE 
		     when DocStatus = 'O' and 
				  LAG(DocStatus) OVER(ORDER BY [U_FLX_IdFatSIGEM]) = 'C' and
				  [U_FLX_IdFatSIGEM] = LAG([U_FLX_IdFatSIGEM]) OVER(ORDER BY [U_FLX_IdFatSIGEM])
		      then  'NOTAS COM STATUS DIVERGENTES'

			  when DocStatus = 'C' and 
				  LEAD(DocStatus) OVER(ORDER BY [U_FLX_IdFatSIGEM]) = 'O' and
				 [U_FLX_IdFatSIGEM] = LEAD([U_FLX_IdFatSIGEM]) OVER(ORDER BY [U_FLX_IdFatSIGEM])
		      then  'NOTAS COM STATUS DIVERGENTES'

         else 'ND' end) Valor

from(
select DISTINCT
				[U_FLX_IdFatSIGEM], 
				--DocStatus,
				DocStatus = (case when t0.DocTotal =t0.PaidToDate then 'C' when t0.PaidToDate = 0 then 'O' when (t0.DocTotal <>t0.PaidToDate and t0.PaidToDate > 0 ) then 'P' else 'ND' end ),
				(case when t0.BPLId=1 then 'Pai' when t0.BPLId<>1 then 'Filho' else 'ND' end) filiacao 
				
FROM OINV t0
	 INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry] 
where 
	DocDueDate between '01-04-2017' and '30-04-2017' 
	--AND [U_FLX_IdFatSIGEM] = 2081583
group by 
    [U_FLX_IdFatSIGEM],DocStatus,BPLId,DocTotal,PaidToDate
	
	) as tt
	
group by [U_FLX_IdFatSIGEM],filiacao,DocStatus

) as fim
 where Valor <> 'ND'

 ORDER BY U_FLX_IdFatSIGEM 
 
 
 -- MANUAL ---
 
 select DISTINCT [U_FLX_IdFatSIGEM],Valor from (

select  TOP 100 PERCENT 
 
[U_FLX_IdFatSIGEM],filiacao,
     (CASE 
		     when DocStatus = 'O' and 
				  LAG(DocStatus) OVER(ORDER BY [U_FLX_IdFatSIGEM]) = 'C' and
				  [U_FLX_IdFatSIGEM] = LAG([U_FLX_IdFatSIGEM]) OVER(ORDER BY [U_FLX_IdFatSIGEM])
		      then  'NOTAS COM STATUS DIVERGENTES'

			  when DocStatus = 'C' and 
				  LEAD(DocStatus) OVER(ORDER BY [U_FLX_IdFatSIGEM]) = 'O' and
				 [U_FLX_IdFatSIGEM] = LEAD([U_FLX_IdFatSIGEM]) OVER(ORDER BY [U_FLX_IdFatSIGEM])
		      then  'NOTAS COM STATUS DIVERGENTES'

         else 'ND' end) Valor

from(
select DISTINCT T0.[DocEntry],
				t0.[U_FLX_IdFatSIGEM], 
				DocStatus = (case when t0.DocTotal =t0.PaidToDate then 'C' when t0.PaidToDate = 0 then 'O' when (t0.DocTotal <>t0.PaidToDate and t0.PaidToDate > 0 ) then 'P' else 'ND' end ),
				(case when t0.BPLId=1 then 'Pai' when t0.BPLId<>1 then 'Filho' else 'ND' end) filiacao 
				
FROM OINV t0
	 INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry] 
	 
where 
	t0.DocDueDate between '01-01-2016' and '28-02-2018'
	and t0.	UserSign2 <> '1' 
group by 
    t0.[U_FLX_IdFatSIGEM],t0.DocStatus,t0.BPLId,t0.DocTotal,t0.PaidToDate,T0.[DocEntry]

	) as tt
	
group by [U_FLX_IdFatSIGEM],filiacao,DocStatus

) as fim
 where Valor <> 'ND'

 ORDER BY U_FLX_IdFatSIGEM 
