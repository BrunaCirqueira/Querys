<?php

$xmlTotal = '<?xml version="1.0" encoding="iso-8859-1"?>';
$xmlTotal .= '<CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
$xmlTotal .= '<Pedido>';
$xmlTotal .= '<InfPedidoCancelamento Id="Cancelamento_201301">';
$xmlTotal .= '<IdentificacaoNfse>';
$xmlTotal .= '<Numero>1834632</Numero>';
$xmlTotal .= '<CpfCnpj>';
$xmlTotal .= '<Cnpj>05261547000164</Cnpj>';
$xmlTotal .= '</CpfCnpj>';
$xmlTotal .= '<InscricaoMunicipal>450021</InscricaoMunicipal>';
$xmlTotal .= '<CodigoMunicipio>2310803</CodigoMunicipio>';
$xmlTotal .= '</IdentificacaoNfse>';
$xmlTotal .= '<CodigoCancelamento>1</CodigoCancelamento>';
$xmlTotal .= '<MotivoCancelamento>Motivo de cancelamento</MotivoCancelamento>';
$xmlTotal .= '</InfPedidoCancelamento>';
$xmlTotal .= '</Pedido>';
$xmlTotal .= '</CancelarNfseEnvio>';


    
$URL = "https://ws.imap.org.br/siam/nfse.svc?wsdl";
$cert_file = "C:/xampp/htdocs/xampp/Siam/Cancelamentos/interservice.pem";
$cert_password = "12345678";






    //setting the curl parameters.
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$URL);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSLCERT, $cert_file); 

curl_setopt ($ch, CURLOPT_SSLCERTPASSWD, $cert_password);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    


   
    
     
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlTotal);

        if (curl_errno($ch)) 
    {
        // moving to display page to display curl errors
          print_r (curl_errno($ch)) ;
          print_r (curl_error($ch));
    } 
    else 
    {
        //getting response from server
        $response = curl_exec($ch);
        //print_r($response);
       
        $f = fopen('RetornoSiam.xml','w');
        fwrite($f, $response);
        fclose($f);
        
        curl_close($ch);
    }

?>
