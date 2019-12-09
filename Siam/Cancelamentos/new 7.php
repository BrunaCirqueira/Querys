<?php
//$xmlTotal = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">';
//$xmlTotal .= '<soapenv:Header/>';
//$xmlTotal .= '<soapenv:Body>';
//$xmlTotal .= '<tem:CancelarNfseEnvio>';
//$xmlTotal .= '<!--Optional:-->';
//$xmlTotal .= '<tem:param>';
$xmlTotal = '<?xml version="1.0" encoding="UTF-8"?>';
$xmlTotal .= '<CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
$xmlTotal .= '<Pedido>';
$xmlTotal .= '<InfPedidoCancelamento Id="Cancelamento_201301">';
$xmlTotal .= '<IdentificacaoNfse>';
$xmlTotal .= '<Numero>1834627</Numero>';
$xmlTotal .= '<CpfCnpj>';
$xmlTotal .= '<Cnpj>05261547000164</Cnpj>';
$xmlTotal .= '</CpfCnpj>';
$xmlTotal .= '<InscricaoMunicipal>450021</InscricaoMunicipal>';
$xmlTotal .= '<CodigoMunicipio>2310803</CodigoMunicipio>';
$xmlTotal .= '</IdentificacaoNfse>';
$xmlTotal .= '<CodigoCancelamento>1</CodigoCancelamento>';
$xmlTotal .= '<MotivoCancelamento>Erro no preenchimento dos dados</MotivoCancelamento>';
$xmlTotal .= '</InfPedidoCancelamento>';
$xmlTotal .= '</Pedido>';
$xmlTotal .= '</CancelarNfseEnvio>';
//$xmlTotal .= '</tem:param>';
//$xmlTotal .= '</tem:CancelarNfseEnvio>';
//$xmlTotal .= '</soapenv:Body>';
//$xmlTotal .= '</soapenv:Envelope>';


$wsdl  = "https://ws.imap.org.br/siam/nfse.svc?wsdl";

$headers = array(  "Content-type: text/xml;charset=\"utf-8\"", 
     "Accept: text/xml", 
     "Cache-Control: no-cache", 
     "Pragma: no-cache", 
  //   "SOAPAction: \"\"", 
     "Content-length: ".strlen($xmlTotal),
    ); 
	
	//print_r ($headers);
	//print_r ($xmlTotal);


$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $wsdl); 

curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('SOAPAction: ""')); 
curl_setopt($ch, CURLOPT_CAPATH, 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/');
curl_setopt($ch, CURLOPT_CAINFO,  'C:/xampp/htdocs/xampp/Siam/Cancelamentos/cacert.pem');
curl_setopt($ch, CURLOPT_SSLCERT, 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/interservice.pem');
curl_setopt($ch, CURLOPT_SSLCERTPASSWD, '12345678');
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlTotal); 
curl_setopt($ch, CURLOPT_HEADER, 1); 

$output = curl_exec($ch);

// Check if any error occured
if(curl_errno($ch))
{
    echo 'Error no : '.curl_errno($ch).' Curl error: ' . curl_error($ch);
}
else 
    {
		
		
        //getting response from server
        $response = curl_exec($ch);
        print_r($output);
       
        $f = fopen('RESPONSE2.xml','w');
        fwrite($f, $output);
        fclose($f);
		
			
        
  
    }
print_r($output);
curl_close($ch);

?>