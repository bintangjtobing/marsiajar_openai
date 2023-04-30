<?php

require __DIR__ . '/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;
$open_ai = new OpenAi ('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');
// get prompt parameter
$prompt = $_GET['prompt'];
// set api data
$complete = $open_ai->completion([
    'model' => 'text-davinci-003',
    'prompt' => $prompt,
    'temperature' => 1,
    'max_tokens' => 4000,
    'top_p' => 1,
    'frequency_penalty' => 0,
    'presence_penalty' => 0,
    'stream' => true
], function($curl_info, $data){
    // now we will get stream data
    echo $data;
    echo PHP_EOL;
    ob_flush();
    flush();
    return strlen($data);
});
?>