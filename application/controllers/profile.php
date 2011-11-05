<?php

/**
 *
 * @author kevin
 *
 */
class Profile_Controller extends Website_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Profile_Model();
    }

    public function index()
    {
        $isUser = false;
        
        // Get the default logged in user or if a name is provided, show another user
        if ($this->uri->segment(1) == 'profile') {
            $userId = $this->requireLogin();            
            $isUser = true;
        } else {
            $userName = $this->uri->segment(2);
            $userId   = $this->model->getUserId($userName);
            if (!$userId) {
                url::redirect('/');
            }

            // Check if it is the same user, allow edits
            if($this->loggedIn && $userId == $this->user->id) {
                $isUser = true;
            }
        }

        $selfMixes = $this->model->getSelfMixes($userId);
        $favMixes  = $this->model->getFavMixes($userId);

        $this->template->title     .= 'Organize It.';
        $this->template->jsFiles[]  = 'js/profile.js';
        $this->template->cssFiles[] = 'css/profile.css';

        $this->template->content = View::factory('profile/index', array(
            'selfMixes' => $selfMixes,
            'favMixes'  => $favMixes,
            'isUser'    => $isUser));
    }

    public function deletemix()
    {
        // Force to be ajax and login only, get user id
        $userId = $this->requireAjax(true);

        // Get user from auth and playlist from POST
        $playlistId = $this->uri->segment(3);

        if ($playlistId) {
            // Delete the playlist for this user
            // TODO: Add additional checks for wrong user, etc
            $result = $this->model->deleteMix($playlistId, $userId);
            if ($result) {
                $this->renderJson(true);
            }
        }

        $this->renderJson();
    }

    public function reordermixes()
    {
        // Force to be ajax and login only, get user id
        $userId    = $this->requireAjax(true);
        $postOrder = $this->input->post('order', null, true);
        parse_str($postOrder, $postOrder);

        if (isset($postOrder['mix'])) {
            $newOrder  = array_flip($postOrder['mix']);
            $oldOrder  = $this->model->getMixesOrder($userId);
            if ($oldOrder) {
                $diffOrder = array_diff_assoc($newOrder, $oldOrder);
                Kohana::log('alert', var_export(array($diffOrder, $newOrder, $oldOrder), true));

                $result = $this->model->setMixesOrder($userId, $diffOrder);
                if ($result) {
                    $this->renderJson(true);
                }
            }
        }

        $this->renderJson(false, array('order' => 'test'));
    }

    public function editmixtitle()
    {
        // Force to be ajax and login only, get user id
        $userId     = $this->requireAjax(true);
        $playlistId = $this->uri->segment(3);
        $newTitle   = $this->input->post('title', null, true);

        if ($playlistId && $newTitle) {
            $result = $this->model->setMixTitle($userId, $playlistId, $newTitle);
            if ($result) {
                $this->renderJson(true);
            }
        }

        $this->renderJson(false);
    }
}