<?php

namespace RedditApi;
use GuzzleHttp;

class Reddit {
    
    private $baseUrl = "https://www.reddit.com/api/v1/";
    private $clientId;
    private $secret;
    private $oauth_token;
    
    
    public function __construct($token = "") {
        if(!empty($token)) {
            $this->oauth_token = $token;
        } else {
            //throw new RedditNoTokenException();
        }
    }
    
    public function setCredentials($clientId, $secret) {
        $this->clientId = $clientId;
        $this->secret = $secret;
    }
    
    public function getBaseUrl() {
        return $this->baseUrl;
    }
    
    public function auth($params) {
        $endpoint = "access_token";
        $creds = array('user' => $this->clientId, 'password' => $this->secret);
        $header = array('Authorization' => 'Basic '. base64_encode(implode(':',$creds)));
        
        return $this->doRequest($endpoint, $params, 'post', false, $header);
    }
    
    public function get($endpoint, $params = array()) {
        
       
        
    }
    
    public function post($endpoint, $params = array()) {
        $uri = $endpoint;
        
        $this->doRequest($uri, $params, 'post');
    }
    
    public function postAuth($endpoint, $params = array()) {
    
        
    }
    
    
    private function doRequest($uri,$formParams, $method, $isAuth = false, $header = array()) {
        
        $client = new \GuzzleHttp\Client();
        $url = $this->baseUrl.$uri;
        $params = array();
        $params['form_params'] = $formParams;
        
        $header['User-Agent'] = 'phcsaucebot/0.1';
        
        $params['headers'] = $header;
        $params['debug'] = false;
        
        $response = $client->request(strtoupper($method),$url, $params);

        return json_decode($response->getBody()->getContents());
    }
    
    
    
}