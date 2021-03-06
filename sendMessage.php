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

    function iniciateChatSession($sessionId, $affinity){
        $url = 'https://d.la1-c2-ia4.salesforceliveagent.com/chat/rest/Chasitor/ChasitorInit';
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n" . 
                            "X-LIVEAGENT-API-VERSION: 50\r\n" . 
                            "X-LIVEAGENT-SESSION-KEY: $sessionKey\r\n",
                            "X-LIVEAGENT-AFFINITY: $affinity\r\n",
                            "X-LIVEAGENT-SEQUENCE: 1",
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
        var_dump($result);
    }
    
?>