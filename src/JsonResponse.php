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
        KEY_MESSAGE     = 'message',
        KEY_CODE        = 'code',
        KEY_DATA        = 'data',

        DONE = true;

    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $headers
     * @param int $httpStatusCode
     * @return Response
     */
    public static function response(
        $data = [], string $message = '',
        int $code = 0,
        array $headers = [],
        int $httpStatusCode = 200
    )
    {
        $code = $code ?: Config::get('json-helper.response_meta_default.code', 0);
        $data = $data ?: Config::get('json-helper.response_meta_default.data', []);
        $message = $message ?: Config::get('json-helper.response_meta_default.message', 'ok');

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
        $hook = Config::get('json-helper.debug_func');
        if (is_callable($hook)) {
            $data = array_merge($data, $hook());
        }

        return [
            $keys[static::KEY_MESSAGE] ?? static::KEY_MESSAGE   => $message,
            $keys[static::KEY_CODE] ?? static::KEY_CODE         => $code,
            $keys[static::KEY_DATA] ?? static::KEY_DATA         => $data,
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