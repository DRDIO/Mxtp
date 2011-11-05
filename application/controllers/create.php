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
class Create_Controller extends Website_Controller {

    function __construct(){
        parent::__construct();
        //$this->session= Session::instance();
        $auth = new Authlite;
        if (!$auth->logged_in()){
            //$this->session->set("requested_url","/".url::current()); // this will redirect from the login page back to this page
            url::redirect('/login');
        }else{
            $this->user = $auth->get_user(); //now you have access to user information stored in the database
        }
    }

    function index(){
        //echo "Create a new playlist";
        //echo $this->user->id;
        $this->template->title .= 'Mix Something Amazing.';
        $this->template->content = View::factory('create');
    }

    function abandon(){
        $auth = new Authlite;
        $auth->logout(true);
    }


} // end Create controller
?>