<?php
 
/**
* User model
*/
$config['user_model'] = 'user';
 
/**
* Username column
*/
$config['username'] = 'username';
 
/**
* Password column
*/
$config['password'] = 'password';
 
/**
* Session column
*/
$config['session'] = 'session';
 
/**
* Type of hash to use for passwords. Any algorithm supported by the hash function
* can be used here.
* @see http://php.net/hash
* @see http://php.net/hash_algos
*/
$config['hash_method'] = 'md5';
 
/**
* Set the auto-login (remember me) cookie lifetime, in seconds. The default
* lifetime is two weeks.
*/
$config['lifetime'] = 1209600;
 
/**
* Set the session key that will be used to store the current user.
*/
$config['session_key'] = 'authlite_user';