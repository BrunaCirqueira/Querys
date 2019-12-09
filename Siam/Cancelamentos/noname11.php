<?php
$xmlTotal = '<?xml version="1.0" encoding="iso-8859-1"?>';
$xmlTotal .= '<CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
$xmlTotal .= '<Pedido>';
$xmlTotal .= '<InfPedidoCancelamento Id="Cancelamento_201301">';
$xmlTotal .= '<IdentificacaoNfse>';
$xmlTotal .= '<Numero>1891981</Numero>';
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


Try{

 $soap = new SoapClient('https://ws.imap.org.br/siam/nfse.svc?wsdl', array('trace' => 1));


$parameters['parameters']['param'] = $xmlTotal;
$result = $soap->__soapCall("CancelarNfseEnvio", $parameters);
//if($error = $soap->Error()){ die($error);}
print_r ($result); 
} catch (SoapFault $fault) {
    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
    $f = fopen('ERROS.xml','a+');
        fwrite($f, SERIALIZE($fault). PHP_EOL);
        fclose($f);
}
if($result){
$f = fopen('CANCELADOS.xml','a+');



 $xml = $soap->__getLastResponse();
                    
        
        $result = str_replace('O:8:"stdClass":1:{s:23:"CancelarNfseEnvioResult";O:8:"stdClass":1:{s:9:"xmlString";s:747:"' . chr(13), "", $result);
        $result = str_replace('";}}' . chr(13), "", $result);  
        fwrite($f, SERIALIZE($result). PHP_EOL);
        fclose($f);
       
}

            
            usleep(500);
 
?>
