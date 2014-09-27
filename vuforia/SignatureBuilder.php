<?php
class SignatureBuilder{
	
	private $contentType = '';
	private $hexDigest = 'd41d8cd98f00b204e9800998ecf8427e'; // Hex digest of an empty string
	
	public function tmsSignature( $request , $secret_key ){
		
		$method = $request->getMethod();
		// The HTTP Header fields are used to authenticate the request
		$requestHeaders = $request->getHeaders();
		// note that header names are converted to lower case
		$dateValue = $requestHeaders['date'];
		
		$requestPath = $request->getURL()->getPath();
		
		// Not all requests will define a content-type
		if( isset( $requestHeaders['content-type'] ))
			$this->contentType = $requestHeaders['content-type'];
	
		if ( $method == 'GET' || $method == 'DELETE' ) {
			// Do nothing because the strings are already set correctly
		} else if ( $method == 'POST' || $method == 'PUT' ) {
			// If this is a POST or PUT the request should have a request body
			$this->hexDigest = md5( $request->getBody() , false );
			
		} else {
			//print("ERROR: Invalid content type passed to Sig Builder");
		}
		


		$toDigest = $method . "\n" . $this->hexDigest . "\n" . $this->contentType . "\n" . $dateValue . "\n" . $requestPath ;

		//echo $toDigest;
		
		$shaHashed = "";
		
		try {
			// the SHA1 hash needs to be transformed from hexidecimal to Base64
			$shaHashed = $this->hexToBase64( hash_hmac("sha1", $toDigest , $secret_key) );
			
		} catch ( Exception $e) {
			$e->getMessage();
		}
		//echo $shaHashed;
		return $shaHashed;	
	}
	
	private function hexToBase64($hex){
	
		$return = "";
	
		foreach(str_split($hex, 2) as $pair){
	
			$return .= chr(hexdec($pair));
	
		}
	
		return base64_encode($return);
	}
}

?>