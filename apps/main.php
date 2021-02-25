<?php
include __DIR__.'/vendor/autoload.php';

use Discord\Discord;

$discord = new Discord([
	'token' => '',
]);

$discord->on('ready', function ($discord) {
	echo "Bot is ready!", PHP_EOL;

	$discord->on('message', function ($message, $discord) {
	 	if($message->channel_id == '') {
            echo "{$message->channel_id} : {$message->author->username}: {$message->content}",PHP_EOL;
            
	        $curl = curl_init();
	        curl_setopt_array($curl, array(
	            CURLOPT_URL => "https://usdt-trade.com",
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_ENCODING => "",
	            CURLOPT_MAXREDIRS => 10,
	            CURLOPT_TIMEOUT => 30,
	            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	            CURLOPT_CUSTOMREQUEST => "GET",
	            CURLOPT_POSTFIELDS => json_encode(array(
	                'channel_id' => $message->channel_id,
	                'username' => $message->author->username,
	                'content' => $message->content,
	            )),
	            CURLOPT_HTTPHEADER => array(
	                "content-type: application/json",
	            ),
	        ));

	        $response = curl_exec($curl);
	        curl_close($curl);
	 	}
	});
});

$discord->run();