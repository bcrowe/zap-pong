<?php
App::uses('AuthComponent', 'Controller/Component');
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	Router::parseExtensions();
	Router::setExtensions(array('json'));

	Router::connect('/', array('controller' => 'boards', 'action' => 'all'));
	Router::connect('/login', array('controller' => 'sessions', 'action' => 'login'));
    Router::connect('/logout', array('controller' => 'sessions', 'action' => 'logout'));
    Router::connect('/dashboard', array('controller' => 'users', 'action' => 'dashboard'));
    Router::connect('/teams', array('controller' => 'users', 'action' => 'random_teams'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	if (AuthComponent::user()) {
		// authenticated routes
	} else {
		// unauthenticated routes
	}

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
