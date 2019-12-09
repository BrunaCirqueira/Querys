<?php
 
$url = "https://ws.imap.org.br/siam/nfse.svc?wsdl";
$cert_file = 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/interservice.pem';
$cert_password = 12345678;
$path = 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/';
$auth = 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/cacert.pem';

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
$ch = curl_init();
 
$options = array( 
    CURLOPT_RETURNTRANSFER => true,
    //CURLOPT_HEADER         => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_CAPATH => $path ,
 CURLOPT_CAINFO => $auth,
     
    CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
    //CURLOPT_VERBOSE        => true,
    CURLOPT_URL => $url ,
    CURLOPT_SSLCERT => $cert_file ,
    CURLOPT_SSLCERTPASSWD => $cert_password ,
	CURLOPT_POSTFIELDS => $xmlTotal,
	
);
 
curl_setopt_array($ch , $options);
 
$output = curl_exec($ch);
 
if(!$output)
{
    echo "Curl Error : " . $output;
}
else
{
    echo htmlentities($output);
}