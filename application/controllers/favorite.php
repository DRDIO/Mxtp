<?php

/**
 *
 * @author kevin
 *
 */
class Favorite_Controller extends Website_Controller
{
    /**
     * @var Favorite_Model
     */
    public $model;

    /**
     *
     * @return unknown_type
     */
    function __construct() {
        parent::__construct();

        if(!$this->loggedIn) {
            url::redirect('/login');
        }

        // Disable templates and get the model
        $this->auto_render = false;
        $this->model 	   = new Favorite_Model();
    }

    /**
     *
     * @return unknown_type
     */
    public function update()
    {
        // Force to be ajax and login only, get user id
        $userId = $this->requireAjax(true);
        
        // Get the default user and playlist
        $playlistId = $this->uri->segment(3);
        
        // If not already a favorite, add it
        $success = $this->model->update($userId, $playlistId);
                
        // Render the JSON
        $this->renderJson($success);
    }
}