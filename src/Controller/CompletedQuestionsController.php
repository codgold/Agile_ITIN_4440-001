<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompletedQuestions Controller
 *
 * @property \App\Model\Table\CompletedQuestionsTable $CompletedQuestions */
class CompletedQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Answers', 'Users', 'Questions']
        ];
        $completedQuestions = $this->paginate($this->CompletedQuestions);

        $this->set(compact('completedQuestions'));
        $this->set('_serialize', ['completedQuestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Completed Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $completedQuestion = $this->CompletedQuestions->get($id, [
            'contain' => ['Answers', 'Users', 'Questions']
        ]);

        $this->set('completedQuestion', $completedQuestion);
        $this->set('_serialize', ['completedQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $completedQuestion = $this->CompletedQuestions->newEntity();
        if ($this->request->is('post')) {
            $completedQuestion = $this->CompletedQuestions->patchEntity($completedQuestion, $this->request->getData());
            if ($this->CompletedQuestions->save($completedQuestion)) {
                $this->Flash->success(__('The completed question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The completed question could not be saved. Please, try again.'));
        }
        $answers = $this->CompletedQuestions->Answers->find('list', ['limit' => 200]);
        $users = $this->CompletedQuestions->Users->find('list', ['limit' => 200]);
        $questions = $this->CompletedQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('completedQuestion', 'answers', 'users', 'questions'));
        $this->set('_serialize', ['completedQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Completed Question id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $completedQuestion = $this->CompletedQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $completedQuestion = $this->CompletedQuestions->patchEntity($completedQuestion, $this->request->getData());
            if ($this->CompletedQuestions->save($completedQuestion)) {
                $this->Flash->success(__('The completed question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The completed question could not be saved. Please, try again.'));
        }
        $answers = $this->CompletedQuestions->Answers->find('list', ['limit' => 200]);
        $users = $this->CompletedQuestions->Users->find('list', ['limit' => 200]);
        $questions = $this->CompletedQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('completedQuestion', 'answers', 'users', 'questions'));
        $this->set('_serialize', ['completedQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Completed Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $completedQuestion = $this->CompletedQuestions->get($id);
        if ($this->CompletedQuestions->delete($completedQuestion)) {
            $this->Flash->success(__('The completed question has been deleted.'));
        } else {
            $this->Flash->error(__('The completed question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
