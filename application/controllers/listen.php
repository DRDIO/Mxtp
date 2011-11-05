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
class Listen_Controller extends Website_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Listen_Model();
    }

    public function index()
    {
        $mixes = $this->model->get_mixes();
        $users = $this->model->getUsers();
        
        $this->template->title .= 'Find It.';
        $this->template->content = View::factory('listen/index')
        ->bind('users', $users)
        ->bind('mixes', $mixes);
    }

    public function mix()
    {
        $hash    = $this->uri->rsegment(3);
        $userId  = ($this->loggedIn ? $this->user->id : null);
        $dataSet = $this->model->get_playlist($hash, $userId);

        // Check if it is the same user, allow edits
        if($this->loggedIn && $userId == $this->user->id) {
            $isUser = true;
        }

        $this->template->jsFiles[]  = 'js/listen.js';
        
        $this->template->title   .= 'Listen. ' . $dataSet['title'] . '.';
        
        $this->template->content  = View::factory('listen/mix', array(
            'hash'     => $hash,
            'isUser'   => $isUser,
            'playlist' => $dataSet));
    }
}