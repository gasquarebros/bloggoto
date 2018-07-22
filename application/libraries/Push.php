<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Push
{
protected $ci;

public function __construct()
 {
	$this->ci =& get_instance();
 }
	
 public function  push_message($device_id,$message)
 {
 	// simple loading
 	// note: you have toPushGateway specify API key in config before
    //$this->ci->load->library('gcm');
 
 	// simple adding message. You can also add message in the data,
 	// but if you specified it with setMesage() already
 	// then setMessage's messages will have bigger priority
 	//echo $message;
 	$this->ci->gcm->setMessage($message);
 
 	// add recepient or few
 	$this->ci->gcm->addRecepient($device_id);
 	//$this->ci->gcm->addRecepient('New reg id');
 
 	// set additional data
 /*	$this->ci->gcm->setData(array(
 			'some_key' => 'some_val'
 	)); */
 
 	// also you can add time to live
 	//$this->ci->gcm->setTtl(500);
 	// and unset in further
 	$this->ci->gcm->setTtl(false);
 
 	// set group for messages if needed
 	//$this->ci->gcm->setGroup('Test');
 	// or set to default
 	$this->ci->gcm->setGroup(false);
 
 	//return ($this->ci->gcm->send())? 'success' : 'success';
 	// then send
 	if ($this->ci->gcm->send())
 		echo 'Success for all messages';
 	else
 		echo 'Some messages have errors';
 	//echo "";
 	// and see responses for more info
 	//print_r($this->ci->gcm->status);
 	//print_r($this->ci->gcm->messagesStatuses);

 }
 public function push_message_ios($device_token,$data,$countPush)
 {
	$this->ci->load->config('push_config',true);
	$pushServer=$this->ci->config->item('PushGateway','push_config');
	$keyCertFilePath=$this->ci->config->item('PermissionFile','push_config');
	$passphrase = $this->ci->config->item('PassPhrase','push_config');
	$deviceToken = $device_token;
	
	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', $keyCertFilePath);
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

	// Open a connection to the APNS server
	$fp = stream_socket_client($pushServer, $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
	if (!$fp)
    	 exit("Failed to connect: $err $errstr" . PHP_EOL);
     //echo 'Connected to APNS' . PHP_EOL;

    // Encode the payload as JSON
    $payload = json_encode($data);
      
    // print_r($payload);
    // Build the binary notification
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

     // Send it to the server
     $result = fwrite($fp, $msg, strlen($msg));
	$this->push_log($result.' '.$payload);	
     if (!$result)
	   echo 'Message not delivered' . PHP_EOL;
     else
     {
		echo $device_token.'_Message successfully delivered' . PHP_EOL;
	 }
	//$this->checkAppleErrorResponse($fp); 
     // Close the connection to the server
     fclose($fp);
 } 
  public function sendMessage($device_id,$data)
 {
	$this->ci->load->config('push_config',true);
	$url=$this->ci->config->item('url','push_config');
	$server_key=$this->ci->config->item('server_key','push_config');

	$fields = array (
            'registration_ids' => $device_id,
            'data' =>  $data
    );
	 $fields = json_encode ( $fields );	 
	$headers = array(
		'Content-Type:application/json',
	  'Authorization:key='.$server_key
	);
				
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$result = curl_exec($ch);
	
	// print_r($result);
	$this->push_log($result.' '.$fields);	
	if ($result === FALSE) {
		die('FCM Send Error: ' . curl_error($ch));
	}
	curl_close($ch);
	//return $result;
	}
     function push_log($push_data_array)
    {
    	 $push_array=json_encode($push_data_array);
        $file_name='push_log_'.date('Y_m_d_H_i_s').'.txt';
        $log_file =APPPATH.'/logs/'.$file_name;
        file_put_contents($log_file,$push_array);
    }            
function checkAppleErrorResponse($fp) {

//byte1=always 8, byte2=StatusCode, bytes3,4,5,6=identifier(rowID). 
// Should return nothing if OK.

//NOTE: Make sure you set stream_set_blocking($fp, 0) or else fread will pause your script and wait 
// forever when there is no response to be sent. 

$apple_error_response = fread($fp, 6);

if ($apple_error_response) {

    // unpack the error response (first byte 'command" should always be 8)
    $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response); 

    if ($error_response['status_code'] == '0') {
    $error_response['status_code'] = '0-No errors encountered';

    } else if ($error_response['status_code'] == '1') {
    $error_response['status_code'] = '1-Processing error';

    } else if ($error_response['status_code'] == '2') {
    $error_response['status_code'] = '2-Missing device token';

    } else if ($error_response['status_code'] == '3') {
    $error_response['status_code'] = '3-Missing topic';

    } else if ($error_response['status_code'] == '4') {
    $error_response['status_code'] = '4-Missing payload';

    } else if ($error_response['status_code'] == '5') {
    $error_response['status_code'] = '5-Invalid token size';

    } else if ($error_response['status_code'] == '6') {
    $error_response['status_code'] = '6-Invalid topic size';

    } else if ($error_response['status_code'] == '7') {
    $error_response['status_code'] = '7-Invalid payload size';

    } else if ($error_response['status_code'] == '8') {
    $error_response['status_code'] = '8-Invalid token';

    } else if ($error_response['status_code'] == '255') {
    $error_response['status_code'] = '255-None (unknown)';

    } else {
    $error_response['status_code'] = $error_response['status_code'].'-Not listed';

    }

    echo '<br><b>+ + + + + + ERROR</b> Response Command:<b>' . $error_response['command'] . '</b>&nbsp;&nbsp;&nbsp;Identifier:<b>' . $error_response['identifier'] . '</b>&nbsp;&nbsp;&nbsp;Status:<b>' . $error_response['status_code'] . '</b><br>';

    echo 'Identifier is the rowID (index) in the database that caused the problem, and Apple will disconnect you from server. To continue sending Push Notifications, just start at the next rowID after this Identifier.<br>';

    return true;
}

return false;
}

 
 
}
/* End of file push.php */
/* Location: ./application/libraries/push.php */