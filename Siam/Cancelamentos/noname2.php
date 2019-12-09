<?php
error_reporting(E_ALL);
$url = "https://ws.imap.org.br/siam/nfse.svc?wsdl";
  $cert = "C:/xampp/htdocs/xampp/Siam/Cancelamentos/interservice.pem";
$fp = fopen ("output.xml", "w");
$xmlTotal = '<?xml version="1.0" encoding="UTF-8"?>';
$xmlTotal .= '<CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
$xmlTotal .= '<Pedido>';
$xmlTotal .= '<InfPedidoCancelamento Id="Cancelamento_201301">';
$xmlTotal .= '<IdentificacaoNfse>';
$xmlTotal .= '<Numero>1834632</Numero>';
$xmlTotal .= '<Numero>1834632</Numero>';
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

$headers = array(  "Content-type: text/xml;", 
     "Accept: text/xml", 
     "Cache-Control: no-cache", 
     "Pragma: no-cache", 
  //   "SOAPAction: \"\"", 
     "Content-length: ".strlen($xmlTotal),
    ); 

$ch = curl_init ();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CAINFO,  'C:/xampp/htdocs/xampp/Siam/Cancelamentos/cacert.pem');
//curl_setopt($ch, CURLOPT_SSLCERT, 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/interservice.pem');
curl_setopt ($ch, CURLOPT_SSLCERT, $cert);
curl_setopt ($ch, CURLOPT_SSLCERTPASSWD, "12345678");     
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlTotal);
curl_setopt ($ch, CURLOPT_FILE, $fp);
curl_setopt ($ch, CURLOPT_HEADER, 1);   



// Error handling

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
        print_r($response);
       
    }
     curl_close($ch);
?>
