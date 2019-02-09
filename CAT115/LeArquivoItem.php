<?php
set_time_limit(false);
  //$handle = fopen("PB13049421000310221  1808N01M.001", "r");
 $arquivo = file('Original/RN04601397003909211  1809N01I.001');
 $arquivoGrava = 'Alterado/RN04601397003909211  1809N01I.001';
 $procuraData =201809;
 $substituiStatus = 'S1809';
 $substituiData = '201809';
 

foreach ($arquivo as $linha) {
   //echo $linha.'<br><br>'; 
  $Data=  substr ( $linha , 20, 6);   //PEGA A DATA NO ARQUIVO
  $status =   substr($linha , 214, 5);
 
 if ($Data == $procuraData){ 
      $f = fopen($arquivoGrava,'a+');
        fwrite($f,  $linha);
        fclose($f);
	
 }
  
 else if   ($Data <> $procuraData){
      $PegaLinhaAntesData=  substr ($linha , 0, 20);
      $PegaLinhaDepoisData=  substr ($linha , 26, 188);
      $pegaLinhaDepoisStatus = substr ($linha , 219, 80);
 
      $CalMD5 = md5($PegaLinhaAntesData.$substituiData.$PegaLinhaDepoisData.$substituiStatus.$pegaLinhaDepoisStatus);
      
      $f = fopen($arquivoGrava,'a+');
        fwrite($f,  $PegaLinhaAntesData.$substituiData.$PegaLinhaDepoisData.$substituiStatus.$pegaLinhaDepoisStatus.$CalMD5.PHP_EOL);
        fclose($f);   
     
     }
            
     

         
}
?>
