<?php

/**
 *
 * @author kevin
 *
 */
class Twitter_Controller extends Website_Controller
{
    /**
     * @var Twitter_Core
     */
    public $twitter;

    public function __construct()
    {
        parent::__construct();

        $this->requireLogin();

        // $twitterConf = Kohana::config('twitter');
        $this->model   = new Twitter_Model();
    }

    public function index()
    {
        // TODO: Get secret and token from user table
        $twitter = new Twitter('twitter.default');
        $access  = $this->model->getAccess($this->user->id);
        $user    = $twitter->loggedIn($access);

        $this->template->content = View::factory('twitter/index', array(
            'twitterLoggedIn' => (bool) $user,
            'twitterUser'     => (array) $user));
    }

    public function login()
    {
        $twitter = new Twitter();

        if($twitter->loggedIn()) {
            url::redirect('/twitter');
        }

        // Not logged in, so start the authorization process
        if ($twitter->approved()) {
            $accessToken = $twitter->getAccessToken();
            if ($accessToken) {
                $this->model->updateAccess($this->user->id, $accessToken);

                url::redirect('/twitter');
            }

            die('Could not Login!');

            // TODO: Database update
        } else {
            $url = $twitter->getAuthUrl();
            if ($url) {
                url::redirect($url);
            }

            die('Could not contact Twitter!');
        }
    }

    public function logout()
    {
        $twitter = new Twitter();
        if ($twitter->destroyToken()) {
            $this->model->clearAccess($this->user->id);
            url::redirect('/twitter');
        }

        die('Could not Logout!');
    }
}
