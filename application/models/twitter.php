<?php

class Twitter_Model extends Model_Core
{
    public function getAccess($userId)
    {
        $access = $this->db
        ->from('service_twitter')
        ->select(array(
            'oauth_token', 
            'oauth_token_secret'))
        ->where('user_id', $userId)
        ->get();
        
        if (sizeof($access)) {
            return $access->result(false)->current();
        }
        
        return null;
    }
    
    public function updateAccess($userId, Array $accessToken)
    {
        $result = $this->db->query('
            INSERT INTO service_twitter (user_id, oauth_token, oauth_token_secret, screen_name)
            VALUES (?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE
                oauth_token        = VALUES(oauth_token),
                oauth_token_secret = VALUES(oauth_token_secret),
                screen_name        = VALUES(screen_name)', 
        array(
            $userId,
            $accessToken['oauth_token'],
            $accessToken['oauth_token_secret'],
            $accessToken['screen_name']));
        
        if ($result->count()) {
            return true;
        }
        
        return false;
    }   
    
    public function clearAccess($userId) 
    {
        $result = $this->db->delete('service_twitter', array('user_id' => $userId));
        return $result->count();
    }
}