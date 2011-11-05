<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Login_Controller extends Website_Controller
{
    public function __construct() {
        parent::__construct();
        if ($this->loggedIn) {
            url::redirect('/');
        }
    }

    function index()
    {
        $this->template->title .= 'Login.';
        $this->template->content = View::factory('login')
        ->bind('redirect', $this->redirect);
    }

    function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $redirect = $_POST['redirect'];

        $authlite = new Authlite;

        $user = $authlite->login($username, $password, TRUE);
        $get  = $authlite->logged_in();

        if($get){
            url::redirect($redirect);
        }else{
            url::redirect('/login');
        }
    }
}
