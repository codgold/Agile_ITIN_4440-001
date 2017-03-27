<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompletedQuestions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Answers
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\CompletedQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompletedQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompletedQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompletedQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompletedQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompletedQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompletedQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class CompletedQuestionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('completed_questions');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['id', 'answer_id', 'user_id', 'question_id']);

        $this->belongsTo('Answers', [
            'foreignKey' => 'answer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->date('date_answered')
            ->requirePresence('date_answered', 'create')
            ->notEmpty('date_answered');

        $validator
            ->boolean('correct')
            ->requirePresence('correct', 'create')
            ->notEmpty('correct');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['answer_id'], 'Answers'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));

        return $rules;
    }
}
