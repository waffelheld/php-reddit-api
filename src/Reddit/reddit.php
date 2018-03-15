<?php

namespace \Waffelheld\Reddit;
use GuzzleHttp;

class reddit {
    
    private $baseUrl = "https://www.reddit.com/api/v1/";
    private $key;
    private $secret;
    private $oauth_token;
    
    
    public function __construct($token = "") {
        if(!empty($token)) {
            $this->oauth_token = $token;
        } else {
            //throw new RedditNoTokenException();
        }
    }
    
    public function get($endpoint, $params = array()) {
        
        
        
    }
    
    public function getAuth($endpoint, $params = array()) {
    
        
    }
    
    public function post($endpoint, $params = array()) {
    
        
    }
    
    public function postAuth($endpoint, $params = array()) {
    
        
    }
    
    
    private function doRequest($endpoint, $params = array(), $isPost = false, $isAuth = false) {
        
    }
    
    
    
}