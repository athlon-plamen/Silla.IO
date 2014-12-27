<?php
/**
 * Home Controller.
 *
 * @package    Silla
 * @subpackage App\Controllers
 * @author     Plamen Nikolov <plamen@athlonsofia.com>
 * @copyright  Copyright (c) 2015, Silla.io
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace App\Controllers;

use Core;
use Core\Base;
use Core\Modules\Router\Request;

/**
 * Home controller definition.
 */
class Home extends Base\Controller
{
    /**
     * Index action.
     *
     * @param Request $request Current router request.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $this->renderer->assets->add('css/styles.css');
        $this->renderer->assets->add('css/print.css');
        $this->renderer->assets->add('js/init.js');
    }
}
