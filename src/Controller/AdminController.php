<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class AdminController extends AppController
{

  public function index(){
    // $this->loadModel('CompletedQuestions');
    $completed_questions = array();
      $completed_questions = $this->findQuestions();
      debug($completed_questions);
  }
  public function groupScores(){
    $sum = 0;
    $total = 0;
    $group_questions = $this->findQuestions();
    foreach($group_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    $mean = $sum / $total;
    $dg_mean = $this->dailyGroupScores('2017-04-28');
    debug($mean);
    debug($dg_mean);
  }

  public function dailyGroupScores($day){
    $date = $day;
    $sum = 0;
    $total = 0;
    $dg_questions = $this->dailyQuestions($date);
    foreach($dg_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    $mean = $sum / $total;
    return $mean;
  }

  public function individualScores($id = null){
    $user = $id;
    $sum = 0;
    $total = 0;
    $individual_questions = $this->individualQuestions($user);
    foreach($individual_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    $mean = $sum / $total;
    $di_mean = $this->dailyIndividualScores($user, '2017-03-22');
    debug($mean);
    debug($di_mean);
  }

  public function dailyIndividualScores($id = null, $day){
    $user = $id;
    $date = $day;
    $sum = 0;
    $total = 0;
    $di_questions = $this->dailyIndividualQuestions($date, $user);
    foreach($di_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    $mean = $sum / $total;
    return $mean;
  }

  public function dailyIndividualQuestions($day, $user){
    $user_id = $user;
    $query_date = $day;
    $this->LoadModel('CompletedQuestions');
    $active = array();
    $active = $this->active();
    $di_questions = $this->CompletedQuestions->find()
        ->where(['user_id' => $user_id, 'date_answered' => $query_date])
        ->toArray();

    debug($di_questions);

    return $di_questions;
  }

  public function individualQuestions($user){
    $user_id = $user;
    $this->LoadModel('CompletedQuestions');
    $individual_questions = $this->CompletedQuestions->find()
        ->where(['user_id' => $user_id])
        ->toArray();

    debug($individual_questions);

    return $individual_questions;
  }


  public function findQuestions(){
    // $query = $CompletedQuestions
    // ->find()
    // ->contain([
    //   'Users' => function ($q) {
    //     return $q->where(['Users.active' => true]);
    //   }
    // ])
    // ->toArray();
    // return $active;
    $this->LoadModel('CompletedQuestions');
    $active = array();
    $active = $this->active();
    // debug($active);
    $completed_questions = $this->CompletedQuestions->find()
        ->where(['user_id IN' => $active])
        ->toArray();

    debug($completed_questions);

    return $completed_questions;
  }

  public function dailyQuestions($date){
    $query_date = $date;
    $this->LoadModel('CompletedQuestions');
    $active = array();
    $active = $this->active();
    $daily_questions = $this->CompletedQuestions->find()
        ->where(['user_id IN' => $active, 'date_answered' => $query_date])
        ->toArray();

    debug($daily_questions);

    return $daily_questions;
  }

  public function active(){
    $this->loadModel('Users');
    $active = $this->Users
     ->find()
     ->select(['id'])
     ->where(['active' => 1])
     ->toArray();

     $x = 0;
     $active_array = array();
     foreach ($active as $senior) {
      //  debug($senior);
       $active_array[$x] = $senior['id'];
       $x++;
     }
     return $active_array;
  }

}
