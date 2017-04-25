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
use Cake\I18n\Date;
use Cake\Event\Event;
use Cake\I18n\Time;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class AdminController extends AppController
{

  function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    $this->viewBuilder()->setLayout('admin_layout');
  }

  public function index(){
    // $this->loadModel('CompletedQuestions');
    // $completed_questions = array();
    //   $completed_questions = $this->findQuestions();
    //   debug($completed_questions);
    // $date = Date::now();
      if($this->Auth->user('role') == 'student'){
        $this->Flash->error('You are not authorized to access this location');
        return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
      }

      $topgames = $this->topScores();
      $this->set(compact('topgames'));
      $this->set('_serialize', ['topgames']);
      $recentgames = $this->topRecent();
      $this->set(compact('recentgames'));
      $this->set('_serialize', ['recentgames']);
    }


  public function advancedGraphs($start = null, $end = null){
    $start = date('Y-m-d', strtotime('2017-03-13'));
    // $start = new Time('2014-01-10 11:11', 'America/New_York');
    $end = date('Y-m-d', strtotime('2017-04-17'));
    // $end = new Time('2014-01-10 11:11', 'America/New_York');
    $incDate = $start;
    $date_array = array();
    $x = 0;
    while(date('Y-m-d', strtotime($incDate)) <= date('Y-m-d', strtotime($end))){
      $date_array[$x] = $incDate;
      $incDate = date('Y-m-d', strtotime($incDate. ' + 1 day'));
      $x++;
    }

    debug($date_array);
    $sum = 0;
    $total = 0;
    $group_questions = $this->findQuestions();
    $this->LoadModel('Games');
    foreach($group_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }

    $rawData = $this->Games->find()
        ->select(['date_complete','score'])
        ->where(['date_complete >' => $start, 'date_complete <' => $end])
        ->toArray();
    $dates = array();
    $scores = array();
    $x = 0;
    foreach($rawData as $data){
      // debug($date['date_complete']);
      $dates[$x] = $data['date_complete'];
      $scores[$x] = $data['score'];
      $x++;
    }
    debug($scores);
    $month = $date_array;
    $monthscores = $this->monthlyGroupScores();
    $usravg = $this->avgUsrList();

    // personalized quartiles
    $monthMidQuart = $this->personalizeMidQuart($date_array);
    $monthTopQuart = $this->personalizeTopQuart($date_array);
    $monthLowQuart = $this->personalizeLowQuart($date_array);
    // $monthTotGames = $this->monthlyTotal($date);

    // debug($weekscores);
    $this->set(compact('dayavg'));
    $this->set(compact('daytot'));
    $this->set(compact('total'));
    $this->set(compact('mean'));
    $this->set(compact('weekscores'));
    $this->set('_serialize', ['weekscores']);
    $this->set(compact('weekMidQuart'));
    $this->set('_serialize', ['weekMidQuart']);
    $this->set(compact('weekTopQuart'));
    $this->set('_serialize', ['weekTopQuart']);
    $this->set(compact('weekLowQuart'));
    $this->set('_serialize', ['weekLowQuart']);
    $this->set(compact('weekTotGames'));
    $this->set('_serialize', ['weekTotGames']);

    $this->set(compact('monthMidQuart'));
    $this->set('_serialize', ['monthMidQuart']);
    $this->set(compact('monthTopQuart'));
    $this->set('_serialize', ['monthTopQuart']);
    $this->set(compact('monthLowQuart'));
    $this->set('_serialize', ['monthLowQuart']);
    $this->set(compact('monthTotGames'));
    $this->set('_serialize', ['monthTotGames']);

    $this->set(compact('monthscores'));
    $this->set('_serialize', ['monthscores']);
    $this->set(compact('week'));
    $this->set('_serialize', ['week']);
    $this->set(compact('month'));
    $this->set('_serialize', ['month']);
    $this->set(compact('usravg'));
    $this->set('_serialize', ['usravg']);
    $this->set(compact('start','end'));
    }

  public function groupScores(){
    $date = Date::now();
    $sum = 0;
    $total = 0;
    $group_questions = $this->findQuestions();
    foreach($group_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    $mean = $sum / $total;
    $mean = $mean * 100;
    $dg_mean = $this->dailyGroupScores($date);
    // debug($mean);
    // debug($dg_mean);
    // debug($date);
    $dayavg = $this->dailyGameAvg($date);
    $daytot = $this->dailyGameTot($date);
    $week = $this->getWeek();
    $weekscores = $this->weeklyGroupScores();
    $month = $this->getMonth();
    $monthscores = $this->monthlyGroupScores();
    $usravg = $this->avgUsrList();
    $weekMidQuart = $this->weeklyMidQuart($date);
    $weekTopQuart = $this->weeklyTopQuart($date);
    $weekLowQuart = $this->weeklyLowQuart($date);
    $weekTotGames = $this->weeklyTotals($date);

    $monthMidQuart = $this->monthlyMidQuart($date);
    $monthTopQuart = $this->monthlyTopQuart($date);
    $monthLowQuart = $this->monthlyLowQuart($date);
    $monthTotGames = $this->monthlyTotal($date);

    // debug($weekscores);
    $this->set(compact('dayavg'));
    $this->set(compact('daytot'));
    $this->set(compact('total'));
    $this->set(compact('mean'));
    $this->set(compact('weekscores'));
    $this->set('_serialize', ['weekscores']);
    $this->set(compact('weekMidQuart'));
    $this->set('_serialize', ['weekMidQuart']);
    $this->set(compact('weekTopQuart'));
    $this->set('_serialize', ['weekTopQuart']);
    $this->set(compact('weekLowQuart'));
    $this->set('_serialize', ['weekLowQuart']);
    $this->set(compact('weekTotGames'));
    $this->set('_serialize', ['weekTotGames']);

    $this->set(compact('monthMidQuart'));
    $this->set('_serialize', ['monthMidQuart']);
    $this->set(compact('monthTopQuart'));
    $this->set('_serialize', ['monthTopQuart']);
    $this->set(compact('monthLowQuart'));
    $this->set('_serialize', ['monthLowQuart']);
    $this->set(compact('monthTotGames'));
    $this->set('_serialize', ['monthTotGames']);

    $this->set(compact('monthscores'));
    $this->set('_serialize', ['monthscores']);
    $this->set(compact('week'));
    $this->set('_serialize', ['week']);
    $this->set(compact('month'));
    $this->set('_serialize', ['month']);
    $this->set(compact('usravg'));
    $this->set('_serialize', ['usravg']);
  }

  public function dailyGroupScores($day){
    $date = $day;
    $sum = 0;
    $total = 0;
    $mean = 0;
    $dg_questions = $this->dailyQuestions($date);
    foreach($dg_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    if($total == 0){
      $mean = 0;
    }
    else{
      $mean = $sum / $total;
    }
    return $mean;
  }

  public function individualScores($id = null){
    $user = $id;
    $date = Date::now();
    $sum = 0;
    $total = 0;
    $mean = 0;
    $individual_questions = $this->individualQuestions($user);
    foreach($individual_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    if ($total == 0){
      $mean = 0;
    }
    else{
      $mean = $sum / $total;
      $mean = $mean * 100;
      // $mean = $mean / 250;
      // $mean = $mean * 100;
      $total = $total / 10;
    }
    $di_mean = $this->dailyIndividualScores($user, $date);
    // if ($di_mean == 0){
    //
    // }
    // else{
    //   $di_mean = $di_mean / 250;
    //   $di_mean = $di_mean * 100;
    // }
    $di_tot = $this->dailyIndividualTotal($user, $date);
    if ($di_tot == 0){
      ;
    }
    else{
      $di_tot = $di_tot / 10;
    }

    // debug($mean);
    // debug($di_mean);
    $questlist = $this->avgQuestList($user);
    $name = $this->getUsername($user);
    $this->set(compact('di_tot'));
    $this->set(compact('total'));
    $this->set(compact('mean'));
    $this->set(compact('di_mean'));
    $this->set(compact('name'));
    $this->set(compact('questlist'));
    $this->set('_serialize', ['questlist']);
  }

  public function getUsername($user){
    $user_id = $user;
    $this->loadModel('Users');
    $name = $this->Users->find()
    ->select(['first_name', 'last_name'])
    ->where(['id' => $user_id])
    ->toArray();
    $fullname = $name[0]['first_name'] . " " . $name[0]['last_name'];
    return $fullname;
  }

  public function userAverage($user){
    $usr = $user;
    $this->LoadModel('Games');
    $usrgames = $this->Games->find()
    ->where(['user_id' => $usr])
    ->toArray();
    foreach($usrgames as $game){
      $sum = $sum + $game['score'];
      $total++;
    }
    if ($total == 0){
      $avg = 0;
    }
    else {
      $avg = $sum/$total;
      $avg = $avg * 100;
    }
  }


  public function dailyIndividualScores($id = null, $day){
    $user = $id;
    $date = $day;
    $sum = 0;
    $total = 0;
    $mean = 0;
    $di_questions = $this->dailyIndividualQuestions($date, $user);
    foreach($di_questions as $question){
      $sum = $sum + $question['correct'];
      $total++;
    }
    if ($total == 0){
      $mean = 0;
    }
    else{
      $mean = $sum / $total;
      $mean = $mean * 100;
    }
    return $mean;
  }

  public function dailyIndividualTotal($id = null, $day){
    $user = $id;
    $date = $day;
    $total = 0;
    $di_questions = $this->dailyIndividualQuestions($date, $user);
    $total = count($di_questions);
    return $total;
  }

  public function avgQuestList($user){
    $user_id = $user;
    $this->loadModel('CompletedQuestions');
    $this->loadModel('Questions');
    $questionslist = array();
    $questionslist = $this->Questions->find()
    ->toArray();
    $questionsavg = array();
    $questarray = array();
    $rowarray = array();
    $x = 0;
    foreach ($questionslist as $question){
      $compquest = $this->CompletedQuestions->find()
      ->where(['user_id' => $user, 'question_id' => $question['id']])
      ->toArray();
      $rows = count($compquest);
      $avg = 0;
      if ($rows > 0){
        $sum = 0;
        foreach($compquest as $quest){
          if ($quest['correct'] == 'true'){
            $sum++;
          }
        }
        $avg = $sum/$rows;
        $avg = $avg * 100;
      }
      else{
        $avg = 0;
      }
      // debug($avg);
      // debug($compquest);
      $questionsavg[$x] = array('id' => $question['id'], 'text' => $question['question_text'], 'category' => $question['subject'], 'average' => $avg, 'total' => $rows);
      // $usravg[$x] = array('id' => $user, 'first' => $names[0]['first_name'], 'last' => $names[0]['last_name'], 'average' => $avg);

      $x++;
    }
    return $questionsavg;
  }

  public function avgUsrList(){
    $active = array();
    $active = $this->activeStudents();
    $this->LoadModel('Games');
    $this->LoadModel('Users');
    $usravg = array();
    $x = 0;
    foreach($active as $user){
      $sum = 0;
      $total = 0;
      $avg = 0;
      $usrgames = $this->Games->find()
      ->where(['user_id' => $user])
      ->toArray();
      $names = $this->Users->find()
      ->select(['first_name', 'last_name'])
      ->where(['id' => $user])
      ->toArray();
      foreach($usrgames as $game){
        $sum = $sum + $game['score'];
        $total++;
      }
      if ($total == 0){
        $avg = 0;
      }
      else {
        $avg = $sum/$total;
      }
      $usravg[$x] = array('id' => $user, 'first' => $names[0]['first_name'], 'last' => $names[0]['last_name'], 'average' => $avg);
      $x++;
    }
    return $usravg;

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

    // debug($di_questions);

    return $di_questions;
  }

  public function individualQuestions($user){
    $user_id = $user;
    $this->LoadModel('CompletedQuestions');
    $individual_questions = $this->CompletedQuestions->find()
        ->where(['user_id' => $user_id])
        ->toArray();

    // debug($individual_questions);

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

    // debug($completed_questions);

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
    return $daily_questions;
  }

  public function dailyGames($date){
    $query_date = $date;
    $this->LoadModel('Games');
    $active = array();
    $active = $this->active();
    $daily_games = $this->Games->find()
        ->where(['user_id IN' => $active, 'date_complete' => $query_date])
        ->order(['score' => 'ASC'])
        ->toArray();
    return $daily_games;
  }

  public function dailyGameAvg($date){
    $day = $date;
    $avg = 0;
    $sum = 0;
    $total = 0;
    $dailyGames = $this->dailyGames($day);
    foreach ($dailyGames as $game){
      $sum += $game->score;
      $total ++;
    }
    if ($total == 0){
      ;
    }
    else{
      $avg = $sum / $total;
    }
    return $avg;
  }

  public function dailyMidQuart($date){
    $day = $date;
    $medQuart = 0;
    $sum = 0;
    $dailyGames = $this->dailyGames($day);
    $count = count($dailyGames);
    $medKey = $count / 2;
    if ($count == 0){
      ;
    }
    else{
      $medQuart = $dailyGames[$medKey]['score'];
    }
    return $medQuart;
  }

  public function dailyTopQuart($date){
    $day = $date;
    $topQuart = 0;
    $sum = 0;
    $dailyGames = $this->dailyGames($day);
    $count = count($dailyGames);
    $topKey = ($count / 4) * 3;
    if ($count == 0){
      ;
    }
    else{
      $topQuart = $dailyGames[$topKey]['score'];
    }
    return $topQuart;
  }

  public function dailyLowQuart($date){
    $day = $date;
    $lowQuart = 0;
    $sum = 0;
    $dailyGames = $this->dailyGames($day);
    $count = count($dailyGames);
    $lowKey = $count / 4;
    if ($count == 0){
      ;
    }
    else{
      $lowQuart = $dailyGames[$lowKey]['score'];
    }
    return $lowQuart;
  }

  public function weeklyTopQuart(){
    $week = $this->weekQuery();
    $weekscores = array();
    $x = 0;
    foreach($week as $day){
      $weekscores[$x] = $this->dailyTopQuart($day);
      $x++;
    }
    return $weekscores;
  }

  public function weeklyLowQuart(){
    $week = $this->weekQuery();
    $weekscores = array();
    $x = 0;
    foreach($week as $day){
      $weekscores[$x] = $this->dailyLowQuart($day);
      $x++;
    }
    return $weekscores;
  }

  public function weeklyMidQuart(){
    $week = $this->weekQuery();
    $weekscores = array();
    $x = 0;
    foreach($week as $day){
      $weekscores[$x] = $this->dailyMidQuart($day);
      $x++;
    }
    return $weekscores;
  }

  public function weeklyTotals(){
    $week = $this->weekQuery();
    $weekscores = array();
    $x = 0;
    foreach($week as $day){
      $weekscores[$x] = $this->dailyGameTot($day);
      $x++;
    }
    return $weekscores;
  }

  public function dailyGameTot($date){
    $day = $date;
    $total = 0;
    $dailyGames = $this->dailyGames($day);
    foreach ($dailyGames as $game){
      $total ++;
    }
    return $total;
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

  public function activeStudents(){
    $this->loadModel('Users');
    $active = $this->Users
     ->find()
     ->select(['id'])
     ->where(['active' => 1, 'role' => 'student'])
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

  public function weeklyGroupScores(){
    $week = $this->weekQuery();
    $weekscores = array();
    $x = 0;
    foreach($week as $day){
      $weekscores[$x] = $this->dailyGameAvg($day);
      $x++;
    }
    return $weekscores;
  }

  public function monthlyGroupScores(){
    $month = $this->monthQuery();
    $monthscores = array();
    $x = 0;
    foreach($month as $day){
      $monthscores[$x] = $this->dailyGameAvg($day);
      $x++;
    }
    return $monthscores;
  }

  public function monthlyTopQuart(){
    $month = $this->monthQuery();
    $monthscores = array();
    $x = 0;
    foreach($month as $day){
      $monthscores[$x] = $this->dailyTopQuart($day);
      $x++;
    }
    return $monthscores;
  }

  public function personalizeTopQuart($dates){
    $scores = array();
    $x = 0;
    foreach($dates as $day){
      $scores[$x] = $this->dailyTopQuart($day);
      $x++;
    }
    return $scores;
  }


  public function monthlyMidQuart(){
    $month = $this->monthQuery();
    $monthscores = array();
    $x = 0;
    foreach($month as $day){
      $monthscores[$x] = $this->dailyMidQuart($day);
      $x++;
    }
    return $monthscores;
  }

  public function personalizeMidQuart($dates){
    $scores = array();
    $x = 0;
    foreach($dates as $day){
      $scores[$x] = $this->dailyMidQuart($day);
      $x++;
    }
    return $scores;
  }

  public function monthlyLowQuart(){
    $month = $this->monthQuery();
    $monthscores = array();
    $x = 0;
    foreach($month as $day){
      $monthscores[$x] = $this->dailyLowQuart($day);
      $x++;
    }
    return $monthscores;
  }

  public function personalizeLowQuart($dates){
    $scores = array();
    $x = 0;
    foreach($dates as $day){
      $scores[$x] = $this->dailyLowQuart($day);
      $x++;
    }
    return $scores;
  }

  public function monthlyTotal(){
    $month = $this->monthQuery();
    $monthscores = array();
    $x = 0;
    foreach($month as $day){
      $monthscores[$x] = $this->dailyGameTot($day);
      $x++;
    }
    return $monthscores;
  }

  public function topRecent(){
    $this->loadModel('Games');
    $topten = $this->Games
      ->find()
      ->order(['date_complete' => 'DESC'])
      ->limit(10)
      ->toArray();

      return $topten;

      // $x = 0;
      // $top_array = array();
      // foreach($topten as $game){
      //   $top_array[$x] = $game['']
      // }
  }

  public function topScores(){
    $this->loadModel('Games');
    $topten = $this->Games
    ->find()
    ->order(['score' => 'DESC', 'date_complete' => 'ASC'])
    ->limit(10)
    ->toArray();

    return $topten;
  }

  public function getWeek(){
    $week = array();
    $count = 6;
    while ($count >= 0){
      $string = '-' . $count . 'days';
      $date = Date::now();
      $week[(6 - $count)] = $date->modify($string)->format('m/d/Y');
      $count--;
    }
    return $week;
  }

  public function getMonth(){
    $month = array();
    $count = 29;
    while ($count >= 0){
      $string = '-' . $count . 'days';
      $date = Date::now();
      $month[(29 - $count)] = $date->modify($string)->format('m/d/Y');
      $count--;
    }
    return $month;
  }

  public function weekQuery(){
    $week = array();
    $count = 6;
    while ($count >= 0){
      $string = '-' . $count . 'days';
      $date = Date::now();
      $week[(6 - $count)] = $date->modify($string)->format('Y-m-d');
      $count--;
    }
    return $week;
  }

  public function monthQuery(){
    $month = array();
    $count = 29;
    while ($count >= 0){
      $string = '-' . $count . 'days';
      $date = Date::now();
      $month[(29 - $count)] = $date->modify($string)->format('Y-m-d');
      $count--;
    }
    return $month;
  }

}
