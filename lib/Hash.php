<?php
class Hash {
	/**
	* @param String $algo The algorithm (md5, sha1, whirlpool, etc)
	* @param String $data The data to encode
	* @return String The hashed/ salted data
	*/
	public static function create($algo, $data){
		$context = hash_init($algo, HASH_HMAC, PASSWORD_HASH);
		hash_update($context, $data);
		return hash_final($context);
	}
}
