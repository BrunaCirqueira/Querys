--select teste, [U_FLX_IdFatSIGEM],TransId,hah
--from (
--select  COUNT(T0.[DocEntry]) over (PARTITION BY [U_FLX_IdFatSIGEM]) teste,count (t1.ItemCode) hah,[U_FLX_IdFatSIGEM], TransId FROM OINV t0
--INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry] 
--where DocDueDate between '01-04-2017' and '30-04-2017' and itemcode <> '1000029'
----and [U_FLX_IdFatSIGEM] =  2356376-- 2267474
--and t1.itemcode not in ('0800124','0800123','0800122','0800188')
--group by [U_FLX_IdFatSIGEM],T0.[DocEntry],TransId) as t
--group by  teste, [U_FLX_IdFatSIGEM],TransId,hah

--having teste=1 and hah>1


---- ADD TAble OITM para tirar os itens pai

--use SBO_GERENCIADORA_PRODUCAO
--select 
--	Documentos, 
--	[U_FLX_IdFatSIGEM],
--	TransId,
--	Itens,
--	DocTotal,
--	docdate
--from (
--		select  
--				COUNT(T0.[DocEntry]) over (PARTITION BY [U_FLX_IdFatSIGEM]) 'Documentos',
--				count (t1.ItemCode) 'Itens',
--				t0.[U_FLX_IdFatSIGEM], 
--				t0.TransId,
--				t0.DocTotal,
--				t0.docdate 
--		FROM 
--				OINV t0
--				INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry] 
--				INNER JOIN OITM T2 on t1.ItemCode = t2.ItemCode and t2.TreeType = 'N'
--		where 
--				t0.DocDate between '01-03-2018' and '31-03-2018' 
--				and t1.itemcode not in ('1000029','0800124','0800123','0800122','0800188')
--				and t1.[LineTotal] > 0
--				and t0.CANCELED = 'N'
--		group by
--				t0.[U_FLX_IdFatSIGEM],
--				T0.[DocEntry],
--				t0.TransId,
--				t0.docdate,
--				t0.DocTotal
--	 ) as t

--group by  
--		Documentos, 
--		[U_FLX_IdFatSIGEM],
--		TransId,
--		Itens,
--		docdate,
--		DocTotal


--having Documentos=1 and Itens>1 and TransId>1
--order by [U_FLX_IdFatSIGEM]



----************* TODAS QUE DIFEREM ***********----------

SELECT SUM(GERENCIADORA)GERENCIADORA,SUM(OUTRAS) OUTRAS,U_FLX_IdFatSIGEM 
FROM (

		SELECT 
				COUNT(*)  'GERENCIADORA',
				[OUTRAS] = 0,
				U_FLX_IdFatSIGEM
		FROM 
				OINV T0  
				INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry]
		where 
				T1.TreeType <> 's'  AND T0.CANCELED = 'N'
				AND t0.DocDate between '01-06-2018' and '30-06-2018' 
				AND T0.BPLId = 1  and T1.LineTotal>0  GROUP BY U_FLX_IdFatSIGEM

UNION 

		SELECT 
				[GERENCIADORA] = 0,
				COUNT(*)  'OUTRAS',
				U_FLX_IdFatSIGEM
		from 
				OINV T0  
				INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry]
		where 
				T1.TreeType <> 's' AND T0.CANCELED = 'N'
				AND t0.DocDate between '01-06-2018' and '30-06-2018' 
				AND T0.BPLId <> 1 
				AND U_FLX_IdFatSIGEM > 0
		GROUP BY 
				U_FLX_IdFatSIGEM) DIFERENCA


GROUP BY U_FLX_IdFatSIGEM
HAVING SUM(GERENCIADORA) > SUM(OUTRAS)
------------------------------------------------------------------
--SELECT SUM(GERENCIADORA)GERENCIADORA,SUM(OUTRAS) OUTRAS,U_FLX_IdFatSIGEM ,ItemCode,Dscription
--FROM (

--		SELECT 
--				COUNT(*)  'GERENCIADORA',
--				[OUTRAS] = 0,
--				U_FLX_IdFatSIGEM,T1.ItemCode,T1.Dscription
--		FROM 
--				OINV T0  
--				INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry]
--		where 
--				T1.TreeType <> 's'  AND T0.CANCELED = 'N'
--				AND t0.DocDate between '01-06-2018' and '30-06-2018' 
--				AND T0.BPLId = 1  and T1.LineTotal>0 
--				AND U_FLX_IdFatSIGEM >0
--			    GROUP BY U_FLX_IdFatSIGEM,T1.ItemCode,T1.Dscription

--UNION 

--		SELECT 
--				[GERENCIADORA] = 0,
--				COUNT(*)  'OUTRAS',
--				U_FLX_IdFatSIGEM,T1.ItemCode,T1.Dscription
--		from 
--				OINV T0  
--				INNER JOIN INV1 T1 ON T0.[DocEntry] = T1.[DocEntry]
--		where 
--				T1.TreeType <> 's' AND T0.CANCELED = 'N'
--				AND t0.DocDate between '01-06-2018' and '30-06-2018' 
--				AND T0.BPLId <> 1 
--				AND U_FLX_IdFatSIGEM >0
--		GROUP BY 
--				U_FLX_IdFatSIGEM,T1.ItemCode,T1.Dscription
--				) DIFERENCA


--GROUP BY U_FLX_IdFatSIGEM,ItemCode,Dscription
--HAVING SUM(GERENCIADORA) > SUM(OUTRAS) --AND SUM(OUTRAS)>0
--ORDER BY U_FLX_IdFatSIGEM

	