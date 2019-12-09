<?php
$https_url = "https://ws.imap.org.br/siam/nfse.svc?wsdl";
 $crtFile = 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/cacert.pem';
    $pemfile = 'C:/xampp/htdocs/xampp/Siam/Cancelamentos/interservice.pem';
    $keyfile = 'http://www.example.com/privatekey.key';
    $cert_password = '12345678';
    $url = $https_url;
	
$xmlTotal = '<?xml version="1.0" encoding="UTF-8"?>';
$xmlTotal .= '<CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
$xmlTotal .= '<Pedido>';
$xmlTotal .= '<InfPedidoCancelamento Id="Cancelamento_201301">';
$xmlTotal .= '<IdentificacaoNfse>';
$xmlTotal .= '<Numero>1836976</Numero>';
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
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_SSLCERT, $pemfile);
    curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
    //curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $keyfile);
    curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $cert_password);
    curl_setopt($ch, CURLOPT_CAINFO, $crtFile);
    curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $cert_password);
    curl_setopt($ch, CURLOPT_POST, 1);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: text/xml; charset=utf-8',
        'Content-Length: ' . strlen($xmlTotal))
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlTotal);

    $output = curl_exec($ch);

    if ($output === false) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        //echo 'Operation completed without any errors';
    }


    return $output;
