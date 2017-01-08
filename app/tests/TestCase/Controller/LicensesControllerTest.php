<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LicensesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LicensesController Test Case
 */
class LicensesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.licenses',
        'app.shops',
        'app.user_shop_account',
        'app.users',
        'app.groups',
        'app.user_shop_apply_order_tmpl',
        'app.user_shop_evaluate_tmpl',
        'app.user_shop_receive_fee_tmpl',
        'app.user_shop_relist_cron',
        'app.user_shop_ship_tmpl',
        'app.request_headers'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
