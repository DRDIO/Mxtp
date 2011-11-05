<?php

class Profile_Model extends Model_Core
{
    public function getUserId($userName)
    {
        if (!$userName) {
            return false;
        }

        $user = $this->db
        ->from('users')
        ->select('id')
        ->where('username', $userName)
        ->limit(1)
        ->get();

        if (sizeof($user)) {
            return $user[0]->id;
        }

        return false;
    }

    public function getSelfMixes($userId)
    {
        $mixes = $this->db
        ->from('playlists as p')
        ->select(array(
                'p.id',
				'p.title',
				'p.hash'))
        ->where('p.user_id', $userId)
        ->where('p.flag_active', true)
        ->orderBy('p.order')
        ->orderBy('p.id', 'DESC')
        ->limit(100)
        ->get();

        if (sizeof($mixes)) {
            return $mixes;
        }

        return false;
    }

    public function getFavMixes($userId)
    {
        $mixes = $this->db
        ->from('playlists as p')
        ->select(array(
                'p.id',
				'p.title',
				'p.hash',
				'u.username'))
        ->join('users as u', array(
				'u.id' => 'p.user_id'))
        ->join('users_favorites as f', array(
				'f.playlist_id' => 'p.id'))
        ->orWhere(array('f.user_id' => $userId))
        ->orderBy('p.id')
        ->limit(100)
        ->get();

        if (sizeof($mixes)) {
            return $mixes;
        }

        return false;
    }

    public function deleteMix($playlistId, $userId)
    {
        $result = $this->db->update('playlists', array('flag_active' => false), array('id' => $playlistId, 'user_id' => $userId));
        return (bool) sizeof($result);
    }

    public function getMixesOrder($userId)
    {
        $result = $this->db
        ->from('playlists')
        ->select(array('id', 'order'))
        ->where('user_id', $userId)
        ->get();

        if (sizeof($result)) {
            $mixes = array();
            foreach ($result as $row) {
                $mixes[$row->id] = $row->order;
            }
            return $mixes;
        }

        return false;
    }

    public function setMixesOrder($userId, $diffOrder) {
        foreach ($diffOrder as $id => $order) {
            $request = $this->db->update('playlists', 
                array('order' => $order), 
                array('user_id' => $userId, 'id' => $id));
            if (!sizeof($request)) {
                return false;
            }
        }
        return true;
    }
    
    public function setMixTitle($userId, $playlistId, $title) {
        $result = $this->db->update('playlists', 
            array('title' => $title), 
            array('id' => $playlistId, 'user_id' => $userId));   
        return (bool) sizeof($result);
    }
}