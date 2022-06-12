<?php
$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

// Set this Verify Token Value on your Facebook App 
if ($verify_token === 'testtoken') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);

error_log(json_encode($input));
$url = 'https://d.la1-c2-ia4.salesforceliveagent.com/chat/rest/System/SessionId';
  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "X-LIVEAGENT-API-VERSION: 48\r\n" . "X-LIVEAGENT-AFFINITY: null\r\n",
          'method'  => 'GET'
      )
  );
  $context  = stream_context_create($options);
  $result = json_decode(file_get_contents($url, false, $context));
  if ($result === FALSE) {

  }
  iniciateChatSession($result->key, $result->affinityToken);
  sendMessage($result->key, $result->affinityToken, $input["entry"][0]["changes"][0]["value"]["messages"][0]["text"]["body"]);

function sendMessage($sessionId, $affinity, $message) {
  error_log($message);
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
  error_log(json_encode($result));
  if ($result === FALSE) {

  }
  
}

function iniciateChatSession($sessionKey, $affinity){
  $url = 'https://d.la1-c2-ia4.salesforceliveagent.com/chat/rest/Chasitor/ChasitorInit';
  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/json\r\n" . 
                      "X-LIVEAGENT-API-VERSION: 50\r\n" . 
                      "X-LIVEAGENT-SESSION-KEY: $sessionKey\r\n" .
                      "X-LIVEAGENT-AFFINITY: $affinity\r\n" .
                      "X-LIVEAGENT-SEQUENCE: 1\r\n",
          'method'  => 'POST',
          'content' => '{
              "organizationId":"00D4R0000007tWz",
              "deploymentId":"5724R000000c2nq",
              "buttonId":"5734R000000c3JX",
              "sessionId": null,
              "trackingId":"",
              "userAgent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36",
              "language":"es-US",
              "screenResolution":"1366x768",
              "visitorName":"Santiago",
              "prechatDetails":[
              {
                  "label":"UalaUsername",
                  "value":"batman",
                  "entityMaps":[
                      {
                          "entityName": "Account",
                          "fieldName": "c__UalaUsername",
                          "isFastFillable": true,
                          "isAutoQueryable": true,
                          "isExactMatchable": true
                      }
                  ],
                  "transcriptFields":[],
                  "displayToAgent":true
              },
              {
                  "label":"Country",
                  "value": "032",
                  "entityMaps":[],
                  "transcriptFields":[],
                  "displayToAgent":true
              }
              ],
              "buttonOverrides":[
          
              ],
              "receiveQueueUpdates":false,
              "prechatEntities":[],
              "isPost":false,
              "visitorInfo":{
              "visitCount":2,
              "originalReferrer":"",
              "pages":[
                  {
                      "location":"",
                      "time":1591808266234
                  }
              ]
              }
          }'
      )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) {

  }
}
?>