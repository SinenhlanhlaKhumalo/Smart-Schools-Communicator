<?php
 
	function send_notification($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array('registration_ids'=>$tokens,'data'=>$message);
		$headers = array('Authorization:key= AAAAO9Ugs4o:APA91bH25HBOSIWmbxn2QWjej4NTAYUnzGdXE-zOh0cFvF9PXcK4iFbiYfPNr8G923SBe_2k1F_zVJZSnZYDTS2Wxr0G7fKpo6vdrsvcPNP1VJKHD3hTbSMY2gUO7iZu40-Dq0UtBZ_H','Content-Type:application/json');
		
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
	
	function notify($message,$conn,$school,$receiver,$tableName)
	{

		$query = "Select device_id From ".$tableName." WHERE school='$school' AND type='$receiver'";
		$result=$conn->query($query);
		if($result->num_rows > 0)
		{
		   $tokens = array();
		   while($row = $result->fetch_assoc())
		   {
			 $tokens[] = $row["device_id"];
		   }
		}
		$message_status = send_notification($tokens, $message);

	} 
?>