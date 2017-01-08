<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserShopShipTmplTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserShopShipTmplTable Test Case
 */
class UserShopShipTmplTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserShopShipTmplTable
     */
    public $UserShopShipTmpl;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_shop_ship_tmpl',
        'app.users',
        'app.shops',
        'app.licenses',
        'app.user_shop_account',
        'app.request_headers',
        'app.user_shop_apply_order_tmpl',
        'app.user_shop_evaluate_tmpl',
        'app.user_shop_receive_fee_tmpl',
        'app.user_shop_relist_cron'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserShopShipTmpl') ? [] : ['className' => 'App\Model\Table\UserShopShipTmplTable'];
        $this->UserShopShipTmpl = TableRegistry::get('UserShopShipTmpl', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserShopShipTmpl);

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
