<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Shop Account'), ['action' => 'edit', $userShopAccount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Shop Account'), ['action' => 'delete', $userShopAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopAccount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Shop Account'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Shop Account'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Request Headers'), ['controller' => 'RequestHeaders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Header'), ['controller' => 'RequestHeaders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userShopAccount view large-9 medium-8 columns content">
    <h3><?= h($userShopAccount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userShopAccount->has('user') ? $this->Html->link($userShopAccount->user->id, ['controller' => 'Users', 'action' => 'view', $userShopAccount->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop') ?></th>
            <td><?= $userShopAccount->has('shop') ? $this->Html->link($userShopAccount->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopAccount->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop Username') ?></th>
            <td><?= h($userShopAccount->shop_username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop Password') ?></th>
            <td><?= h($userShopAccount->shop_password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cookie File') ?></th>
            <td><?= h($userShopAccount->cookie_file) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request Header') ?></th>
            <td><?= $userShopAccount->has('request_header') ? $this->Html->link($userShopAccount->request_header->id, ['controller' => 'RequestHeaders', 'action' => 'view', $userShopAccount->request_header->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userShopAccount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($userShopAccount->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userShopAccount->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userShopAccount->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Date') ?></th>
            <td><?= h($userShopAccount->deleted_date) ?></td>
        </tr>
    </table>
</div>
