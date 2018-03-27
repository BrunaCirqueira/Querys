SELECT
        DISTINCT T0.[DocEntry],
        T0.[DocDate],
        T0.[CardCode],
        T2.[CardName],
        T1.[CreditAcct],
        T1.[VoucherNum],
        T0.[BPLId],
        [Conta] = (SELECT TOP 1 
								X3.[AcctName] 
				   FROM 
								OJDT X0 
								INNER JOIN JDT1 X1 ON X0.[TransId] = X1.[TransId] 
								INNER JOIN VPM2 X2 ON X0.[TransId] = X2.[DocTransId] 
								INNER JOIN OACT X3 ON X1.[Account] = X3.[AcctCode] 
				    WHERE 
								X2.[DocNum] = T0.[DocEntry] AND 
								X3.[ActType] = 'E'),
        [Centro de Custo] =  (SELECT TOP 1 
										X3.[OcrName] 
							  FROM 
										OJDT X0 
										INNER JOIN JDT1 X1 ON X0.[TransId] = X1.[TransId] 
										INNER JOIN VPM2 X2 ON X0.[TransId] = X2.[DocTransId] 
										INNER JOIN OOCR X3 ON X1.[OcrCode2] = X3.[OcrCode] 
							  WHERE 
										X2.[DocNum] = T0.[DocEntry] 
								   ),
        T0.[DocTotal]
FROM
        OVPM T0
        INNER JOIN VPM3 T1 ON T0.[DocEntry] = T1.[DocNum]
        INNER JOIN OCRC T2 ON T1.[CreditCard] = T2.[CreditCard]
        INNER JOIN OJDT T3 ON T0.[DocEntry] = T3.[BaseRef]
WHERE
        
        T0.[DocDate] >= {?DataIni}
        AND T0.[DocDate] <= {?DataFim}
        AND T0.[Canceled] = 'N'
ORDER BY
        T1.[VoucherNum] ASC