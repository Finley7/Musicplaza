<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/landing.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'landing', 'home']);
    $routes->connect('/home.html', ['controller' => 'Pages', 'action' => 'landing']);
    $routes->connect('/login.html', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/register.html', ['controller' => 'Users', 'action' => 'add']);
    $routes->connect('/user-:username.html', ['controller' => 'Users', 'action' => 'view'], ['pass' => ['username']]);
    $routes->connect('/notification-center.html', ['controller' => 'Notifications', 'action' => 'index']);
    $routes->connect('/chat.html', ['controller' => 'Pages', 'action' => 'chat']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

Router::scope('/settings', function(RouteBuilder $routes) {
    $routes->connect('/avatar.html', ['controller' => 'Users', 'action' => 'avatar']);
    $routes->connect('/autograph.html', ['controller' => 'Users', 'action' => 'autograph']);
});

Router::scope('/forum', function(RouteBuilder $routes){
    $routes->connect('/', ['controller' => 'Forums', 'view' => 'index']);

    $routes->connect('/thread/:slug-:id.html', [
        'controller' => 'Threads',
        'action' => 'view'],
        [
            'pass' => ['id', 'slug'],
            'id' => '[0-9]+'
        ]
    );

    $routes->connect('/thread/create/:id.html', [
        'controller' => 'Threads',
        'action' => 'add',
        [
            'pass' => ['id'],
            'id' => '[0-9]+'
        ]
    ]);
});

Router::prefix('ajax', function(RouteBuilder $routes) {
    $routes->fallbacks('DashedRoute');
});

Router::prefix('musicplaza', ['prefix' => 'musicplaza'], function($routes){
    $routes->connect('/search.html', ['controller' => 'Search', 'action' => 'index']);
});

Router::prefix('admin', ['prefix' => 'admin'], function($routes){
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'landing']);
    $routes->connect('/dashboard', ['controller' => 'Pages', 'action' => 'landing', 'home']);
    Router::scope('/settings', function($routes) {
        $routes->connect('/site', ['controller' => 'SiteSettings', 'action' => 'global']);
        $routes->connect('/title', ['controller' => 'SiteSettings', 'action' => 'title']);
    });
    $routes->connect('/users', ['controller' => 'Users']);
    $routes->fallbacks('DashedRoute');
});

Router::prefix('mod', ['prefix' => 'mod'], function($routes){
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'landing']);
    $routes->connect('/dashboard', ['controller' => 'Pages', 'action' => 'landing', 'home']);
    Router::scope('/settings', function($routes) {
        $routes->connect('/site', ['controller' => 'SiteSettings', 'action' => 'global']);
        $routes->connect('/title', ['controller' => 'SiteSettings', 'action' => 'title']);
    });
    $routes->connect('/users', ['controller' => 'Users']);
    $routes->connect('comments', ['controller' => 'Comments']);

    $routes->fallbacks('DashedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
