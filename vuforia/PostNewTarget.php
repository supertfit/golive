<?php
require_once 'VWSConstants.php';
require_once 'HTTP/Request2.php';
require_once 'SignatureBuilder.php';

// See the Vuforia Web Services Developer API Specification - https://developer.vuforia.com/resources/dev-guide/retrieving-target-cloud-database
// The PostNewTarget sample demonstrates how to update the attributes of a target using a JSON request body. This example updates the target's metadata.

class PostNewTarget{

	//Server Keys	
	private $requestPath 	= "/targets";
	private $request;       // the HTTP_Request2 object
	private $jsonRequestObject;
	
	private $imageLocation 	= "";
	
	function PostNewTarget(){
		
	}
	
	function getImageAsBase64(){
		
		$file = file_get_contents( $this->imageLocation );
		
		if( $file ){
			
			$file = base64_encode( $file );
		}
		
		return $file;
	
	}

	public function execPostNewTarget(){

		$this->request = new HTTP_Request2();
		$this->request->setMethod( HTTP_Request2::METHOD_POST );
		$this->request->setBody( $this->jsonRequestObject );

		$this->request->setConfig(array(
				'ssl_verify_peer' => false
		));

		$this->request->setURL( VWSAPI_SERVER_PATH . $this->requestPath );

		// Define the Date and Authentication headers
		$this->setHeaders();


		try {

			$response = $this->request->send();

			if (200 == $response->getStatus() || 201 == $response->getStatus() ) {
				return $response->getBody();
			} else {
				return $response->getStatus();
			}
		} catch (HTTP_Request2_Exception $e) {
			return $e;
		}


	}

	private function setHeaders(){
		$sb = 	new SignatureBuilder();
		$date = new DateTime("now", new DateTimeZone("GMT"));

		// Define the Date field using the proper GMT format
		$this->request->setHeader('Date', $date->format("D, d M Y H:i:s") . " GMT" );
		
		$this->request->setHeader("Content-Type", "application/json" );
		// Generate the Auth field value by concatenating the public server access key w/ the private query signature for this request
		$this->request->setHeader("Authorization" , "VWS " . VWSAPI_SERVER_ACCESSKEY . ":" . $sb->tmsSignature( $this->request , VWSAPI_SERVER_SECRETKEY ));

	}
	
	public function SetRequestPath($str_targetName, $str_location, $str_metadata) {
		$this->imageLocation = $str_location;
		$this->jsonRequestObject = json_encode( array( 'width'=>640.0 , 'name'=>$str_targetName, 'image'=>$this->getImageAsBase64() , 'application_metadata'=>base64_encode( $str_metadata ) , 'active_flag'=>1 ) );		
	}
}
?>
