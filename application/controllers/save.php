<?php

/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Save_Controller extends Controller {

    public function __construct()
    {
        // load database library into $this->db (can be omitted if not required)
        parent::__construct();
        $this->save_model = new Save_Model;
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
        $playlist_title = $this->input->post('playListTitle');
        $song_title = $this->input->post('songtitle');
        $youtube_id = $this->input->post('youtubeid');
        $song_count = count($song_title);

        $new_playlist = $this->save_model->createPlaylist($playlist_title, $this->user->id);

        $x = 0;
        while($x < $song_count){
            $title = $song_title[$x];
            $yt_id = $youtube_id[$x];
            $this->save_model->saveSong($new_playlist['id'], $title, $yt_id);
            $x++;
        }

        url::redirect('/listen/'.$new_playlist['hash']);
    }

    function test(){
        $new_playlist = $this->save_model->createPlaylist('test');
        print_r($new_playlist);
    }
}