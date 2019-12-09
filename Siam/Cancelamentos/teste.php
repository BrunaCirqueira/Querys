<?php
 
set_time_limit(false);
//error_reporting(0);
 


    $xmlTotal = 'soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/"><soapenv:Header/><soapenv:Body><tem:CancelarNfseEnvio><tem:param><![CDATA[<?xml version="1.0" encoding="UTF-8"?><CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><Pedido><InfPedidoCancelamento Id="Cancelamento_201301"><IdentificacaoNfse><Numero>1823188</Numero><CpfCnpj><Cnpj>05261547000164</Cnpj></CpfCnpj><InscricaoMunicipal>450021</InscricaoMunicipal><CodigoMunicipio>2310803</CodigoMunicipio></IdentificacaoNfse><CodigoCancelamento>1</CodigoCancelamento><MotivoCancelamento>Erro no preenchimento dos dados</MotivoCancelamento></InfPedidoCancelamento></Pedido></CancelarNfseEnvio>]]></tem:param></tem:CancelarNfseEnvio></soapenv:Body></soapenv:Envelope>';
    $URL = "https://ws.imap.org.br/siam/nfse.svc?wsdl";
	$cert_file = "interservice.pem";
$cert_password = "12345678";

    //setting the curl parameters.
    $ch = curl_init();


	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_SSLCERT , $cert_file);
    curl_setopt($ch, CURLOPT_SSLCERTPASSWD , $cert_password );   
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlTotal);


        if (curl_errno($ch)) 
    {
        // moving to display page to display curl errors
		echo 3;
          echo curl_errno($ch) ;
          echo curl_error($ch);
    } 
    else 
    {
		echo 2;
        //getting response from server
        $response = curl_exec($ch);
        print_r($response);
		echo($response);
       
        $f = fopen('totalxml.txt','w');
        fwrite($f, $response);
        fclose($f);
        
        curl_close($ch);
    }


