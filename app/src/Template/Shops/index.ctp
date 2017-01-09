<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Shop'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New License'), ['controller' => 'Licenses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Shop Account'), ['controller' => 'UserShopAccount', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Shop Account'), ['controller' => 'UserShopAccount', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Shop Apply Order Tmpl'), ['controller' => 'UserShopApplyOrderTmpl', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Shop Apply Order Tmpl'), ['controller' => 'UserShopApplyOrderTmpl', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Shop Evaluate Tmpl'), ['controller' => 'UserShopEvaluateTmpl', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Shop Evaluate Tmpl'), ['controller' => 'UserShopEvaluateTmpl', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Shop Receive Fee Tmpl'), ['controller' => 'UserShopReceiveFeeTmpl', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Shop Receive Fee Tmpl'), ['controller' => 'UserShopReceiveFeeTmpl', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Shop Relist Cron'), ['controller' => 'UserShopRelistCron', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Shop Relist Cron'), ['controller' => 'UserShopRelistCron', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Shop Ship Tmpl'), ['controller' => 'UserShopShipTmpl', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Shop Ship Tmpl'), ['controller' => 'UserShopShipTmpl', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shops index large-9 medium-8 columns content">
    <h3><?= __('Shops') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shops as $shop): ?>
            <tr>
                <td><?= $this->Number->format($shop->id) ?></td>
                <td><?= h($shop->name) ?></td>
                <td><?= h($shop->created) ?></td>
                <td><?= h($shop->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $shop->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shop->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shop->id)]) ?>
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
