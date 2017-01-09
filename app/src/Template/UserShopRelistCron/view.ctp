<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Shop Relist Cron'), ['action' => 'edit', $userShopRelistCron->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Shop Relist Cron'), ['action' => 'delete', $userShopRelistCron->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopRelistCron->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Shop Relist Cron'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Shop Relist Cron'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userShopRelistCron view large-9 medium-8 columns content">
    <h3><?= h($userShopRelistCron->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userShopRelistCron->has('user') ? $this->Html->link($userShopRelistCron->user->id, ['controller' => 'Users', 'action' => 'view', $userShopRelistCron->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop') ?></th>
            <td><?= $userShopRelistCron->has('shop') ? $this->Html->link($userShopRelistCron->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopRelistCron->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userShopRelistCron->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interval') ?></th>
            <td><?= $this->Number->format($userShopRelistCron->interval) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userShopRelistCron->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userShopRelistCron->modified) ?></td>
        </tr>
    </table>
</div>
