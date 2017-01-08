<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Shop Apply Order Tmpl'), ['action' => 'edit', $userShopApplyOrderTmpl->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Shop Apply Order Tmpl'), ['action' => 'delete', $userShopApplyOrderTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopApplyOrderTmpl->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Shop Apply Order Tmpl'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Shop Apply Order Tmpl'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userShopApplyOrderTmpl view large-9 medium-8 columns content">
    <h3><?= h($userShopApplyOrderTmpl->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userShopApplyOrderTmpl->has('user') ? $this->Html->link($userShopApplyOrderTmpl->user->id, ['controller' => 'Users', 'action' => 'view', $userShopApplyOrderTmpl->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop') ?></th>
            <td><?= $userShopApplyOrderTmpl->has('shop') ? $this->Html->link($userShopApplyOrderTmpl->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopApplyOrderTmpl->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userShopApplyOrderTmpl->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userShopApplyOrderTmpl->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userShopApplyOrderTmpl->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($userShopApplyOrderTmpl->body)); ?>
    </div>
</div>
