<?php
class Listen_Model extends Model {

	public function __construct()
	{
		// load database library into $this->db (can be omitted if not required)
		parent::__construct();
		$this->db = Database::instance();
	}

	public function getUsers()
	{
        $users = $this->db
            ->from('users as u')
            ->select(array(
                'u.id',
                'u.username',
                'COUNT(p.id) AS mixes'))
            ->join('playlists as p', array(
                'u.id' => 'p.user_id'), null, 'LEFT')
            ->groupBy('u.id')
            ->orderBy('mixes', 'DESC')
            ->orderBy('username')
            ->get();

        if (sizeof($users)) {
            return $users;
        }

        return false;
	}

	public function get_mixes()
	{
	   $sql = '
	       SELECT
	           p.title,
	           p.hash,
	           u.username
	       FROM
	           playlists AS p
	           LEFT JOIN users AS u
	           ON u.id = p.user_id
	       ORDER BY p.id DESC
	       LIMIT 0, 100
	   ';

	   $result = $this->db->query($sql);
	   $data   = $result->result_array(FALSE);

	   if (sizeof($data)) {
	       return $data;
	   }

	   return false;
	}

	public function get_playlist($hash, $userId = null)
	{
		$playlist = FALSE;

		// playlist id and title from playlists table
		$playlist_query = '
			SELECT
				p.id,
				p.title,
				u.username,
				p.user_id,
				f.flag_active favorite
			FROM playlists p
			INNER JOIN users u ON p.user_id = u.id
			LEFT JOIN users_favorites f ON p.id = f.playlist_id AND f.user_id = "' . $userId . '"
			WHERE
				p.hash = "' . $hash . '"
		';

		$playlist_result = $this->db->query($playlist_query);
		$playlist_data = $playlist_result->result_array(FALSE);

		if(count($playlist_data) > 0)
		{
			$playlist_id 	= $playlist_data[0]['id'];
			$playlist_title	= $playlist_data[0]['title'];
			$user_name 		= $playlist_data[0]['username'];
			// get song title and youtube_id from songs table
			$song_query = '	SELECT id, title, youtube_id
							FROM songs
							WHERE playlist_id = '.$playlist_id;
			$song_result = $this->db->query($song_query);
			$song_data = $song_result->result_array(FALSE);

			$playlist = array(
				'id' => $playlist_id,
				'title' => $playlist_title,
				'username' => $user_name,
			    'user_id'  => $playlist_data[0]['user_id'],
				'favorite' => (bool) $playlist_data[0]['favorite'],
				'songs' => $song_data);
		}else{
			$playlist = FALSE;
		}

		//return array
		return $playlist;
	}

}
 ?>