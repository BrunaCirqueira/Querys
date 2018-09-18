SELECT  DISTINCT
             [User] = T5.U_NAME,
             [NFE] = T3.DocEntry,
             [NContasReceber] = T3.PayDocEntry,
             [NossoNumero] = T3.Ournumber,
             [Status] = T3.Status,
             [MeioPagamento] = T3.[PayMethodCode],
             [DtEmis] = T3.DocDate,
             [DtVenc] = T3.[DueDate],
             [Data de Compensação] = (SELECT TOP 1 A.CreditDate FROM IntegrationBank..ReturnBankOcurrence A  WHERE A.BillOfExchange = T3.ID
                                 AND A.Status = 4 AND A.DocType IS NOT NULL AND A.DocEntry IS NOT NULL),
             [VlBoleto] = T3.InstallmentValue,
            [Ponto Pgto] = Convert(Numeric(10,0),Ltrim(REPLACE(RIGHT(T4.Dscription, CHARINDEX(' ',T4.Dscription)-0),'-','') ))
    
FROM
             SBO_GERENCIADORA_PRODUCAO..ORCT T0
             INNER JOIN SBO_GERENCIADORA_PRODUCAO..RCT2 T1 ON T0.[DocEntry] = T1.[DocNum]
             INNER JOIN SBO_GERENCIADORA_PRODUCAO..OINV T2 ON T1.[baseAbs] = T2.[DocNum]
             INNER JOIN IntegrationBank..BillOfExchange T3 on T2.DocNum = T3.DocEntry
             INNER JOIN SBO_GERENCIADORA_PRODUCAO..INV1 T4 ON T2.[DocEntry] = T4.[DocEntry]
             INNER JOIN SBO_GERENCIADORA_PRODUCAO..OUSR T5 ON T2.UserSign = T5.USERID


WHERE
             T3.DocDate >='02-07-2018'
             AND  T3.DocDate <='02-07-2018'
             AND T3.Situation = 1
             AND T3.Status = 4
            AND T4.ItemCode IS NULL


ORDER BY
             T3.[DueDate] ASC