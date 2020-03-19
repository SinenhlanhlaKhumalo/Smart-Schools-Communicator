<?php
    include("connection.php");
	function send_notification($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array('registration_ids'=>$tokens,'data'=>$message);
		$headers = array('Authorization:key= AAAAhh6Y0fo:APA91bEGhitQlsgLV7YB092KoMjIDTQZvKtx-ATa12TV-_XqV06cIDlAn0RoZ2mFO6RkUv3lsXF9U2DQ-qjIJp4iQdD3rp3H7We4PdfZliIhvO8b0e3-RnXz548LgAz7fSluyGdP3YlT','Content-Type:application/json');
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
		$result = curl_exec($ch);
		if($result === FALSE)
		{
			die('Curl failed: '.curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
	
	function notify($message)
	{
	    $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

		$query = "Select device_token From devices";
		$result=$conn->query($query);
		if($result->num_rows > 0)
		{
		   $tokens = array();
		   while($row = $result->fetch_assoc())
		   {
			$tokens[] = $row["device_token"];
		   }
		}
		$message_status = send_notification($tokens, $message);
		echo $message_status;

	} 
?>