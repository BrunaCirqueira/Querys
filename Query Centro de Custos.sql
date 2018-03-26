SELECT  DISTINCT
               
                [Modelo] =  T3.[AbsId], 
                [Dimensao] =  T2.[DimCode],
                [CodCentro] =   T0.[OcrCode], 
                [NomeCentro] =   T0.[OcrName],
                [NumeroTrans] =   T1.[TransId],
                [ContaContabil] =   T1.[Account],
                [Valor] = T1.[Debit], 
                [OrigemTrans] =  T1.[TransType],
                [NomeContaContabi] = T4.[AcctName]

               
FROM
              
                OOCR T0  -- Centros de Custos 
                INNER JOIN JDT1 T1 ON T0.[OcrCode] = T1.[OcrCode2] -- Linhas Lançamento Contabil
                INNER JOIN ODIM T2 ON T0.[DimCode] = T2.[DimCode] --Dimenção
                INNER JOIN OFRT T3 ON T2.[DimCode] = T3.[DimCode] -- Modelo
                INNER JOIN OACT T4 ON T1.[Account] = T4.[AcctCode] -- Conta Contabil
			 

WHERE 
                T2.[DimCode] = {?dimensao}  AND  
                T3.[AbsId] = {?modelo}  AND
                T1.[RefDate] BETWEEN {?dateini} AND {?datefin}  AND
                T1.[OcrCode2] IS NOT NULL AND T1.[OcrCode2] <>'' 
				
				

