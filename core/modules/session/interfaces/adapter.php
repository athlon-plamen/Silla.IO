<?php
/**
 * Session Adapter Interface.
 *
 * @package    Silla.IO
 * @subpackage Core\Modules\Session\Interfaces
 * @author     Plamen Nikolov <plamen@athlonsofia.com>
 * @copyright  Copyright (c) 2015, Silla.io
 * @license    http://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3.0 (GPLv3)
 */

namespace Core\Modules\Session\Interfaces;

/**
 * Session Adapter definition.
 */
interface Adapter
{
    /**
     * Session Adapter constructor.
     *
     * @param string $scope    Relative path to be used for the session cookie scope.
     * @param string $protocol Protocol name to used for the session cookie.
     * @param array  $settings Configuration settings.
     * @param array  $context  Execution context.
     *
     */
    public function __construct($scope, $protocol, array $settings, array $context);

    /**
     * Session destroy method.
     *
     * @return boolean
     */
    public function destroy();

    /**
     * Generator of session key method.
     *
     * @return string
     */
    public function getKey();

    /**
     * Regeneration of session keys method.
     *
     * @return void
     */
    public function regenerateKey();

    /**
     * Setter method.
     *
     * @param string $name  Variable name.
     * @param mixed  $value Variable value.
     *
     * @return void
     */
    public function set($name, $value);

    /**
     * Getter method.
     *
     * @param string $name Variable name.
     *
     * @return mixed
     */
    public function get($name);

    /**
     * Unset method.
     *
     * @param string $name Variable name.
     *
     * @return boolean
     */
    public function remove($name);
}
