<?php

/**
 * Created by PhpStorm.
 * User: feizheng
 * Date: 5/29/16
 * Time: 5:06 PM
 */
class FetchJson
{
  public static function request($inUrl, $inMethod = 'POST', $inData, $inHeaders = [])
  {
    $headers = array_merge([
      'Content-Type: application/json; charset=utf-8',
    ], $inHeaders);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $inUrl);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $inData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $inMethod);
    curl_close($ch);

    return [
      'code' => $httpCode,
      'data' => json_decode($response)
    ];
  }


  public static function get($inUrl, $inData, $inHeaders = [])
  {
    $query_string = http_build_query($inData);
    $http_url = implode('?', [$inUrl, $query_string]);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $http_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $inHeaders);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [
      'code' => $httpCode,
      'data' => json_decode($response)
    ];
  }

  public static function post($inUrl, $inData, $inHeaders = [])
  {
    return self::request($inUrl, 'POST', $inData, $inHeaders);
  }

  public static function put($inUrl, $inData, $inHeaders = [])
  {
    return self::request($inUrl, 'PUT', $inData, $inHeaders);
  }

  public static function delete($inUrl, $inData, $inHeaders = [])
  {
    return self::request($inUrl, 'DELETE', $inData, $inHeaders);
  }
}
