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
  $sessionId = '27c0a22c-a226-48aa-91b5-23a07f1b5a9f!1654996893555!8+0mYpddhM3kx+CJOrOxAjrQIDg=';
  $affinity = '99b51fa0';
  $url = 'https://d.la1-c2-ia4.salesforceliveagent.com/chat/rest/Chasitor/ChatMessage';
  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/json\r\n" . 
              "X-LIVEAGENT-API-VERSION: 50\r\n" . 
              "X-LIVEAGENT-SESSION-KEY: $sessionId\r\n" .
              "X-LIVEAGENT-AFFINITY: $affinity\r\n" ,
          'method'  => 'POST',
          'content' => '{
              text: " ' . $message . '"
          }'
      )
  );
  $context  = stream_context_create($options);
  $result = json_decode(file_get_contents($url, false, $context));
  if ($result === FALSE) {

  }
  
}

?>