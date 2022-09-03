<?php

class Zendesk
{
    public function __construct($apiKey, $user, $subDomain, $suffix = '.json', $test = false)
    {
        $this->api_key = $apiKey;
        $this->user    = $user;
        $this->base    = 'https://' . $subDomain . '.zendesk.com/api/v2';
        $this->suffix  = $suffix;
    }

    public function call($url, $json, $action)
    {
        if (substr_count($url, $this->suffix) == 0)
        {
            $url .= '.json';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($ch, CURLOPT_URL, $this->base.$url);
        curl_setopt($ch, CURLOPT_USERPWD, $this->user."/token:".$this->api_key);


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $output = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($output);

        return is_null($decoded) ? $output : $decoded;
    }


    public function test()
    {
        $data =  $this->call('/tickets', '', 'GET');
    }


}