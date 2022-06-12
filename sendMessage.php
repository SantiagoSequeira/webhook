<?php
    $url = 'https://d.la1-c2-ia4.salesforceliveagent.com/chat/rest/System/SessionId';

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "X-LIVEAGENT-API-VERSION: 48\r\n",
            'method'  => 'GET'
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {

    }
    error_log(json_encode($result));
    var_dump($result);
?>