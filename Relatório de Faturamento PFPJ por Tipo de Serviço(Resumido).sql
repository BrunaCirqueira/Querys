SELECT
	[Cidade] = (CASE WHEN T4.[CityS] IS NULL THEN T5.[City] ELSE T4.[CityS] END),
	[Filial] = T1.[BPLName], 
	[Item] = T3.[FrgnName],
	[Pessoa] = (CASE WHEN T0.[U_FLX_Usage] = 15 THEN 'PF' WHEN T0.[U_FLX_Usage] = 16 THEN 'PJ' ELSE null END),
	[TotalL Pessoa] =COUNT(CASE WHEN T0.[U_FLX_Usage] =15  THEN 1 WHEN T0.[U_FLX_Usage] =16  THEN 1 ELSE 0 END), 
	[Total Faturado] =SUM(CASE WHEN T0.[U_FLX_Usage] in (15,16) THEN T2.[LineTotal] ELSE NULL END),
	[Ticket] =SUM(CASE WHEN T0.[U_FLX_Usage]  in (15,16) THEN [LineTotal] ELSE null END)/COUNT(CASE WHEN T0.[U_FLX_Usage] in (15,16) THEN 1 ELSE null END) 
FROM 

	OCRD T0 
	INNER JOIN OINV T1 ON T0.[CardCode] = T1.[CardCode] 
	INNER JOIN INV1 T2 ON T1.[DocEntry] = T2.[DocEntry] 
	INNER JOIN OITM T3 ON T2.[ItemCode] = T3.[ItemCode] 
	INNER JOIN INV12 T4 ON T1.[DocEntry] = T4.[DocEntry]
	INNER JOIN CRD1 T5 ON T0.[CardCode] = T5.[CardCode]
WHERE 
	T1.[DocDate] >=   {?dataini}
	AND  T1.[DocDate] <=   {?datafin} 
	AND  T1.[CANCELED] = 'N' 
	AND T1.[BPLId] <> 1 
	AND  T0.[U_FLX_Usage] IN (15,16)
GROUP BY 
	T3.[FrgnName], T1.[BPLName],T0.[U_FLX_Usage],T1.[BPLName],T4.[CityS],T5.[City]
order by 
	T3.[FrgnName]


--(not HasValue({?Filial@SELECT DISTINCT BPLName FROM ABPL WHERE Disabled = 'N'}) OR {Comando.Filial} = {?Filial@SELECT DISTINCT BPLName FROM ABPL WHERE Disabled = 'N'})


