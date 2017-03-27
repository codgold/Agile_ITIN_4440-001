<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompletedQuestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompletedQuestionsTable Test Case
 */
class CompletedQuestionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompletedQuestionsTable
     */
    public $CompletedQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.completed_questions',
        'app.answers',
        'app.users',
        'app.questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CompletedQuestions') ? [] : ['className' => 'App\Model\Table\CompletedQuestionsTable'];
        $this->CompletedQuestions = TableRegistry::get('CompletedQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompletedQuestions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
