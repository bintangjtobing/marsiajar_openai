<?php

require_once realpath(__DIR__ . '/vendor/autoload.php');
// Looing for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Orhanerday\OpenAi\OpenAi;
$open_ai = new OpenAi($_ENV['OPEN_AI_API_KEY']);
$open_ai->setORG($_ENV['OPEN_AI_ORG_ID']);
$open_ai->setHeader(["Connection"=>"keep-alive"]);
$open_ai->setBaseURL($_ENV['OPEN_AI_Base_URL']);

// get prompt parameter
$prompt = $_GET['prompt'];

// set header
header('Cache-Control: no-cache');

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