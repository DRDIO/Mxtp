<?php

//  Kohana Twitter Oauth Library V1
//      By Tom Morton [Errant]
//
//

// require the Oauth component
require Kohana::find_file('libraries', 'Oauth');

/**
 * 	Twitter Oauth Class
 *
 *	Provides interfaces for executing an Oath exchange and
 *	retrieving a users key/secret. Also includes some
 *	basic API examples and helper code for constructing
 *	Twitter API requests
 *
 * 	@author Tom Morton
 *
 */
class Twitter_Core
{
    // Stores the logged in Twitter_Model
    protected $_config;
    protected $_session;
    protected $_method;
    protected $_consumer;
    protected $_token = null;
    protected $_loggedIn;

    /**
     *  Class Constructor
     *
     *  Sets up the Oauth consumers and other general cfg
     *
	 *	@return nothing
	 *	@access public
     */
    public function __construct($configName = 'twitter.default')
    {
        // set up the configuration
        $this->_config   = Kohana::config($configName);
        $this->_session  = Session::instance();
        $this->_method   = new OAuthSignatureMethod_HMAC_SHA1();
        $this->_consumer = new OAuthConsumer($this->_config['consumerToken'], $this->_config['consumerSecret']);
    }

    /**
     *	Obtain request tokens from Twitter
     *
     *	Queries Twitter for some tokens to use in the Oauth exchange
	 *	then stores them in a session for later
	 *
	 *	@access public
	 *	@return Oauth Consumer object
     *
     */
    public function getAuthUrl($callback = '', $signIn = true)
    {
        $requestToken = $this->hashRequest($this->_config['urlRequestToken']);
        var_dump($requestToken);
        if ($requestToken) {
            // Set a session for when user returns from Twitter
            $this->_session->set('twitter_request', $requestToken);

            // Build the URL that will redirect to Twitter for their permission
            $base  = ($signIn ? $this->_config['urlAuthenticate'] : $this->_config['urlAuthorize']);
            $query = http_build_query(array(
                'oauth_token'    => $requestToken['oauth_token'],
                'oauth_callback' => $callback));

            $url = $base . '?' . $query;
            return $url;
        }

        return false;
    }

    public function getAccessToken()
    {
        // Get request token, destroy it, build the request token consumer
        $requestToken = $this->_session->get_once('twitter_request');
        $this->_token = new OAuthConsumer($requestToken['oauth_token'], $requestToken['oauth_token_secret']);

        // Make an access request (which will also pass the request token consumer)
        // replace with access token consumer
        $accessToken     = $this->hashRequest($this->_config['urlAccessToken']);
        $this->_token    = new OAuthConsumer($accessToken['oauth_token'], $accessToken['oauth_token_secret']);
        $this->_loggedIn = true;

        // Save token so the access token consumer can be constructed later
        $this->_session->set('twitter_oauth', $accessToken);

        if (isset($accessToken['oauth_token'])) {
            // This access token will be saved in the DB (or however you wish)
            return $accessToken;
        }
        
        return false;
    }

    /**
     *
     * @return unknown_type
     */
    public function destroyToken()
    {
        // remove all session data
        if ($this->loggedIn()) {
            $response = $this->jsonRequest($this->_config['urlEndSession'], 'POST');
            $this->_session->delete('twitter_oauth', 'twitter_request');
            return true;
        }

        return true;
    }

    /**
     *
     * @return unknown_type
     */
    public function verifyCredentials($accessToken, $accessSecret)
    {
        // Setup an OAuth consumer and meka a request to validate credentials
        $this->_token = new OAuthConsumer($accessToken, $accessSecret);
        $user         = $this->jsonRequest($this->_config['urlVerifyCredentials']);
        // TODO: Figure out what an error returns and set it to false
        return $user;
    }

    public function getUser()
    {
        $user = $this->jsonRequest($this->_config['urlVerifyCredentials']);
        return $user;
    }

    /**
     *
     * @return unknown_type
     */
    public function loggedIn(Array $access = null)
    {
        if ($this->_loggedIn) {
            return true;
        }

        if (!$access) {
            $access = $this->_session->get('twitter_oauth');    
        }
        
        if (!isset($access['oauth_token']) && !isset($access['oauth_token_secret'])) {
            return false;
        }

        $user = $this->verifyCredentials($access['oauth_token'], $access['oauth_token_secret']);
        if ($user) {
            $this->_loggedIn = true;
        } else {
            $this->_token = null;
        }

        return $user;
    }

    /**
     * Let's us know if we are on the step before or after user has allowed us
     * @return unknown_type
     */
    public function approved()
    {
        $approvedToken = (isset($_GET['oauth_token']) ? $_GET['oauth_token'] : null);
        $requestToken  = $this->_session->get('twitter_request');

        if ($approvedToken && $requestToken && $requestToken['oauth_token'] == $approvedToken) {
            return true;
        }

        return false;
    }

    /**
      * Format and sign an OAuth / API request
	  *
	  *	@return string
      */
    function oAuthRequest($url, $method = 'GET', Array $args = array())
    {
        $method = ($method == 'GET' ? 'GET' : 'POST');

        $request = OAuthRequest::from_consumer_and_token($this->_consumer, $this->_token, $method, $url, $args);
        $request->sign_request($this->_method, $this->_consumer, $this->_token);

        switch ($method) {
            case 'GET':
                return $this->http($request->to_url());
            case 'POST':
                return $this->http($request->get_normalized_http_url(), $request->to_postdata());
        }

        return $response;
    }

    function hashRequest($url, $method = 'GET', Array $args = array())
    {
        $response = $this->oAuthRequest($url, $method, $args);
        parse_str($response, $array);
        return $array;
    }

    function jsonRequest($url, $method = 'GET', Array $args = array())
    {
        $url      .= '.json';
        $response  = $this->oAuthRequest($url, $method, $args);
        $json      = json_decode($response);
        if (isset($json->error)) {
            return false;
        }

        return $json;
    }


    /**
     * Make an HTTP request
     *
     * Uses Curl to retrieve a specified URL and return the page content if successful
     *
     * @return string
     *
     */
    public function http($url, $postData = null) {
        $ch = curl_init();
        if (defined('CURL_CA_BUNDLE_PATH')) {
            curl_setopt($ch, CURLOPT_CAINFO, CURL_CA_BUNDLE_PATH);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if (isset($postData)) {
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        $response = curl_exec($ch);
        $this->http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->last_api_call = $url;
        curl_close ($ch);

        return $response;
    }

   /* wrap some API methods up for ease of use! */

   /**
    *	Set Twitter Status
    *
	*	API Call: updates the status of the current Twitter user to
	*	$message contents
	*
    *	@return array
	*	@access public
    */
    public function setStatus($message)
    {
        if ($this->loggedIn()) {
            return $this->jsonRequest($this->_config['urlStatusUpdate'], 'POST', array('status' => $message));
        }

        return false;
    }

	/**
	 *	Get Replies
	 *
	 *	API Call: Retrieve the current users @replies (allows passing
	 *	Twitter API options as arguments)
	 *
	 *	@return OauthRequest Object / array
	 */
    public function getReplies(Array $args = array())
    {
        return $this->jsonRequest($this->_config['urlReplies'], 'GET', $args);
    }

	/**
	 *	Get Status
	 *
	 *	API Call: Retrieve the current users statuses (allows passing
	 *	Twitter API options as arguments)
	 *
	 *	@return OauthRequest Object / array
	 */
    function getStatus(Array $args = array())
    {
        return $this->jsonRequest($this->_config['urlStatusTimeline'], 'GET', $args);
    }

    /**
	 *	Get Rate Limits
	 *
	 *	API Call: Retrieve information on the remaing API rate limits
	 *
	 *	@return array
	 */
    public function getRateLimit()
    {
        if ($this->loggedIn()) {
            return $this->jsonRequest($this->_config['urlRateLimit']);
        }

        return false;
    }
}



