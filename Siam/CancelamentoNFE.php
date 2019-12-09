<?php
date_default_timezone_set('America/Araguaina');
set_time_limit(false);

$myArray = array();
$path = 'BrisanetGerenciadora/' ;
$arquivo = 'Junho-18.xml';
$log = 'LogModificacoes.txt';
//$Cnpj = '09302646000106'; $IncricaoMunicipal = '450073'; //Rps
//$Cnpj = '05261547000164'; $IncricaoMunicipal = '450021'; //Interservice
//$Cnpj = '04601397000128'; $IncricaoMunicipal = '450015';  //BrisanetMatriz
$Cnpj = '19796576000135'; $IncricaoMunicipal = '230000611'; //BrisanetGerenciadora

    
//Iterando item por item do Array $myArray
for ($i = 0; $i < count($myArray); $i++) {
$xmlTotal = '<?xml version="1.0" encoding="iso-8859-1"?>';
$xmlTotal .= '<CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';
$xmlTotal .= '<Pedido>';
$xmlTotal .= '<InfPedidoCancelamento Id="Cancelamento_201301">';
$xmlTotal .= '<IdentificacaoNfse>';
$xmlTotal .= '<Numero>'. $myArray[$i] .'</Numero>';
$xmlTotal .= '<CpfCnpj>';
$xmlTotal .= '<Cnpj>'.$Cnpj.'</Cnpj>';
$xmlTotal .= '</CpfCnpj>';
$xmlTotal .= '<InscricaoMunicipal>'.$IncricaoMunicipal.'</InscricaoMunicipal>';
$xmlTotal .= '<CodigoMunicipio>2310803</CodigoMunicipio>';
$xmlTotal .= '</IdentificacaoNfse>';
$xmlTotal .= '<CodigoCancelamento>1</CodigoCancelamento>';
$xmlTotal .= '<MotivoCancelamento>Erro no preenchimento dos dados</MotivoCancelamento>';
$xmlTotal .= '</InfPedidoCancelamento>';
$xmlTotal .= '</Pedido>';
$xmlTotal .= '</CancelarNfseEnvio>';


Try{

 $soap = new SoapClient('https://ws.imap.org.br/siam/nfse.svc?wsdl', array('trace' => 1));


$parameters['parameters']['param'] = $xmlTotal;
$result = $soap->__soapCall("CancelarNfseEnvio", $parameters);
//if($error = $soap->Error()){ die($error);} 
} catch (SoapFault $fault) {
    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
    $f = fopen('ERROS.xml','a+');
        fwrite($f, SERIALIZE($fault). PHP_EOL);
        fclose($f);
}
if($result){
    
$f = fopen($path.$arquivo,'a+');
        fwrite($f, SERIALIZE($result). PHP_EOL);
        fclose($f);
        echo ($myArray[$i] . ' Cancelado'.'<br>'); 
       
} 
else {
    print_r ($result); 
}

  usleep(500);
}
$f = fopen($path.$log,'a+');
        fwrite($f,'Cnpj: '.$Cnpj.' Arquivo: '. $arquivo.' Data: '.date("d/m/Y H:i").PHP_EOL);
        fclose($f);


?>
