<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Shop Receive Fee Tmpl'), ['action' => 'edit', $userShopReceiveFeeTmpl->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Shop Receive Fee Tmpl'), ['action' => 'delete', $userShopReceiveFeeTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopReceiveFeeTmpl->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Shop Receive Fee Tmpl'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Shop Receive Fee Tmpl'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userShopReceiveFeeTmpl view large-9 medium-8 columns content">
    <h3><?= h($userShopReceiveFeeTmpl->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userShopReceiveFeeTmpl->has('user') ? $this->Html->link($userShopReceiveFeeTmpl->user->id, ['controller' => 'Users', 'action' => 'view', $userShopReceiveFeeTmpl->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop') ?></th>
            <td><?= $userShopReceiveFeeTmpl->has('shop') ? $this->Html->link($userShopReceiveFeeTmpl->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopReceiveFeeTmpl->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userShopReceiveFeeTmpl->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userShopReceiveFeeTmpl->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userShopReceiveFeeTmpl->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($userShopReceiveFeeTmpl->body)); ?>
    </div>
</div>
