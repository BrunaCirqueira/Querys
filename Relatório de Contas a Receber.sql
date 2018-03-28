SELECT DISTINCT
	[Data] = T0.[DocDate], 
	[NFS] =T0.[DocNum], 
	[Codigo Cliente] = T4.[CardCode], 
	[Nome Cliente] =T4.[CardName], 
	[Codigo Filial] =T0.[BPLId], 
	[Nome Filial] =T0.[BPLName], 
	[Status] = T0.[DocStatus], 
	[Total] = T0.[DocTotal],
	[Cancelado] = T0.[CANCELED],
	[ID Sigem] = T4.[U_FLX_IdClienteSIGEM], 
	[Fatura Sigem] = T0.[U_FLX_NumFaturaSIGEM]

FROM 
	OINV  T0 
	LEFT JOIN  RCT2  T1  ON T0.[DocNum] = T1.[DocEntry]
    LEFT JOIN [dbo].[ORCT]  T2 ON T1.[DocNum] = T2.[DocEntry] AND T2.[Canceled] = 'N'
    INNER JOIN [dbo].[OJDT]  T3 ON T0.[TransId] = T3.[TransId] 
	INNER JOIN OCRD T4 ON T0.[CardCode] = T4.[CardCode]
WHERE 
	T0.[DocDate] >={?DataIni}
	AND T0.[DocDate] <={?DataFim}
	
ORDER BY  
	T0.[DocNum]