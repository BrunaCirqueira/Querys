SELECT 
AcctCode,
AcctName,
[Receita] =SUM(LineTotal),
[BaseCalculo] =SUM(BaseSum),
[Aliquota],
[BPLId],
[BPLName],[staType]
FROM
(
SELECT 
T3.[AcctCode],
T3.[AcctName],
T2.[LineTotal],
T0.[BaseSum], -- 1 = cumulativo  2 = não cumulativo 0 = outras
[Aliquota] = case when T0.TaxRate in (0.65,3) and t3.AcctCode <> '310401.0001' then 1  when T0.TaxRate in (1.65,7.6,4) or t3.AcctCode = '310401.0001' THEN 2  else 0 end,
T1.[BPLId],T1.[BPLName],
[staType] = case when T0.[staType] = 19  then 'PIS'  when T0.[staType] = 21  then 'COFINS'  else 'OUTRAS' end
FROM
INV4 T0
INNER JOIN OINV T1 ON T0.[DocEntry] = T1.[DocEntry]
INNER JOIN INV1 T2 ON T0.[DocEntry] = T2.[DocEntry] AND T0.[LineNum] = T2.[LineNum]
INNER JOIN OACT T3 ON T2.[AcctCode] = T3.[AcctCode]
WHERE
T1.[CANCELED] = 'N'
AND T1.[DocDate] BETWEEN '20180101' AND '20180228'
AND T0.[staType] IN (19,21)
AND T1.[BPLId] = 4)dt
GROUP BY
[BPLId],
[BPLName],
AcctCode,
AcctName,
[Aliquota],[staType]