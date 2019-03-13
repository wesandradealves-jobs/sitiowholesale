<?php
/*
 * PaypalExpress Class
 * This class is used to handle PayPal API related operations
 * @author    CodexWorld.com
 * @url        http://www.codexworld.com
 * @license    http://www.codexworld.com/license
 */
class PaypalExpress{
    public $paypalEnv       = 'production'; // Or 'production'
    public $paypalURL       = 'https://api.paypal.com/v1/';
    public $paypalClientID  = 'AYFS-zY6nIPnwHW7ab9ARPv2kBURtvhaiJAqFnnCMjv4DCx8SkFdt4nkKJkuvqU6NbbTzGf4X9fc6ilQ';
    private $paypalSecret   = 'EBsFUcsySHmfNPxBqo1ZPdjRQpx3epN8b7eR1qu1LknoSaqGgOxixK3ir52i_A96rwynFPiPTX9aE8ey';    

    // public $paypalEnv       = 'sandbox'; // Or 'production'
    // public $paypalURL       = 'https://api.sandbox.paypal.com/v1/';
    // public $paypalClientID  = 'ARyiGoMcCYOH0-Pr2ehB_sd63Dzge1L5JV3UdqWYSwlYV8A9JKwLZXZSJe26OwLJ-oY5vtK6-dDR-fkO';
    // private $paypalSecret   = 'EE9Ofxj93wJO7T-DZMI6ncF_Oazd6SAzm3wzx9HNUjKaX4tdWQr5ircaZd6utHp2m574cyweiTE0jJo2';
    
    public function validate($paymentID, $paymentToken, $payerID, $productID){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->paypalURL.'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->paypalClientID.":".$this->paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);
        
        if(empty($response)){
            return false;
        }else{
            $jsonData = json_decode($response);
            $curl = curl_init($this->paypalURL.'payments/payment/'.$paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            
            // Transaction data
            $result = json_decode($response);
            
            return $result;
        }
    
    }
}