<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games */
class GamesController extends AppController
{

    public function game()
    {
      $id = $this->getUserId();
      // debug('User ID: ' . $id);

      $this->set(compact('id'));
    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->Auth->user('role') == 'student'){
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        $this->paginate = [
            'contain' => ['Users']
        ];
        $games = $this->paginate($this->Games);

        $this->set(compact('games'));
        $this->set('_serialize', ['games']);
    }

    /**
     * View method
     *
     * @param string|null $id Game id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->Auth->user('role') == 'student'){
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        $game = $this->Games->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('game', $game);
        $this->set('_serialize', ['game']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->Auth->user('role') == 'student'){
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        $game = $this->Games->newEntity();
        if ($this->request->is('post')) {
            $game = $this->Games->patchEntity($game, $this->request->getData());
            if ($this->Games->save($game)) {
                $this->Flash->success(__('The game has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The game could not be saved. Please, try again.'));
        }
        $users = $this->Games->Users->find('list', ['limit' => 200]);
        $this->set(compact('game', 'users'));
        $this->set('_serialize', ['game']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Game id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->Auth->user('role') == 'student'){
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }

        $game = $this->Games->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $game = $this->Games->patchEntity($game, $this->request->getData());
            if ($this->Games->save($game)) {
                $this->Flash->success(__('The game has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The game could not be saved. Please, try again.'));
        }
        $users = $this->Games->Users->find('list', ['limit' => 200]);
        $this->set(compact('game', 'users'));
        $this->set('_serialize', ['game']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Game id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->Auth->user('role') != 'admin'){
          $this->Flash->error('You are not authorized to perform this action');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $game = $this->Games->get($id);
        if ($this->Games->delete($game)) {
            $this->Flash->success(__('The game has been deleted.'));
        } else {
            $this->Flash->error(__('The game could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getUserId(){
      $this->loadModel('Users');
      $user = $this->Users->find()
              ->where(['id' => $this->Auth->user('id')])
              ->toArray();

      $id = $user[0]['id'];
      return $id;

    }
}
