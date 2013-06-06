<?php
App::uses('AppController', 'Controller');
/**
 * Players Controller
 *
 * @property Player $Player
 */
class BoardsController extends AppController
{

	public $uses = array('Game', 'User');

	public function beforeFilter() {
		$this->Auth->allow('all');
	}

/**
 * all method
 *
 * @return void
 */
	public function all()
	{
		$loggedIn = $this->Auth->user('id');
		if ($loggedIn !== null) {
			$user = $this->User->find('first', array(
				'conditions' => array('User.id' => $loggedIn)
			));
			$this->set(compact('user'));
		}

		// By rating, main board
		$ratings = $this->User->find('all', array(
			'conditions' => array(
				'OR' => array(
					'User.wins >'   => 0,
					'User.losses >' => 0
				),
				'User.active' => 1
			),
			'order' => array(
				'User.rating DESC'
			)
		));

		// Recent games played
		$this->Game->recursive = 2;
		$games = $this->Game->find('all', array(
			'order' => array(
				'Game.created DESC'
			),
			'limit' => 5
		));

		$this->set('title_for_layout', 'Leaderboard');
		$this->set(compact('ratings', 'sinks', 'hits', 'games'));

	}


}
