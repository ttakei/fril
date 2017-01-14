<?php
$this->start('tb_sidebar');
echo $this->element('sidebar', array('current_user' => $current_user, 'current_user_shop_account' => $current_user_shop_account, 'sidebar_profile' => true));
$this->end('tb_sidebar');
?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $user->has('group') ? $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('License') ?></th>
            <td><?= $user->has('license') ? $this->Html->link($user->license->name, ['controller' => 'Licenses', 'action' => 'view', $user->license->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($user->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Date') ?></th>
            <td><?= h($user->deleted_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User Shop Account') ?></h4>
        <?php if (!empty($user->user_shop_account)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('Shop Username') ?></th>
                <th scope="col"><?= __('Cookie File') ?></th>
                <th scope="col"><?= __('Request Header Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Deleted Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_shop_account as $userShopAccount): ?>
            <tr>
                <td><?= h($userShopAccount->id) ?></td>
                <td><?= h($userShopAccount->user_id) ?></td>
                <td><?= h($userShopAccount->shop_id) ?></td>
                <td><?= h($userShopAccount->shop_username) ?></td>
                <td><?= h($userShopAccount->cookie_file) ?></td>
                <td><?= h($userShopAccount->request_header_id) ?></td>
                <td><?= h($userShopAccount->created) ?></td>
                <td><?= h($userShopAccount->modified) ?></td>
                <td><?= h($userShopAccount->deleted) ?></td>
                <td><?= h($userShopAccount->deleted_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserShopAccount', 'action' => 'view', $userShopAccount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserShopAccount', 'action' => 'edit', $userShopAccount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserShopAccount', 'action' => 'delete', $userShopAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopAccount->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Shop Apply Order Tmpl') ?></h4>
        <?php if (!empty($user->user_shop_apply_order_tmpl)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_shop_apply_order_tmpl as $userShopApplyOrderTmpl): ?>
            <tr>
                <td><?= h($userShopApplyOrderTmpl->id) ?></td>
                <td><?= h($userShopApplyOrderTmpl->user_id) ?></td>
                <td><?= h($userShopApplyOrderTmpl->shop_id) ?></td>
                <td><?= h($userShopApplyOrderTmpl->body) ?></td>
                <td><?= h($userShopApplyOrderTmpl->created) ?></td>
                <td><?= h($userShopApplyOrderTmpl->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserShopApplyOrderTmpl', 'action' => 'view', $userShopApplyOrderTmpl->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserShopApplyOrderTmpl', 'action' => 'edit', $userShopApplyOrderTmpl->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserShopApplyOrderTmpl', 'action' => 'delete', $userShopApplyOrderTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopApplyOrderTmpl->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Shop Evaluate Tmpl') ?></h4>
        <?php if (!empty($user->user_shop_evaluate_tmpl)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_shop_evaluate_tmpl as $userShopEvaluateTmpl): ?>
            <tr>
                <td><?= h($userShopEvaluateTmpl->id) ?></td>
                <td><?= h($userShopEvaluateTmpl->user_id) ?></td>
                <td><?= h($userShopEvaluateTmpl->shop_id) ?></td>
                <td><?= h($userShopEvaluateTmpl->body) ?></td>
                <td><?= h($userShopEvaluateTmpl->created) ?></td>
                <td><?= h($userShopEvaluateTmpl->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserShopEvaluateTmpl', 'action' => 'view', $userShopEvaluateTmpl->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserShopEvaluateTmpl', 'action' => 'edit', $userShopEvaluateTmpl->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserShopEvaluateTmpl', 'action' => 'delete', $userShopEvaluateTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopEvaluateTmpl->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Shop Receive Fee Tmpl') ?></h4>
        <?php if (!empty($user->user_shop_receive_fee_tmpl)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_shop_receive_fee_tmpl as $userShopReceiveFeeTmpl): ?>
            <tr>
                <td><?= h($userShopReceiveFeeTmpl->id) ?></td>
                <td><?= h($userShopReceiveFeeTmpl->user_id) ?></td>
                <td><?= h($userShopReceiveFeeTmpl->shop_id) ?></td>
                <td><?= h($userShopReceiveFeeTmpl->body) ?></td>
                <td><?= h($userShopReceiveFeeTmpl->created) ?></td>
                <td><?= h($userShopReceiveFeeTmpl->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserShopReceiveFeeTmpl', 'action' => 'view', $userShopReceiveFeeTmpl->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserShopReceiveFeeTmpl', 'action' => 'edit', $userShopReceiveFeeTmpl->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserShopReceiveFeeTmpl', 'action' => 'delete', $userShopReceiveFeeTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopReceiveFeeTmpl->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Shop Relist Cron') ?></h4>
        <?php if (!empty($user->user_shop_relist_cron)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('Interval') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_shop_relist_cron as $userShopRelistCron): ?>
            <tr>
                <td><?= h($userShopRelistCron->id) ?></td>
                <td><?= h($userShopRelistCron->user_id) ?></td>
                <td><?= h($userShopRelistCron->shop_id) ?></td>
                <td><?= h($userShopRelistCron->interval) ?></td>
                <td><?= h($userShopRelistCron->created) ?></td>
                <td><?= h($userShopRelistCron->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserShopRelistCron', 'action' => 'view', $userShopRelistCron->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserShopRelistCron', 'action' => 'edit', $userShopRelistCron->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserShopRelistCron', 'action' => 'delete', $userShopRelistCron->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopRelistCron->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Shop Ship Tmpl') ?></h4>
        <?php if (!empty($user->user_shop_ship_tmpl)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_shop_ship_tmpl as $userShopShipTmpl): ?>
            <tr>
                <td><?= h($userShopShipTmpl->id) ?></td>
                <td><?= h($userShopShipTmpl->user_id) ?></td>
                <td><?= h($userShopShipTmpl->shop_id) ?></td>
                <td><?= h($userShopShipTmpl->body) ?></td>
                <td><?= h($userShopShipTmpl->created) ?></td>
                <td><?= h($userShopShipTmpl->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserShopShipTmpl', 'action' => 'view', $userShopShipTmpl->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserShopShipTmpl', 'action' => 'edit', $userShopShipTmpl->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserShopShipTmpl', 'action' => 'delete', $userShopShipTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopShipTmpl->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
