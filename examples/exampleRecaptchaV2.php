<?php

use AntiCaptcha\RecaptchaV2;

include("../src/Anticaptcha.php");
include("../src/RecaptchaV2.php");

$api = new RecaptchaV2();
$api->setVerboseMode(true);
        
//your anti-captcha.com account key
$api->setKey(readline("You API key: "));
 
//recaptcha key from target website
$api->setWebsiteURL("http://http.myjino.ru/recaptcha/test-get.php");
$api->setWebsiteKey("6Lc_aCMTAAAAABx7u2W0WPXnVbI_v6ZdbM6rYf16");
 
//proxy access parameters
$api->setProxyType("http");
$api->setProxyAddress(readline("Proxy address: "));
$api->setProxyPort(readline("Proxy port: "));
$api->setProxyLogin(readline("Proxy login (if any): "));
$api->setProxyPassword(readline("Proxy password (if any): "));

//browser header parameters
$api->setUserAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116");

if (!$api->createTask()) {
    $api->debout("API v2 send failed - ".$api->getErrorMessage(), "red");
    return false;
}

$taskId = $api->getTaskId();


if (!$api->waitForResult()) {
    $api->debout("could not solve captcha", "red");
    $api->debout($api->getErrorMessage());
} else {
    $recaptchaToken =   $api->getTaskSolution();
    echo "\ntoken result: $recaptchaToken\n\n";
}
