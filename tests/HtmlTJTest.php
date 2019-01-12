<?php

require "../src/HtmlTj.php";
use HtmlTj\HtmlToJson;
$htj = new HtmlToJson();
// 微信内容地址
$testurl ="https://mp.weixin.qq.com/s?__biz=MzAwMDM4Mjg2Nw%3D%3D&mid=2650432558&idx=1&sn=09520d25a65a7c2727d6d11bac60d4ca&scene=45#wechat_redirect";
$html = file_get_contents($testurl);
// 正则匹配
preg_match("/<div class=\"rich_media_content \" id=\"js_content\">(.*?)<\/div>/ism",$html,$arcmat);

//html 转json

$ret = $htj->toJson($arcmat[1]);
dump($ret);
/**
 * 打印函数
 *
 */

function dump($var, $exit = true) {
    echo '<pre>';
    print_r ( $var );
    echo '</pre>';

}
//$url ="https://mp.weixin.qq.com/s?src=11&timestamp=1547276051&ver=1317&signature=dbwag6YCfhHCVfBjszAcNwHpOUIqvvSGh3adjxbAc0L4kpmDW1qQYHm9iZk0G56qi6gC1Unxkr-WFd9J0oJQgYbEohTeyo6D6Lr8guJ1qkvCX7FTm8IpbiQ6OIVmjGiN&new=1";

