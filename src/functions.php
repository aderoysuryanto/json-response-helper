<?php

/**
 * A json response helper for lumen|laravel framework.
 *
 * @author    iluckin <dev@iluckin.cn>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://dev.iluckin.cn/open-source
 */

use Turbo\Api\Helper\Code;
use Symfony\Component\HttpFoundation\JsonResponse as Response;

if (! function_exists('success')) {

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $headers
     * @param int $httpStatusCode
     * @return Response
     */
    function success($data = [], string $message = 'OK', int $code = Code::OK, array $headers = [], int $httpStatusCode = Response::HTTP_OK)
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
     * @param int $httpStatusCode
     * @return Response
     */
    function fail(string $message = 'Fail', int $code = Code::FAIL, $data = [], array $headers = [], int $httpStatusCode = Response::HTTP_OK)
    {
        return Turbo\Api\Helper\JsonResponse::response(
            $data, $message, $code, $headers, $httpStatusCode
        );
    }
}

if (! function_exists('status_text')) {

    /**
     * @param int $code
     * @return string
     */
    function status_text(int $code) : string
    {
        return Turbo\Api\Helper\Code::getStatusText($code);
    }
}