<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Shop Account'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Request Headers'), ['controller' => 'RequestHeaders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request Header'), ['controller' => 'RequestHeaders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userShopAccount index large-9 medium-8 columns content">
    <h3><?= __('User Shop Account') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shop_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shop_username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cookie_file') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_header_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userShopAccount as $userShopAccount): ?>
            <tr>
                <td><?= $this->Number->format($userShopAccount->id) ?></td>
                <td><?= $userShopAccount->has('user') ? $this->Html->link($userShopAccount->user->id, ['controller' => 'Users', 'action' => 'view', $userShopAccount->user->id]) : '' ?></td>
                <td><?= $userShopAccount->has('shop') ? $this->Html->link($userShopAccount->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopAccount->shop->id]) : '' ?></td>
                <td><?= h($userShopAccount->shop_username) ?></td>
                <td><?= h($userShopAccount->cookie_file) ?></td>
                <td><?= $userShopAccount->has('request_header') ? $this->Html->link($userShopAccount->request_header->id, ['controller' => 'RequestHeaders', 'action' => 'view', $userShopAccount->request_header->id]) : '' ?></td>
                <td><?= h($userShopAccount->created) ?></td>
                <td><?= h($userShopAccount->modified) ?></td>
                <td><?= $this->Number->format($userShopAccount->deleted) ?></td>
                <td><?= h($userShopAccount->deleted_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userShopAccount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userShopAccount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userShopAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopAccount->id)]) ?>
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
