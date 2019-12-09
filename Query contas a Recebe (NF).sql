DECLARE @DATAINI DATE, @DATAFIM DATE
SET @DATAINI ={?dataini}
SET @DATAFIM ={?datafin}

--VÃO APARECER NO RELATORIO

SELECT
[COD.Cliente],
[NOMECliente],
[NF],
[NFSTATUS],
[NFDATAVENC],
[NFDATALANC],
[VALORTOTAL],
[COD.FILIAL],
[NOMEFILIAL],
[OBSERVACAO],
[DUPLICATA],
[SALDO] = CASE WHEN [SALDO] > [VALORTOTAL] THEN [VALORTOTAL] - [SALDO]
		  ELSE [SALDO] END

FROM (
SELECT DISTINCT * FROM(

-- NOTAS EM ABERTO QUE NÃO TEM CONTAS A RECEBER
SELECT
--[DONO] = 1, 
[COD.Cliente] = T1.CardCode,
[NOMECliente] = T1.CardName,
[NF] = T0.DocEntry,
[NFSTATUS] = T0.DocStatus,
--[CR] = T3.DocEntry,
--[CRLANCDATA] = T3.DocDate,
--[CRLANCCANCELADA] = T3.CancelDate,
[NFDATAVENC] = T0.DocDueDate, 
[NFDATALANC] = T0.DocDate,
[VALORTOTAL] = T0.DocTotal,
[COD.FILIAL] = T0.BPLId,
[NOMEFILIAL] = T0.BPLName,
[OBSERVACAO] = NULL,
[DUPLICATA] = 'SAIDA NF - '+ CAST((SELECT H.Serial FROM OINV H WHERE H.[DocEntry] = T0.[DocEntry]) AS nvarchar(50)),
[SALDO]  = CASE WHEN  T0.PaidToDate = 0 THEN  T0.DocTotal 
				WHEN  T0.PaidToDate <> 0 THEN  T0.DocTotal 
	ELSE  T0.DocTotal - T0.PaidToDate END

FROM 
OINV T0
INNER JOIN OCRD T1 ON T0.[CardCode] = T1.[CardCode]

WHERE 
T0.CANCELED = 'N'
AND T0.DocDate >= @DATAINI
AND T0.DocDate <= @DATAFIM
AND T0.DocStatus = 'O'
AND NOT EXISTS (SELECT DocEntry FROM RCT2 X2 WHERE T0.[DocEntry] = X2.[DocEntry] AND X2.InvType = 13)

AND T0.BPLId {?Filial@SELECT DISTINCT BPLId, BPLName FROM OBPL WHERE Disabled = 'N' order by BPLName}

UNION ALL

-- NOTAS EM ABERTO QUE TEM CONTAS A RECEBER

SELECT
--[DONO] = 2, 
[COD.Cliente] = T1.CardCode,
[NOMECliente] = T1.CardName,
[NF] = T0.DocEntry,
[NFSTATUS] = T0.DocStatus,
--[CR] = T3.DocEntry,
--[CRLANCDATA] = T3.DocDate,
--[CRLANCCANCELADA] = T3.CancelDate,
[NFDATAVENC] = T0.DocDueDate, 
[NFDATALANC] = T0.DocDate,
[VALORTOTAL] = T0.DocTotal,
[COD.FILIAL] = T0.BPLId,
[NOMEFILIAL] = T0.BPLName,
[OBSERVACAO] = NULL,
[DUPLICATA] = 'SAIDA NF - '+ CAST((SELECT H.Serial FROM OINV H WHERE H.[DocEntry] = T0.[DocEntry]) AS nvarchar(50)),
[SALDO]  = (SELECT SUM(INTERNO) FROM (
		-- Não CANCELADOS
		SELECT T0.DocTotal -sum (tod.valor)INTERNO FROM (
		SELECT case 
					WHEN X3.Canceled = 'N' AND X3.DocDate <= @DATAFIM THEN sum(X2.SumApplied)  
					WHEN X3.Canceled = 'N' AND X3.DocDate >= @DATAFIM THEN 0
					END as valor
		FROM 
		OINV X0
		INNER JOIN OCRD X1 ON X0.[CardCode] = X1.[CardCode]
		LEFT JOIN RCT2 X2 ON X0.[DocEntry] = X2.[DocEntry]  AND X2.InvType = 13
		LEFT JOIN ORCT X3 ON X3.[DocEntry] = X2.[DocNum]

		WHERE X0.DOCENTRY = T0.DocEntry
		GROUP BY X3.Canceled ,X3.CancelDate,X0.DOCENTRY,X2.SumApplied,X0.DOCTOTAL,X3.DocDate)tod

	--#########################################################################################
	UNION ALL
		-- CANCELADOS ATÉ A DATA
		SELECT T0.DocTotal - sum (tod2.valor) INTERNO FROM (
		SELECT case  
			
				WHEN X3.Canceled = 'Y' AND X3.CancelDate <= @DATAFIM AND X0.DocTotal = X2.SumApplied THEN 0
				WHEN X3.Canceled = 'Y' AND X3.CancelDate <= @DATAFIM AND X0.DocTotal <> X2.SumApplied THEN sum(X2.SumApplied) 
				END as valor
			
		FROM 
		OINV X0
		INNER JOIN OCRD X1 ON X0.[CardCode] = X1.[CardCode]
		LEFT JOIN RCT2 X2 ON X0.[DocEntry] = X2.[DocEntry]  AND X2.InvType = 13
		LEFT JOIN ORCT X3 ON X3.[DocEntry] = X2.[DocNum]

		WHERE X0.DOCENTRY = T0.DocEntry
		
		GROUP BY X3.Canceled ,X3.CancelDate,X0.DOCENTRY,X2.SumApplied,X0.DOCTOTAL,X3.DocDate)tod2

	--#########################################################################################
	UNION ALL
	-- CANCELADOS APÓS A DATA 
		SELECT T0.DocTotal -sum (tod3.valor)INTERNO FROM (
		SELECT case  
			
					WHEN X3.Canceled = 'Y' AND X3.CancelDate >= @DATAFIM AND X0.DocTotal = X2.SumApplied AND X3.DocDate <=@DATAFIM THEN sum(X2.SumApplied)  
					WHEN X3.Canceled = 'Y' AND X3.CancelDate >= @DATAFIM AND X3.DocDate <=@DATAFIM AND X0.DocTotal <> X2.SumApplied  THEN sum(X2.SumApplied) 
					END as valor
			
		FROM 
		OINV X0
		INNER JOIN OCRD X1 ON X0.[CardCode] = X1.[CardCode]
		LEFT JOIN RCT2 X2 ON X0.[DocEntry] = X2.[DocEntry]  AND X2.InvType = 13
		LEFT JOIN ORCT X3 ON X3.[DocEntry] = X2.[DocNum]

		WHERE X0.DOCENTRY = T0.DocEntry
		
		GROUP BY X3.Canceled ,X3.CancelDate,X0.DOCENTRY,X2.SumApplied,X0.DOCTOTAL,X3.DocDate)tod3

	--#########################################################################################

	)SOMASALDO)

FROM 
OINV T0
INNER JOIN OCRD T1 ON T0.[CardCode] = T1.[CardCode]
LEFT JOIN RCT2 T2 ON T0.[DocEntry] = T2.[DocEntry]  AND T2.InvType = 13
LEFT JOIN ORCT T3 ON T3.[DocEntry] = T2.[DocNum] --AND T3.DocDate > @DATAFIM
WHERE 
T0.CANCELED = 'N'
AND T0.DocDate >= @DATAINI
AND T0.DocDate <= @DATAFIM
AND T0.DocStatus = 'O'
AND T3.DocEntry IS NOT NULL

AND T0.BPLId in {?Filial@SELECT DISTINCT BPLId, BPLName FROM OBPL WHERE Disabled = 'N' order by BPLName}



UNION ALL

-- NOTAS FECHADAS
SELECT 
--[DONO] = 3,
[COD.Cliente] = T1.CardCode,
[NOMECliente] = T1.CardName,
[NF] = T0.DocEntry,
[NFSTATUS] = T0.DocStatus,
--[CR] = T3.DocEntry,
--[CRLANCDATA] = T3.DocDate,
--[CRLANCCANCELADA] = T3.CancelDate,
[NFDATAVENC] = T0.DocDueDate, 
[NFDATALANC] = T0.DocDate,
[VALORTOTAL] = T0.DocTotal,
[COD.FILIAL] = T0.BPLId,
[NOMEFILIAL] = T0.BPLName,
[OBSERVACAO] = T3.JrnlMemo,
[DUPLICATA] = 'SAIDA NF - '+ CAST((SELECT H.Serial FROM OINV H WHERE H.[DocEntry] = T0.[DocEntry]) AS nvarchar(50)),
[SALDO]  = (SELECT SUM(INTERNO) FROM (
		-- Não CANCELADOS
		SELECT T0.DocTotal -sum (tod.valor)INTERNO FROM (
		SELECT case 
					WHEN X3.Canceled = 'N' AND X3.DocDate <= @DATAFIM THEN sum(X2.SumApplied)  
					WHEN X3.Canceled = 'N' AND X3.DocDate >= @DATAFIM THEN 0
					END as valor
		FROM 
		OINV X0
		INNER JOIN OCRD X1 ON X0.[CardCode] = X1.[CardCode]
		LEFT JOIN RCT2 X2 ON X0.[DocEntry] = X2.[DocEntry]  AND X2.InvType = 13
		LEFT JOIN ORCT X3 ON X3.[DocEntry] = X2.[DocNum]

		WHERE X0.DOCENTRY = T0.DocEntry
		
		GROUP BY X3.Canceled ,X3.CancelDate,X0.DOCENTRY,X2.SumApplied,X0.DOCTOTAL,X3.DocDate)tod

	--#########################################################################################
	UNION ALL
		-- CANCELADOS ATÉ A DATA
		SELECT T0.DocTotal - sum (tod2.valor) INTERNO FROM (
		SELECT case  
			
				WHEN X3.Canceled = 'Y' AND X3.CancelDate <= @DATAFIM AND X0.DocTotal = X2.SumApplied THEN 0
				WHEN X3.Canceled = 'Y' AND X3.CancelDate <= @DATAFIM AND X0.DocTotal <> X2.SumApplied THEN sum(X2.SumApplied) 
				END as valor
			
		FROM 
		OINV X0
		INNER JOIN OCRD X1 ON X0.[CardCode] = X1.[CardCode]
		LEFT JOIN RCT2 X2 ON X0.[DocEntry] = X2.[DocEntry]  AND X2.InvType = 13
		LEFT JOIN ORCT X3 ON X3.[DocEntry] = X2.[DocNum]

		WHERE X0.DOCENTRY = T0.DocEntry
		
		GROUP BY X3.Canceled ,X3.CancelDate,X0.DOCENTRY,X2.SumApplied,X0.DOCTOTAL,X3.DocDate)tod2

	--#########################################################################################
	UNION ALL
	-- CANCELADOS APÓS A DATA 
		SELECT T0.DocTotal -sum (tod3.valor)INTERNO FROM (
		SELECT case  
			
					WHEN X3.Canceled = 'Y' AND X3.CancelDate >= @DATAFIM AND X0.DocTotal = X2.SumApplied AND X3.DocDate <=@DATAFIM THEN sum(X2.SumApplied)  
					WHEN X3.Canceled = 'Y' AND X3.CancelDate >= @DATAFIM AND X3.DocDate <=@DATAFIM AND X0.DocTotal <> X2.SumApplied  THEN sum(X2.SumApplied) 
					END as valor
			
		FROM 
		OINV X0
		INNER JOIN OCRD X1 ON X0.[CardCode] = X1.[CardCode]
		LEFT JOIN RCT2 X2 ON X0.[DocEntry] = X2.[DocEntry]  AND X2.InvType = 13
		LEFT JOIN ORCT X3 ON X3.[DocEntry] = X2.[DocNum]

		WHERE X0.DOCENTRY = T0.DocEntry
		
		GROUP BY X3.Canceled ,X3.CancelDate,X0.DOCENTRY,X2.SumApplied,X0.DOCTOTAL,X3.DocDate)tod3

	--#########################################################################################

	)SOMASALDO2)

FROM 
OINV T0
INNER JOIN OCRD T1 ON T0.[CardCode] = T1.[CardCode]
INNER JOIN RCT2 T2 ON T0.[DocEntry] = T2.[DocEntry]  
INNER JOIN ORCT T3 ON T3.[DocEntry] = T2.[DocNum] AND T3.DocDate > @DATAFIM
WHERE 
T0.CANCELED = 'N'
AND T0.DocDate >= @DATAINI
AND T0.DocDate <= @DATAFIM
AND T0.DocStatus = 'C'
AND T2.InvType = 13
AND T0.BPLId in (6){?Filial@SELECT DISTINCT BPLId, BPLName FROM OBPL WHERE Disabled = 'N' order by BPLName}
) todos 
)COMPARA