<?php
 
$url = "https://ws.imap.org.br/siam/nfse.svc?wsdl";
$cert_file = 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/interservice.pem';
$cert_password = '12345678';
 
$ch = curl_init();
 
$options = array( 
    CURLOPT_RETURNTRANSFER => true,
    //CURLOPT_HEADER         => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
     
    CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
    //CURLOPT_VERBOSE        => true,
    CURLOPT_URL => $url ,
    CURLOPT_SSLCERT => $cert_file ,
    CURLOPT_SSLCERTPASSWD => $cert_password ,
);
 
curl_setopt_array($ch , $options);
 
$output = curl_exec($ch);
 
if(!$output)
{
    echo "Curl Error : " . curl_error($ch);
}
else
{
    echo htmlentities($output);
}