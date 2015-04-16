<?php
/**
 * Silla.IO HTTP Requests dispatcher loader.
 *
 * Execution entry point.
 *
 * @package    Silla.IO
 * @subpackage Core
 * @author     Plamen Nikolov <plamen@athlonsofia.com>
 * @copyright  Copyright (c) 2015, Silla.io
 * @license    http://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3.0 (GPLv3)
 */

use Core\Modules\Router;

/**
 * Require Silla.IO boot loader.
 */
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', 'vendor', 'autoload.php']);

\Silla::boot(isset($_SERVER['HTTP_ENV_SILLA_ENVIRONMENT']) ? $_SERVER['HTTP_ENV_SILLA_ENVIRONMENT'] : 'development');

/**
 * Get Request String.
 */
$requestString = isset($_GET['_path']) ? $_GET['_path'] : '';
unset($_GET['_path']);

try {
    /**
     * Detect Silla.IO Mode.
     */
    $mode = Router\Router::getMode($requestString);
    Core\Config()->setMode($mode);

    /**
     * Setup Router variables.
     */
    $routes  = new Router\Routes($mode);
    $request = new Router\Request($mode, Router\Router::parseRequestQueryString($requestString, $routes), $GLOBALS);

    /**
     * Dispatch Request.
     */
    Core\Router()->dispatch($request, $routes);

} catch(\Exception $e) {
    if (!Core\Router()->response->hasContent()) {
        Core\Router()->response->setHttpResponseCode(500);
    }
    $message = $e->getMessage() . PHP_EOL . $e->getTraceAsString();
    if ('on' === strtolower(ini_get('display_errors'))) {
        Core\Router()->response->setContent("<pre>{$message}</pre>");
    } else {
        error_log($e->__toString());
    }
}

unset($request, $routes);

/**
 * Output Response headers.
 */
if (!headers_sent() && Core\Router()->response->hasHeaders()) {
    $headers = Core\Router()->response->getHeaders();
    foreach ($headers as $header) {
        if (isset($headers['code']) && $headers['code']) {
            header($header['string'], $header['replace'], $header['code']);
        } else {
            header($header['string'], $header['replace']);
        }
    }
}

/**
 * Output Response content.
 */
if (Core\Router()->response->hasContent()) {
    echo Core\Router()->response->getContent();
}
