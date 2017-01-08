<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserShopReceiveFeeTmplTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserShopReceiveFeeTmplTable Test Case
 */
class UserShopReceiveFeeTmplTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserShopReceiveFeeTmplTable
     */
    public $UserShopReceiveFeeTmpl;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_shop_receive_fee_tmpl',
        'app.users',
        'app.shops',
        'app.licenses',
        'app.user_shop_account',
        'app.request_headers',
        'app.user_shop_apply_order_tmpl',
        'app.user_shop_evaluate_tmpl',
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
        $config = TableRegistry::exists('UserShopReceiveFeeTmpl') ? [] : ['className' => 'App\Model\Table\UserShopReceiveFeeTmplTable'];
        $this->UserShopReceiveFeeTmpl = TableRegistry::get('UserShopReceiveFeeTmpl', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserShopReceiveFeeTmpl);

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
