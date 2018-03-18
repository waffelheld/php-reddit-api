<?php

namespace RedditApi;
use GuzzleHttp;

class Reddit { 
    
    private $baseUrl = "https://www.reddit.com/"; 
    private $oauthUrl = "https://oauth.reddit.com/";
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
        $endpoint = "api/v1/access_token";
        $creds = array('user' => $this->clientId, 'password' => $this->secret);
        $header = array('Authorization' => 'Basic '. base64_encode(implode(':',$creds)));
        
        return $this->doRequest($endpoint, $params, 'post', false, $header);
    }
    
    public function refresh($token) {
        
        $endpoint = "api/v1/access_token";
        $creds = array('user' => $this->clientId, 'password' => $this->secret);
        $header = array('Authorization' => 'Basic '. base64_encode(implode(':',$creds)));
        
        return $this->doRequest(
                $endpoint, 
                array(
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $token
                ), 
                'post', 
                false, 
                $header);
    }
    
    
    public function get($endpoint, $params = array()) {
    
        return $this->doRequest($endpoint, $params, 'get');
    
    }
    public function getAuth($endpoint, $params = array()) {
    
        return $this->doRequest($endpoint, $params, 'get',true);
    
    }
    
    public function post($endpoint, $params = array()) {
        $uri = $endpoint;
        
        $this->doRequest($uri, $params, 'post');
    }
    
    public function postAuth($endpoint, $params = array()) {
        $uri = $endpoint;
        
        $this->doRequest($uri, $params, 'post',true);
        
    }
    
    
    private function doRequest($uri,$formParams, $method, $isAuth = false, $header = array()) {
        
        $client = new \GuzzleHttp\Client();
        $url = $this->baseUrl.$uri;
        $params = array();
        $params['form_params'] = $formParams;
        
        $header['User-Agent'] = 'phcsaucebot/0.1';
        
        if($isAuth === true) {
            $header['Authorization'] = "Bearer ".$this->oauth_token;
            $url = $this->oauthUrl.$uri;
        }
        
        $params['headers'] = $header;
        $params['debug'] = false;
//        print_r($params);
//        if($uri == 'api/comment') {
//            $params['debug'] = true;
//            
//        }
        $response = $client->request(strtoupper($method),$url, $params);
//        if($uri == 'api/comment') {
//            print_r($response->getBody());
//            print_r($response->getBody()->getContents());
//            
//        }
        return json_decode($response->getBody()->getContents(),true);
    }
    
    
    
}