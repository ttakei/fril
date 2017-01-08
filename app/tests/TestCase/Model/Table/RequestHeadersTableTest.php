<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestHeadersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestHeadersTable Test Case
 */
class RequestHeadersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestHeadersTable
     */
    public $RequestHeaders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.request_headers',
        'app.user_shop_account'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestHeaders') ? [] : ['className' => 'App\Model\Table\RequestHeadersTable'];
        $this->RequestHeaders = TableRegistry::get('RequestHeaders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestHeaders);

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
}
