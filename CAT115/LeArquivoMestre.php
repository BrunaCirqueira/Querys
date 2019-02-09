<?php
set_time_limit(false);
  //$handle = fopen("PB13049421000310221  1808N01M.001", "r");
 $arquivo = file('Original/RN04601397003909211  1809N01M.001');
 $arquivoGrava = 'Alterado/RN04601397003909211  1809N01M.001';
 $procuraData =201809;
 $substituiStatus = 'S1809';
 $substituiData = '201809';
 

foreach ($arquivo as $linha) {
   //echo $linha.'<br><br>'; 
  $Data=  substr ( $linha , 81, 6);
  $status =   substr($linha , 81, 6);
 
 if ($Data == $procuraData){ 
      $f = fopen($arquivoGrava,'a+');
        fwrite($f,  $linha);
        fclose($f);
	
 }
  
 else if   ($Data <> $procuraData){
      $PegaLinhaAntesData=  substr ($linha , 0, 81);
      $PegaLinhaDepoisData=  substr ($linha , 87, 16);
      $PegaLinhaDepoisHash=  substr ($linha , 135, 60);
      
      $pegaLinhaDepoisStatus = substr ($linha , 200, 193);
      $CalHASH =   hash('md5',substr ($linha , 0, 14). substr ($linha , 94, 9). substr ($linha , 135, 36). $substituiData.substr ($linha , 87, 2). substr ($linha , 238, 14));
      $CalMD5 = md5($PegaLinhaAntesData.$substituiData.$PegaLinhaDepoisData.$CalHASH.$PegaLinhaDepoisHash.$substituiStatus.$pegaLinhaDepoisStatus);
     
      
     
     $f = fopen($arquivoGrava,'a+');
        fwrite($f,  $PegaLinhaAntesData.$substituiData.$PegaLinhaDepoisData.$CalHASH.$PegaLinhaDepoisHash.$substituiStatus.$pegaLinhaDepoisStatus.$CalMD5.PHP_EOL);
        fclose($f); 

      
       
	   //echo ($PegaLinhaAntesData.$Data.$PegaLinhaDepoisData.$CalHASH.$PegaLinhaDepoisHash.$substituiStatus.$pegaLinhaDepoisStatus.$CalMD5.PHP_EOL);
       
       
                      
        
         //echo $pegaLinhaDepoisStatus;   
        // echo substr ($linha , 0, 14). substr ($linha , 94, 9). substr ($linha , 135, 36). substr ($linha , 81, 8). substr ($linha , 238, 14).'<br>';
                  
        // echo $teste;
        // echo hash('md5', '000425737853000001284680000000029000000000029000000000004932018081304601397003909');
                          //'000425737853000001284680000000029000000000029000000000004932018081304601397003909'
                          
      // echo $PegaLinhaAntesData.' '.$Data.' '.$PegaLinhaDepoisData.' '.$CalHASH.' '.$PegaLinhaDepoisHash.' ' .$substituiStatus.' '.$pegaLinhaDepoisStatus.' '.$CalMD5.'<br>';//.$substituiData.$PegaLinhaDepoisData.$substituiStatus.$pegaLinhaDepoisStatus.'<br><br>';                
       

//break;
     }
            
     
         //echo $teste.'   '.$procura.'<br>';
         
}
?>
