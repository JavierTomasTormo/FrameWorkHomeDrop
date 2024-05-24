<?php
class middleware{
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-//
    public static function decode_username($get_token){
		$jwt = parse_ini_file(UTILS . "JWT.ini");
		$secret = $jwt['JWT_SECRET'];
		$token = $get_token;

		$JWT = new JWT;
		$json = $JWT -> decode($token, $secret);
		$json = json_decode($json, TRUE);

        $decode_user = $json['name'];
        return $decode_user;
    }
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-//
	public static function decode_exp($get_token){
		$jwt = parse_ini_file(UTILS . "JWT.ini");
		$secret = $jwt['JWT_SECRET'];
		$token = $get_token;

		$JWT = new JWT;
		$json = $JWT -> decode($token, $secret);
		$json = json_decode($json, TRUE);

        $decode_exp = $json['exp'];
        return $decode_exp;
    }
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*--*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-//
	public static function encode($user) {
        $jwt = parse_ini_file(UTILS . "JWT.ini");

        $header = $jwt['JWT_HEADER'];
        $secret = $jwt['JWT_SECRET'];
        $payload = json_encode(['iat' => time(), 'exp' => time() + (60 * 60), 'name' => $user]);

        $JWT = new jwt();
        return $JWT -> encode($header, $payload, $secret);
    }
}