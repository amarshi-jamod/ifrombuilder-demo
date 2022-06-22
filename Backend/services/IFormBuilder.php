<?php

class IFormBuilder {
    /**
     * Token variable to access IFormBuilder api
     */
    private $token;

    /**
     * Set new JWT token for IFormBuilder
     */
    public function __construct() {
        $this->token = $this->generateToken();
    }
	
    /**
     * Generate IFormBuilder token
     *
     * @param  String $clientKey
     * @param  String $clientSecret
     * @param  String $audValue
     * @param  Integer $expireTime
     * @return String $token
     */
	public function generateToken($clientKey=CLIENT_KEY, $clientSecret=CLIENT_SECRET, $audValue=AUD_VALUE, $expireTime=EXPIRE_TIME) {
		$header = [
            'typ' => 'JWT',
            'alg' => 'HS256',
        ];
		$header = base64_encode(json_encode($header));
		
		$nowtime = time();
		$exptime = $nowtime + $expireTime;
		
		$payload = [
            "iss" => $clientKey,
            "aud" => $audValue,
            "exp" => $exptime,
            "iat" => $nowtime,
        ];
        $payload = base64url_encode(json_encode($payload));
		
		$signature = base64url_encode(hash_hmac('sha256',"$header.$payload",$clientSecret, true));
		$assertionValue = "$header.$payload.$signature";
		
		$grant_type = "urn:ietf:params:oauth:grant-type:jwt-bearer";
		$grant_type = urlencode($grant_type);
		$postFields = "grant_type=".$grant_type."&assertion=".$assertionValue;
		
		$curl = executeCURL($audValue, $postFields);
		
		return 'Bearer '.$curl['response']['access_token'];
	}

    /**
     * Create new record
     *
     * @param  Array $fields
     * @param  String $recordUrl
     * @return Array $response
     */
    public function create($fields, $recordUrl=RECORDURL) {
        $fields = [
            'fields' => [
                [
                    'element_name' => 'name',
                    'value' => $fields['name'],
                ],
                [
                    'element_name' => 'email',
                    'value' => $fields['email'],
                ],
                [
                    'element_name' => 'phone',
                    'value' => $fields['phone'],
                ],
            ],
        ];
        $curl = executeCURL($recordUrl, json_encode($fields), $this->token);

        return [
                'http_status' => $curl['http_status'],
                'response' => $curl['response'],
            ];
    }

    /**
     * Get all record
     * 
     * @param  String $recordUrl
     * @param  String $fields
     * @return Array $response
     */
    public function get($recordUrl=RECORDURL, $fields='id,name,email,phone') {
        $curl = executeCURL($recordUrl.'?fields='.$fields, '', $this->token, FALSE);

        return [
            'http_status' => $curl['http_status'],
            'response' => $curl['response'],
        ];
    }
}