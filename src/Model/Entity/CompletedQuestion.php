<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompletedQuestion Entity
 *
 * @property int $id
 * @property int $answer_id
 * @property \Cake\I18n\Time $date_answered
 * @property bool $correct
 * @property int $user_id
 * @property int $question_id
 * @property int $game_id
 *
 * @property \App\Model\Entity\Answer $answer
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\Game $game
 */
class CompletedQuestion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'answer_id' => false,
        'user_id' => false,
        'question_id' => false
    ];
}
