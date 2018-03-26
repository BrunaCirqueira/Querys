SELECT DISTINCT * 
				
FROM(

-- Campos que estão presentes no relatório

	SELECT DISTINCT
					A.[Cód.Fornecedor], 
					A.[Nome Fornecedor],
					CAST(M.TransId as nvarchar(50)) as 'LC' ,
					CAST(X.DocNum as nvarchar(50)) as 'N.Doc', 
					CAST(A.[AD] as nvarchar(50)) as 'AD', 
					N.RcurCode as 'LP',
					A.[Trans. Rec],
					A.[Duplicata],
					A.[Data de Vencimento],
					[Valor Total] =
									CASE WHEN 
											 N.RcurCode IS NOT NULL THEN A.[Saldo]
										 ELSE
											 A.[Valor Parcela]+A.[Saldo] 
									END,
					A.[Observacoes],
					A.SeqCode,
					A.[FormaPagamento],
					A.[CodFilial],
					A.[Filial]

	FROM (

-- Lançamentos Contabeis + Adiantamentos para Fornecedores + NFE de Entrada sem IRF

		SELECT DISTINCT * FROM (
								SELECT 
										  [Cód.Fornecedor] = B.CardCode,
										  [Nome Fornecedor]=B.CardName,
										  [Tipo] = (SELECT 
														  G.TransType 
													FROM 
														  OJDT G 
													WHERE 
														  G.TransId = A.TransId
													),
										  [IR] = 
												CASE WHEN 
														(SELECT G.TransType 
														 FROM 
																OJDT G 
														 WHERE 
																G.TransId = A.TransId) = '18' THEN (SELECT COUNT(*) 
																									FROM 
																										OPCH T0 
																										INNER JOIN PCH5 T1 ON T0.DocEntry = T1.AbsEntry 
																									WHERE 
																										T1.Category = 'P' AND 
																										T0.DocNum = (SELECT 
																															G.Baseref 
																													 FROM OJDT G 
																													 WHERE G.TransId = A.TransId)
																									)
												END,         
										  [LC] = 
												CASE A.TransType
													WHEN 30 THEN A.TransId
													WHEN 46 THEN A.TransId
													ELSE ''
												END,
										  [N.Doc]= 
													CASE A.TransType
														WHEN 18 THEN (
																		SELECT V.DocEntry 
																		FROM OPCH V 
																		WHERE V.TransId = A.TransId) 
														ELSE '' 
													END,
										  [AD] =  
												  CASE A.TransType
														WHEN 204 THEN (SELECT G.DocEntry 
																	   FROM ODPO G 
																	   WHERE G.TransId = A.TransId) 
														ELSE NULL
													END,
										  [LP] = '',
										  [Trans. Rec]=null,
										  [Duplicata] = 
														CASE A.TransType
																WHEN 30  THEN 'LC - '+cast(A.TransId as nvarchar(20))
																WHEN 46  THEN 'LC - '+cast(A.TransId as nvarchar(20))
																WHEN 18  THEN 'ENT NF - '+ CAST((SELECT H.Serial FROM OPCH H WHERE H.TransId = A.TransId) AS nvarchar(50)) + '/' + CAST(A.SourceLine as nvarchar(20))
																WHEN 204 THEN 'AD - ' + A.Ref1
														END,
										  [Data de Vencimento] = A.DueDate,
										  [Valor Parcela] = A.Debit,
										  [Saldo] =
													CASE
															WHEN A.BalDueCred = 0 THEN -( A.BalDueDeb )
															ELSE A.BalDueCred
													END,
										  [Observacoes] =
														CASE A.TransType
																WHEN 30  THEN A.LineMemo + ' ' + A.Ref2
																WHEN 46  THEN A.LineMemo + ' ' + A.Ref2
																WHEN 18  THEN (SELECT F.Comments FROM OPCH F WHERE F.TransId = A.TransId)
																WHEN 204 THEN (SELECT H.Comments FROM ODPO H WHERE H.TransId = A.TransId)
														END, 
										  [SeqCode] = 
													  CASE A.TransType
															WHEN 18 THEN (SELECT SeqCode FROM OPCH V WHERE V.TransId = A.TransId) 
															ELSE '' 
													   END,
										  [FormaPagamento] =  
															CASE A.TransType
																	WHEN 18 THEN (SELECT PeyMethod FROM OPCH V WHERE V.TransId = A.TransId) 
																	ELSE '' 
															END,   
										  [Filial]= 
													CASE A.TransType
														WHEN 18 Then A.BPLName
														WHEN 30 Then A.BPLName
														WHEN 46 Then A.BPLName
														WHEN 204 Then A.BPLName
													END,
															
										  [CodFilial]= A.BPLId
										
								

									
							FROM 
									JDT1 A
									INNER JOIN OCRD B ON B.CardCode = A.ShortName
							WHERE 
									A.ContraAct <> A.ShortName AND
									(A.BalDueDeb <> 0 OR A.BalDueCred <> 0)AND
									B.CardType = 'S'
								)AS TR
		WHERE 
				TR.[IR] = 0 OR TR.IR IS NULL AND
				TR.[Tipo]  IN ('18','204','30')

	
		UNION ALL
									
								-- Select com todos os Lançamentos Periodicos 

								SELECT DISTINCT
										[Cód.Fornecedor] = A.FornCodigo,
										[Nome Fornecedor] = A.FornRazaoSocial, 
										[Tipo] = 0,
										[IR] = 0,
										[LC] = '',
										[N.Doc] = '',
										[AD] = NULL,
										[LP] = A.Codigo,
										[Trans. Rec]=null,
										[Duplicata] = 'LP',
										[Data de Vencimento] = A.Vencto, 
										[Valor Parcela] = A.Valor,
										[Saldo] = A.Valor,
										[Observacoes]= ISNULL(A.obs+' ',A.Descricao),
										null,
										null,
										B.BPLName,
										B.BPLId
								FROM 
										OADM E, dbo.FxLanctoPeriodico() A
										INNER JOIN OBPL B ON A.Filial = B.BPLId
									


		UNION ALL

								-- Select das Devoluções de NFE

								SELECT DISTINCT
										[Cód.Fornecedor] = T0.CardCode,
										[Nome Fornecedor] = T0.CardName,
										[Tipo] = 0,
										[IR] = 0,
										[LC] = '',
										[N.Doc] = T0.DocEntry,
										[AD] = NULL,
										[LP] = '',
										[Trans. Rec]=null,
										[Duplicata] = 'DEV NF - ' + CAST(T0.Serial as nvarchar(20))+ '/'+CAST(T2.InstlmntID as nvarchar(10)),
										[Data de Vencimento] = (SELECT K.DueDate FROM RPC6 K WHERE K.DocEntry = T0.DocEntry AND K.InstlmntID = T2.InstlmntID ),
										[Valor Parcela] = ISNULL((T2.InsTotal - ((SELECT SUM(X.WTAmnt) FROM RPC5 X WHERE Category = 'P' and X.AbsEntry = T1.AbsEntry) * (T2.InsTotal / T0.DOCTOTAL))),T2.InsTotal) * (-1),
										[Saldo] = 0,
										[Observacoes] = T0.Comments,
										T0.SeqCode,
										T0.PeyMethod,
										null,
										null
								FROM 
										ORPC T0
										LEFT JOIN RPC5 T1 ON T0.DocEntry = T1.AbsEntry
										LEFT JOIN RPC6 T2 ON T0.DocEntry = T2.DocEntry
								WHERE 
										T0.SeqCode <> '1' AND T0.DocStatus = 'O'


										
		UNION ALL

								-- Select com todas as Notas Fiscais de Entrada que tem IRF já com valor deduzido

								SELECT DISTINCT
										[Cód.Fornecedor] = T0.CardCode,
										[Nome Fornecedor] = T0.CardName,
										[Tipo] = 0,
										[IR] = 0,
										[LC] = '',
										[N.Doc] = T0.DocEntry,
										[AD] = NULL,
										[LP] = '',
										[Trans. Rec]=null,
										[Duplicata] = 'ENT NF - ' + CAST(T0.DocEntry as nvarchar(20))+ '/'+CAST(T2.InstlmntID as nvarchar(10)),
										[Data de Vencimento] = (SELECT K.DueDate FROM PCH6 K WHERE K.DocEntry = T0.DocEntry AND K.InstlmntID = T2.InstlmntID ),
										[Valor Parcela] = (T2.InsTotal - ((SELECT SUM(X.WTAmnt) FROM PCH5 X WHERE Category = 'P' and X.AbsEntry = T1.AbsEntry) * (T2.InsTotal / T0.DOCTOTAL))),
										[Saldo] = 0,
										[Observacoes] = T0.Comments,
										T0.SeqCode,
										T0.PeyMethod,
										null,
										null
								FROM 
										OPCH T0
										INNER JOIN PCH5 T1 ON T0.DocEntry = T1.AbsEntry
										INNER JOIN PCH6 T2 ON T0.DocEntry = T2.DocEntry
								WHERE 
										T2.[Status] = 'O' AND
										(T1.WTAmnt IS NOT NULL AND T1.Category = 'p') 

										
		UNION ALL


								SELECT 
										*,
										null,
										null,
										(SELECT 
												BPLName 
										FROM 
												ODRF 
										WHERE 
												DocEntry = TransRec
										), 
										(SELECT 
												BPLId 
										FROM 
												ODRF 
										WHERE 
												DocEntry = TransRec
										) 
								FROM [dbo].[FlxContasPagar]({?DataIni}, {?DataFinal})

								) AS A
 
								LEFT JOIN OPCH X ON A.[N.Doc] = X.DocNum
								LEFT JOIN OJDT M ON A.[LC] = M.TransId
								LEFT JOIN ORCR N ON A.[LP] = N.RcurCode
	WHERE 1=1

	) AS TB
WHERE  
	TB.[Valor Total] <> 0 
	--AND (TB.[Cód.Fornecedor]='{?@CardCode SELECT * FROM  OCRD}' OR '{?@CardCode SELECT * FROM  OCRD}'='')
	AND (TB.[Data de Vencimento]  >= {?DataIni})
	AND (TB.[Data de Vencimento] <= {?DataFinal})
ORDER BY TB.[Duplicata] ASC
