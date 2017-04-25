<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Date;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    // public function beforeFilter(Event $event)
    // {
    //     parent::beforeFilter($event);
    //     $this->Auth->allow('add');
    // }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->Auth->user('role') == 'admin' || $this->Auth->user('role') == 'teacher'){
          $users = $this->paginate($this->Users);

          $this->set(compact('users'));
          $this->set('_serialize', ['users']);
        }
        else{
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->Auth->user('role') == 'student'){
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        $date = Date::now();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user['active'] = 0;
            $user['role'] = "student";
            $user['date_created'] = $date;
            $user['date_modified'] = $date;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->Auth->user('role') == 'student'){
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $role = $user['role'];

        $date = Date::now();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if($user['role'] == '0'){
              $user['role'] = $role;
            }
            if($user['role'] == '1'){
              $user['role'] = 'admin';
            }
            if($user['role'] == '2'){
              $user['role'] = 'student';
            }
            if($user['role'] == '3'){
              $user['role'] = 'teacher';
            }
            debug($user);
            $user['date_modified'] = $date;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->Auth->user('role') != 'admin'){
          $this->Flash->error('You are not authorized to access this location');
          return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(Event $event){
       $this->Auth->allow(['add','logout']);
   }

   public function login()
   {
       if ($this->request->is('post')) {
           $user = $this->Auth->identify();
           if ($user) {
               $this->Auth->setUser($user);
               return $this->redirect($this->Auth->redirectUrl());
           }
           $this->Flash->error(__('Invalid username or password, try again'));
       }
   }

   public function logout()
   {
       return $this->redirect($this->Auth->logout());
   }
}

// Admin can access every action
//  if (isset($user['role']) && $user['role'] === 'teacher' &&
//  ($this->request->getParam('action') === 'add' ||
//  $this->request->getParam('action') === 'view' ||
//  $this->request->getParam('action') === 'index' ||
//  $this->request->getParam('action') === 'edit')) {
//    return true;
//  }
//
//  if ($this->request->getParam('action') === 'add') {
//    return true;
//  }
//
//  if ($this->request->getParam('action') === 'logout') {
//    return true;
//  }
//
//  // Default deny
//  return false;
