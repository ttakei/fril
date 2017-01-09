<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Shop Ship Tmpl'), ['action' => 'edit', $userShopShipTmpl->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Shop Ship Tmpl'), ['action' => 'delete', $userShopShipTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopShipTmpl->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Shop Ship Tmpl'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Shop Ship Tmpl'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userShopShipTmpl view large-9 medium-8 columns content">
    <h3><?= h($userShopShipTmpl->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userShopShipTmpl->has('user') ? $this->Html->link($userShopShipTmpl->user->id, ['controller' => 'Users', 'action' => 'view', $userShopShipTmpl->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop') ?></th>
            <td><?= $userShopShipTmpl->has('shop') ? $this->Html->link($userShopShipTmpl->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopShipTmpl->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userShopShipTmpl->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userShopShipTmpl->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userShopShipTmpl->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($userShopShipTmpl->body)); ?>
    </div>
</div>
