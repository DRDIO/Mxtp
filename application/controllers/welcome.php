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
class Welcome_Controller extends Website_Controller
{
    public function index()
    {
        $this->template->title .= 'Mix It. Watch It. Jam It.';
        $this->template->content = new View('welcome_content');
        url::redirect('/listen');
    }
} // End Welcome Controller