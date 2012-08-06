<?php

require_once 'config/constants.php';
require_once 'config/WorkbenchConfig.php';
require_once 'shared.php';
require_once 'context/WorkbenchContext.php';
require_once "AsyncJob.php";

// session prep
//$sessionStore = $_ENV['REDISTOGO_URL'];
//$redisUrl = "tcp://" . parse_url($sessionStore, PHP_URL_HOST) . ":" . parse_url($sessionStore, PHP_URL_PORT);
//if (!is_array(parse_url($sessionStore, PHP_URL_PASS))) {
//    $redisUrl .= "?auth=" . parse_url($sessionStore, PHP_URL_PASS);
//}
//
//ini_set("session.save_path", $redisUrl);
//ini_set("session.save_handler", "redis");
//ini_set("session.use_cookies", false);
//ini_set("session.cache_limiter", "");

while (true) {
    $job = AsyncJob::dequeue();

    if ($job == null) {
        continue;
    }

    var_dump($job);
    WorkbenchContext::establish($job->getConnConfig());
    var_dump(WorkbenchContext::get()->getUserInfo());
    WorkbenchContext::get()->release();
}
?>