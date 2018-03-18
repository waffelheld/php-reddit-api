# phpredditapi

very simple wrapper for the reddit api. currently unstable.

## install

```
composer require waffelheld\phpredditapi:dev-master
```

package require guzzle >= 6.*


## usage

basic example for receiving a OAuth2 token:

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$reddit = new \RedditApi\Reddit();

$state = "RANDOM_UNIQUE_STRING";
$redirectUrl = "YOUR_RETURN_URL";
$clientId = "CLIENT_ID";
    $secret = "CLIENT_SECRET";

if(!isset($_GET['code']) && !isset($_GET['state'])) {
    $endpoint = "authorize";
    $params = array(
        'client_id'         => $clientId,
        'response_type'    => 'code',
        'redirect_uri'      => $redirectUrl,
        'duration'          => 'permanent',
        'state'             => $state,
        'scope'             => 'identity,edit,flair,history,modconfig,modflair,modlog,modposts,modwiki,mysubreddits,privatemessages,read,report,save,submit,subscribe,vote,wikiedit,wikiread'
    );
    
    $url = $reddit->getBaseUrl();
    $url .= $endpoint.'?'.http_build_query($params);
    header('Location: '.$url);
    
} else {
    
    
    if($_GET['state'] !== $state){
        echo 'state not matching';
        exit;
    }
    $params = array(
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code'],
        'redirect_uri'  => $redirectUrl
    );
    
    $reddit->setCredentials($clientId, $secret);
    
    $result = $reddit->auth($params);
    //access token in $result['access_token'];
}

```


### OAuth get endpoint

```php
$reddit = new \RedditApi\Reddit('YOUR_TOKEN');
$result = $reddit->getAuth('api/me');
```
### OAuth post endpoint

```php
$reddit = new \RedditApi\Reddit('YOUR_TOKEN');
$params = array(
    //declare params
);
$result = $reddit->getAuth('api/me', $params);
```

for a list of endpoints see [reddit api auto doku](https://www.reddit.com/dev/api/)


## TODO

- error handling