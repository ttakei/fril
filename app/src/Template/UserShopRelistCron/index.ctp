<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Shop Relist Cron'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userShopRelistCron index large-9 medium-8 columns content">
    <h3><?= __('User Shop Relist Cron') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shop_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interval') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userShopRelistCron as $userShopRelistCron): ?>
            <tr>
                <td><?= $this->Number->format($userShopRelistCron->id) ?></td>
                <td><?= $userShopRelistCron->has('user') ? $this->Html->link($userShopRelistCron->user->id, ['controller' => 'Users', 'action' => 'view', $userShopRelistCron->user->id]) : '' ?></td>
                <td><?= $userShopRelistCron->has('shop') ? $this->Html->link($userShopRelistCron->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopRelistCron->shop->id]) : '' ?></td>
                <td><?= $this->Number->format($userShopRelistCron->interval) ?></td>
                <td><?= h($userShopRelistCron->created) ?></td>
                <td><?= h($userShopRelistCron->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userShopRelistCron->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userShopRelistCron->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userShopRelistCron->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopRelistCron->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
