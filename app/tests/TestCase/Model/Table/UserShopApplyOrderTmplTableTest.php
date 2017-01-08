<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserShopApplyOrderTmplTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserShopApplyOrderTmplTable Test Case
 */
class UserShopApplyOrderTmplTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserShopApplyOrderTmplTable
     */
    public $UserShopApplyOrderTmpl;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_shop_apply_order_tmpl',
        'app.users',
        'app.shops',
        'app.licenses',
        'app.user_shop_account',
        'app.request_headers',
        'app.user_shop_evaluate_tmpl',
        'app.user_shop_receive_fee_tmpl',
        'app.user_shop_relist_cron',
        'app.user_shop_ship_tmpl'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserShopApplyOrderTmpl') ? [] : ['className' => 'App\Model\Table\UserShopApplyOrderTmplTable'];
        $this->UserShopApplyOrderTmpl = TableRegistry::get('UserShopApplyOrderTmpl', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserShopApplyOrderTmpl);

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
