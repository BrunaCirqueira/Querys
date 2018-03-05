select  A.[Cidade],A.[Item],A.[Filial],

[Pessoa] = A.[Pessoa],

[TotalL Pessoa] =sum(A.[TotalL Pessoa_]),

[Total Faturado] =SUM(A.[Total Faturado_]),

[Ticket] =SUM(A.[Total Faturado_])/sum(A.[TotalL Pessoa_])


from (SELECT
[Cidade] =  case when (SELECT top 1 T6.NAME  FROM  CRD1 T5  INNER JOIN OCNT T6 on T5.[County] =T6.[AbsId]  WHERE T0.[CardCode] = T5.[CardCode]) is null then T4.cityS else (SELECT top 1 T6.NAME  FROM  CRD1 T5  INNER JOIN OCNT T6 on T5.[County] =T6.[AbsId]  WHERE T0.[CardCode] = T5.[CardCode]) End,

[Filial] = T1.[BPLName], 

[Item] = T3.[FrgnName],

[Pessoa] = (CASE WHEN T0.[U_FLX_Usage] = 15 THEN 'PF' WHEN T0.[U_FLX_Usage] = 16 THEN 'PJ' ELSE null END),

[TotalL Pessoa_] =COUNT(CASE WHEN T0.[U_FLX_Usage] =15  THEN 1 WHEN T0.[U_FLX_Usage] =16  THEN 1 ELSE 0 END),

[Total Faturado_] =SUM(CASE WHEN T0.[U_FLX_Usage] in (15,16) THEN T2.[LineTotal] ELSE NULL END)--,

--[Ticket_] =SUM(CASE WHEN T0.[U_FLX_Usage]  in (15,16) THEN [LineTotal] ELSE null END)/COUNT(CASE WHEN T0.[U_FLX_Usage] in (15,16) THEN 1 ELSE null END)
         
FROM 

	OCRD T0 
	INNER JOIN OINV T1 ON T0.[CardCode] = T1.[CardCode] 
	INNER JOIN INV1 T2 ON T1.[DocEntry] = T2.[DocEntry] 
	INNER JOIN OITM T3 ON T2.[ItemCode] = T3.[ItemCode] 
	INNER JOIN INV12 T4 ON T1.[DocEntry] = T4.[DocEntry]

	
WHERE 
	T1.[DocDate] >=  {?dataini}
	AND  T1.[DocDate] <=  {?datafin}
	AND  T1.[CANCELED] = 'N' 
	AND T1.[BPLId] <> 1 
	AND  T0.[U_FLX_Usage] IN (15,16)
GROUP BY 
	T3.[FrgnName], T1.[BPLName],T0.[U_FLX_Usage],T0.[CardCode],T4.[COUNTY],T4.cityS
) as A
GROUP BY A.[Cidade],A.[Item], A.[Pessoa],A.[Filial]
order by A.[Cidade],A.[Item]


--(not HasValue({?Filial@SELECT DISTINCT BPLName FROM ABPL WHERE Disabled = 'N'}) OR {Comando.Filial} = {?Filial@SELECT DISTINCT BPLName FROM ABPL WHERE Disabled = 'N'})


