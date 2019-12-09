<?php 
        //Data, connection, auth
        //$dataFromTheForm = $_POST['fieldName']; // request data from the form
        $soapUrl = "https://ws.imap.org.br/siam/nfse.svc?wsdl"; // asmx URL of WSDL
        $soapUser = "username";  //  username
        $soapPassword = "password"; // password

        // xml post structure

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><CancelarNfseEnvio xmlns="https://ws.imap.org.br/siam/nfse.xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><Pedido><InfPedidoCancelamento Id="Cancelamento_201301"><IdentificacaoNfse><Numero>1834627</Numero><CpfCnpj><Cnpj>05261547000164</Cnpj></CpfCnpj><InscricaoMunicipal>450021</InscricaoMunicipal><CodigoMunicipio>2310803</CodigoMunicipio></IdentificacaoNfse><CodigoCancelamento>1</CodigoCancelamento><MotivoCancelamento>Erro no preenchimento dos dados</MotivoCancelamento></InfPedidoCancelamento></Pedido></CancelarNfseEnvio></soap:Body></soap:Envelope>';   // data from the form, e.g. some ID number

           $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: http://tempuri.org/INfse/CancelarNfseEnvio", 
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL

            $url = $soapUrl;

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // converting
            $response = curl_exec($ch); 
            curl_close($ch);

            // converting
            $response1 = str_replace("<soap:Body>","",$response);
            $response2 = str_replace("</soap:Body>","",$response1);

            // convertingc to XML
            $parser = simplexml_load_string($response2);
            // user $parser to get your data out of XML response and to display it.
    ?>