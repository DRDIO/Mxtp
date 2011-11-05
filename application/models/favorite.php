<?php

/**
 *
 * @author kevin
 *
 */
class Favorite_Model extends Model_Core
{
    /**
     *
     * @param $userId
     * @param $playlistId
     * @param $active
     * @return unknown_type
     */
    public function update($userId, $playlistId)
    {
        $result = $this->db->query('
            INSERT INTO users_favorites 
                (user_id, playlist_id)
			VALUES (?, ?) ON DUPLICATE KEY
			UPDATE flag_active = !flag_active', 
        array($userId, $playlistId));
        
        return (bool) $result->count();
    }
}