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
class Logout_Controller extends Website_Controller
{

    function __construct(){
        $this->db = Database::instance();
        parent::__construct();
    }

    function index()
    {
        $authlite = new Authlite();
        $authlite->logout(true);
        url::redirect($this->redirect);
    }
}