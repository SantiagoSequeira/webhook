<?php
$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

// Set this Verify Token Value on your Facebook App 
if ($verify_token === 'testtoken') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);

error_log(json_encode($input));


sendMessage($input->entry[0]->changes[0]->value->messages[0]->text->body);

function sendMessage($message) {
  $sessionId = '3fd1bab6-c74e-4eec-b862-f0831b67161c!1654998450693!qXxrApROx00Ahpdk08ecD9WA8cE=';
  $affinity = '99b41fa0';
  $url = 'https://d.la1-c2-ia4.salesforceliveagent.com/chat/rest/Chasitor/ChatMessage';
  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/json\r\n" . 
              "X-LIVEAGENT-API-VERSION: 50\r\n" . 
              "X-LIVEAGENT-SESSION-KEY: $sessionId\r\n" .
              "X-LIVEAGENT-AFFINITY: $affinity\r\n" ,
          'method'  => 'POST',
          'content' => "{
              text: \"$message\"
          }"
      )
  );
  $context  = stream_context_create($options);
  $result = json_decode(file_get_contents($url, false, $context));
  if ($result === FALSE) {

  }
  
}

?>