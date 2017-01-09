<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserShopAccountTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserShopAccountTable Test Case
 */
class UserShopAccountTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserShopAccountTable
     */
    public $UserShopAccount;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_shop_account',
        'app.users',
        'app.shops',
        'app.licenses',
        'app.user_shop_apply_order_tmpl',
        'app.user_shop_evaluate_tmpl',
        'app.user_shop_receive_fee_tmpl',
        'app.user_shop_relist_cron',
        'app.user_shop_ship_tmpl',
        'app.request_headers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserShopAccount') ? [] : ['className' => 'App\Model\Table\UserShopAccountTable'];
        $this->UserShopAccount = TableRegistry::get('UserShopAccount', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserShopAccount);

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
