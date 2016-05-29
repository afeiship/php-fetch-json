<?php
/**
 * Created by PhpStorm.
 * User: feizheng
 * Date: 5/29/16
 * Time: 5:08 PM
 */
include '../src/FetchJson.php';

$query_data = [
  'redirect_url' => urlencode('http://www.baidu.com'),
  'scope' => 'wechat'
];

//echo $query_data['scope'];
$url = 'http://ci.com/api/test/account';
$data = [
  'id' => 1
];
$rs = FetchJson::get($url, $data);


print_r($rs);
