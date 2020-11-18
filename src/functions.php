<?php

/**
 * A json response helper for lumen|laravel framework.
 *
 * @author    iluckin <dev@iluckin.cn>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://dev.iluckin.cn/open-source
 */

if (! function_exists('success')) {

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $headers
     * @param int $httpStatusCode
     * @return \Illuminate\Http\JsonResponse
     */
    function success($data = [], string $message = '', int $code = 0, array $headers = [], int $httpStatusCode = 200)
    {
        return Turbo\Api\Helper\JsonResponse::response(
            $data, $message, $code, $headers, $httpStatusCode
        );
    }
}

if (! function_exists('fail')) {

    /**
     * @param string $message
     * @param int $code
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    function fail(string $message = 'fail.', int $code = 5000, $data = [], array $headers = [], int $httpStatusCode = 200)
    {
        return Turbo\Api\Helper\JsonResponse::response(
            $data, $message, $code, $headers, $httpStatusCode
        );
    }
}