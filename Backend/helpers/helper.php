<?php
    /**
     * Encode given string into base64url
     *
     * @param  String $data
     * @return String $base64
     */
    function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

    /**
     * Run CURL using given parameters
     *
     * @param  String $url
     * @param  String $postFields
     * @param  String $token
     * @param  Boolean $post
     * @return Array $response
     */
    function executeCURL($url, $postFields='', $token='', $post=TRUE) {
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, $post);

        if($postFields!='') {
    		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        }
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/x-www-form-urlencoded",
            "cache-control: no-cache",
            "Authorization: ".$token,
		]);
		$response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

        return [
                'http_code' => $http_status,
                'response' => json_decode($response, TRUE),
            ];
    }
