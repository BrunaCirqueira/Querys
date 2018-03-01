SELECT [Conta Contabil] = T0.[AcctCode], 
[Conta Nome] = T0.[AcctName],
T1.[ShortName],
T4.[CardCode], 
[Data de Vencimento] = T1.[DueDate], 
 T6.[DocNum],
T5.[CardName],

	[Duplicata] = 
	CASE  
			 WHEN cast(T6.Installmnt as nvarchar(20)) IS NOT NULL THEN 'NF ENTRADA'+' '+ 
				  cast(T6.serial as nvarchar(20)) + ' - ' + cast(T3.InstId as nvarchar(20)) + '/' + cast(T6.Installmnt  as nvarchar(20))
		ELSE 'LC - ' + cast(T3.DocTransId as nvarchar(20))	  END,	  
	[Total da Parcela] =
		CASE
			WHEN CAST(T6.Installmnt as nvarchar(20)) IS NOT NULL THEN T8.LineTotal
			ELSE T3.SumApplied
		END,
	[Valor Pago]=
		CASE
			WHEN (SELECT COUNT(1) FROM VPM2 WHERE DocNum = T3.DocNum) = 1 THEN T4.DocTotal
			WHEN CAST(T6.Installmnt as nvarchar(20)) IS NOT NULL THEN T3.SumApplied
			ELSE T3.SumApplied
		END,
	[Saldo] =
		CASE
			WHEN (SELECT COUNT(1) FROM VPM2 WHERE DocNum = T3.DocNum) = 1 THEN (T3.SumApplied - T4.DocTotal)
			WHEN CAST(T6.Installmnt as nvarchar(20)) IS NOT NULL THEN (T3.SumApplied - T4.DocTotal)
			ELSE T1.BalScDeb
		END,
	[Observacoes] =  T1.LineMemo + ' ' + T1.Ref2,

                [DuplicataLink] = 
	                 CASE  
			 WHEN cast(T6.Installmnt as nvarchar(20)) IS NOT NULL THEN cast(T6.DocEntry as nvarchar(20)) 
                                                 ELSE cast(T2.TransId as nvarchar(20))	  END,
            [DuplicataTeste] = 
	                CASE  
			 WHEN cast(T6.Installmnt as nvarchar(20)) IS NOT NULL THEN 'NF'
		ELSE 'LC' END
	 
FROM OACT T0  INNER JOIN JDT1 T1 ON T0.[AcctCode] = T1.[Account]
INNER JOIN OJDT T2 ON T1.[TransId] = T2.[TransId]
INNER JOIN VPM2 T3 ON T2.[TransId] = T3.[DocTransId] 
INNER JOIN OVPM T4 ON T3.[DocNum] = T4.[DocEntry]
INNER JOIN OCRD T5 ON T4.[CardCode] = T5.[CardCode] 
LEFT JOIN OPCH T6 ON T3.[DocEntry] = T6.[DocNum] AND T3.InvType = 18 
LEFT JOIN PCH6 T7 ON T6.[DocEntry] = T7.[DocEntry] 
LEFT JOIN PCH1 T8 ON T6.[DocEntry] = T8.[DocEntry]
WHERE 
--T1.MthDate IS NOT NULL  AND
T1.DebCred = 'D' AND
T4.[JrnlMemo] <> 'Cancelado'  AND
T5.[CardType] = 'S' AND
(T1.DueDate BETWEEN {?DataIni}  AND {?DataFin} )
ORDER BY T1.TransId DESC