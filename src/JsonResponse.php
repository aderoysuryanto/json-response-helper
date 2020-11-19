<?php

/**
 * A json response helper for lumen|laravel framework.
 *
 * @author    iluckin <dev@iluckin.cn>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://dev.iluckin.cn/open-source
 */

namespace Turbo\Api\Helper;

use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\JsonResponse as Response;

class JsonResponse
{
    const
        KEY_CODE        = 'code',
        KEY_DATA        = 'data',
        KEY_MESSAGE     = 'message';

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $headers
     * @param int $httpStatusCode
     * @return Response
     */
    public static function response($data = [], string $message = 'OK', int $code = Code::OK, array $headers = [], int $httpStatusCode = Response::HTTP_OK)
    {
        $code = $code ?: Config::get('json-helper.response_meta_default.code', Code::OK);
        $data = $data ?: Config::get('json-helper.response_meta_default.data', []);
        $message = $message ?: Config::get('json-helper.response_meta_default.message', Code::getStatusText(Code::OK));

        return new Response(
            static::makePayload($data, $message, $code), $httpStatusCode, static::withGlobalHeaders($headers)
        );
    }

    /**
     * @param $data
     * @param $message
     * @param $code
     *
     * @return array
     */
    public static function makePayload($data, string $message, int $code)
    {
        $keys = Config::get('json-helper.response_key_map', []);

        return [
            $keys[static::KEY_MESSAGE] ?? static::KEY_MESSAGE   => $message,
            $keys[static::KEY_CODE] ?? static::KEY_CODE         => $code,
            $keys[static::KEY_DATA] ?? static::KEY_DATA         => empty($data) ? (object)[] : $data,
        ];
    }

    /**
     * @param array $headers
     * @return array
     */
    public static function withGlobalHeaders(array $headers = [])
    {
        return array_merge($headers, Config::get('json-helper.global_headers', []));
    }
}