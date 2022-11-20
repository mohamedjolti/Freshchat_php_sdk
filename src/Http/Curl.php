<?php

namespace Freshchat\Http;

use Exception;

class Curl
{


    /**
     * post
     *
     * @param  mixed $url
     * @param  \StdClass $body
     * @param  mixed $headers
     * @return void
     */
    public function post($url, \stdClass $body, array $headers, bool $isJson)
    {
        $request = $this->createRequest($url, $headers);

        if ($isJson === true) {
            curl_setopt($request, CURLOPT_POSTFIELDS, json_encode($body));
        } else {
            curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($body));
        }

        try {
            return $this->executeRequest($request);
        } catch (Exception $e) {
            throw ($e->getMessage());
        }
    }

    /**
     * createRequest
     *
     * @param  string $url
     * @param  array $headers
     * @return \CurlHandle
     */
    public function createRequest(string $url, array $headers)
    {
        $request = curl_init();

        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($request, CURLINFO_HEADER_OUT, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($request, CURLOPT_VERBOSE, false);

        return $request;
    }

    public function executeRequest($request)
    {
        $body = curl_exec($request);
        $info = curl_getinfo($request);

        curl_close($request);

        $statusCode = $info['http_code'] === 0 ? 500 : $info['http_code'];

        return $statusCode;
    }
}