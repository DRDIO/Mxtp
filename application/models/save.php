<?php
class Save_Model extends Model {
 
	public function __construct()
	{
		// load database library into $this->db (can be omitted if not required)
		parent::__construct();
		$this->db = Database::instance();
	}
 
	public function createPlaylist($title, $user_id)
	{
		$hash = $this->createValidHash(6);
		$insert = $this->db->insert('playlists', 
		 						array(	'title' => $title, 
		 								'hash' => $hash, 
		 								'user_id' => $user_id )
		 						);
		$id = $insert->insert_id();
		 						
		return array('id' =>$id, 'hash' => $hash);
	}
	
	public function saveSong($playlist_id, $song_title, $youtube_id)
	{

		$insert = $this->db->insert('songs', 
		 						array(	'playlist_id' => $playlist_id, 
		 								'title' => $song_title,
		 								'youtube_id' => $youtube_id )
		 						);
		 	
	}
	
    private function createValidHash ($hashLen)
    {
        $getHash = $this->createHash($hashLen);
        if($this->checkHash($getHash)) {
            return $getHash;
        } else {
            $this->createValidHash($hashLen);
        }
    }
	
	
	private function createHash ($length) {
	
        $charSet  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charSet .= "abcdefghijklmnopqrtstuvwxyz";
        $charSet .= "0123456789";
 
        $maxLen = strlen($charSet)-1;
        $minLen = 0;
 
        $hash = "";
        
        $hashLen = mt_rand(1, $length);
 
        for ($i=0; $i< $hashLen; $i++)
        {
            $charPos = mt_rand(0, $maxLen);
            $hash .= $charSet[$charPos];
        }
 
        return $hash;
    }
    
    private function checkHash($hash)
    {
        // create WHERE clause
        $query = 'SELECT hash FROM playlists WHERE hash = "'.$hash.'"';
        
        // call select method from database class
        $get = $this->db->query($query);
        //echo $get->count();
        // return results
       
        if ($get->count() == false) {
            return true;
        } else {
            return false;
        }
    }
    
}
 ?>