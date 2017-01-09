<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Shop Receive Fee Tmpl'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userShopReceiveFeeTmpl index large-9 medium-8 columns content">
    <h3><?= __('User Shop Receive Fee Tmpl') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shop_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userShopReceiveFeeTmpl as $userShopReceiveFeeTmpl): ?>
            <tr>
                <td><?= $this->Number->format($userShopReceiveFeeTmpl->id) ?></td>
                <td><?= $userShopReceiveFeeTmpl->has('user') ? $this->Html->link($userShopReceiveFeeTmpl->user->id, ['controller' => 'Users', 'action' => 'view', $userShopReceiveFeeTmpl->user->id]) : '' ?></td>
                <td><?= $userShopReceiveFeeTmpl->has('shop') ? $this->Html->link($userShopReceiveFeeTmpl->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopReceiveFeeTmpl->shop->id]) : '' ?></td>
                <td><?= h($userShopReceiveFeeTmpl->created) ?></td>
                <td><?= h($userShopReceiveFeeTmpl->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userShopReceiveFeeTmpl->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userShopReceiveFeeTmpl->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userShopReceiveFeeTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopReceiveFeeTmpl->id)]) ?>
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
