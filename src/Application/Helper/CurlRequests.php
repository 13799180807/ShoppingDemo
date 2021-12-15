<?php
namespace Application\Helper;

class CurlRequests
{
    /**
     * @param $url
     * @return bool|string
     */
    public static function get($url){
        $header = array(
            'Accept: application/json',
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($curl);

        if (curl_error($curl)) {
            print "Error: " . curl_error($curl);
        } else {
            curl_close($curl);
            return $data;
        }
    }

    /**
     * @param $url
     * @param $postData
     * @return bool|string
     */
    public static function post( $url, $postData ){
            $header = array(
                'Accept: application/json',
            );
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE );
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE );
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            $data = curl_exec($curl);
            if (curl_error($curl)) {
                print "Error: " . curl_error($curl);
            } else {
                curl_close($curl);
                return $data;
            }
    }
}