
-- Resumo de Apuração PIS/COFINS por Filial(Analítico)

SELECT [Filial] = T0.[BPLName], 
[BaseCalculo] = SUM(T1.[BaseSum]), 
[ContaImposto] = T1.[TaxAcct], 
[ContaDespesa] = T1.[TaxExpAct], 
[TaxaImposto] = T1.[TaxRate], 
[TotalImposto] = SUM(T1.[TaxSum]), 
[ValorImpostoSemArred] = SUM(T1.[BaseSum])*(T1.[TaxRate]/100),
[TipoImposto] = (CASE WHEN T1.[staType]= 19 THEN 'PIS' ELSE 'COFINS' END)
FROM OINV T0  INNER JOIN INV4 T1 ON T0.[DocEntry] = T1.[DocEntry] 
WHERE T0.[CANCELED] = 'N' 
AND  T0.[DocDate]  >= {?@DateInicio}
AND  T0.[DocDate] <= {?@DateFim}
AND T1.[staType] IN  {?@Imposto}
GROUP BY T0.[BPLName], T1.[DocEntry], T1.[staType], T1.[TaxAcct], T1.[TaxExpAct], T1.[TaxRate], T0.[DocDate]
order by  T0.[DocDate]



/*
Filial@SELECT DISTINCT BPLName FROM ABPL WHERE Disabled = 'N'

ContaDeDespesa@SELECT T0.[APExpAct],T0.[Name] FROM OSTA T0 WHERE T0.[Type] in (19,21)

**********************************

(not HasValue({?Filial@SELECT DISTINCT BPLName FROM ABPL WHERE Disabled = 'N'}) OR {Comando.Filial} = {?Filial@SELECT DISTINCT BPLName FROM ABPL WHERE Disabled = 'N'})


(not HasValue({?ContaDeDespesa@SELECT T0.[APExpAct],T0.[Name] FROM OSTA T0 WHERE T0.[Type] in (19,21)}) OR {Comando.Filial} = {?ContaDeDespesa@SELECT T0.[APExpAct],T0.[Name] FROM OSTA T0 WHERE T0.[Type] in (19,21)})


(not HasValue({?CardCode@SELECT * FROM OCRD} or ))

CardCode@SELECT * FROM OCRD

*/



/*BRISANET SERVICOS DE TELECOMUNICACOES LTDA
INTERSERVICE - SERVICOS DE ELABORACAO DE DADOS LTDA - ME
310201.0004
310201.0010
1345404


*/



