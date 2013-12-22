<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $layout = 'bootstrap';

	public $helpers = array(
		'Time',
		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
	);

	public $components = array(
		'Session',
		'Auth' => array(
			'loginAction'    => '/',
			'loginRedirect'  => array('controller' => 'users', 'action' => 'dashboard'),
			'logoutRedirect' => '/',
			'authorize'      => array('Controller'),
			'authError'      => 'You need to be logged in to view this page.',
			'authenticate'   => array(
				'Blowfish'   => array(
					'fields' => array('username' => 'email'),
				)
			)
		)
	);

	public function beforeFilter() {
		$this->Auth->allow(array(
			'all',
			'forgot_password',
			'reset_password',
			'display',
			'alpha_omega',
			'login',
			'logout'
		));
	}

	public function isAuthorized($user) {
		return false;
	}
}
