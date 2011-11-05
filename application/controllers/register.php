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
class Register_Controller extends Website_Controller {

    function __construct(){
        $this->db = Database::instance();
        parent::__construct();
    }

    function index()
    {
        $this->template->title .= 'Sign Up. Mix It.';
        $this->template->content = View::factory('register_view');
    }

    function save()
    {

        $post = new Validation($_POST);
        //
        // Adding rules for feilds.
        //
        $post->add_rules('username', 'required', 'length[3,20]');
        $post->add_callbacks('username', array($this, '_unique_username'));
        $post->add_rules('email', 'required', 'valid::email');
        $post->add_callbacks('email', array($this, '_unique_email'));
        $post->add_rules('password', 'required');


        if($post->validate())
        {
            $form_data = $this->input->post();

            $user_name	= $form_data['username'];
            $email		= $form_data['email'];
            $password	= $form_data['password'];
            $hidden_password = md5($password);

            $status = $this->db->insert('users', array('username' => $user_name, 'email' => $email, 'password' => $hidden_password));
            url::redirect('login');

        }
        else
        {
            echo 'Validation errors were found '.'<br />';
            $errors = $post->errors();
            foreach ($errors as $key => $val)
            {
                echo $key.' failed rule '.$val.'<br />';
            }
        }
    }

    public function _unique_email(Validation $array, $field)
    {
        // check the database for existing records
        $query = "SELECT email FROM users where email = '$array[$field]'";
        $email_exists = $this->db->query($query);

        if ($email_exists->count() > 0)
        {
            // add error to validation object
            $array->add_error($field, 'email_exists');
        }
    }

    public function _unique_username(Validation $array, $field)
    {
        // check the database for existing records
        $query = "SELECT username FROM users WHERE username = '$array[$field]'";
        $username_exists = $this->db->query($query);

        if ($username_exists->count() > 0)
        {
            // add error to validation object
            $array->add_error($field, 'Username is already in use.');
        }
    }

}
?>