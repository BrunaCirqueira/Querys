<?php
set_time_limit(false);
  //$handle = fopen("PB13049421000310221  1808N01M.001", "r");
 $arquivo = file('Original/RN04601397003909211  1809N01D.001');
 $arquivoGrava = 'Alterado/RN04601397003909211  1809N01D.001';
 $procuraData =201809;
 $substituiData = '201809';
 

foreach ($arquivo as $linha) {
  $Data=  substr ( $linha , 221, 6);   //PEGA A DATA NO ARQUIVO


 if ($Data == $procuraData){ 
      $f = fopen($arquivoGrava,'a+');
        fwrite($f,  $linha);
        fclose($f);
	
 }    
  
 else  if   ($Data <> $procuraData){
      $PegaLinhaAntesData=  substr ($linha , 0, 221);
      $PegaLinhaDepoisData=  substr ($linha , 227, 28);     
 
  
      $CalMD5 = md5($PegaLinhaAntesData.$substituiData.$PegaLinhaDepoisData);
        
            
      $f = fopen($arquivoGrava,'a+');
        fwrite($f,  $PegaLinhaAntesData.$substituiData.$PegaLinhaDepoisData.$CalMD5.PHP_EOL);
        fclose($f);   
        
        
     }
            
    
         
}
?>
