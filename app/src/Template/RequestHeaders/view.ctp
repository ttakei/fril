<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Request Header'), ['action' => 'edit', $requestHeader->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Request Header'), ['action' => 'delete', $requestHeader->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestHeader->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Request Headers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Header'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Shop Account'), ['controller' => 'UserShopAccount', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Shop Account'), ['controller' => 'UserShopAccount', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requestHeaders view large-9 medium-8 columns content">
    <h3><?= h($requestHeader->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Useragent') ?></th>
            <td><?= h($requestHeader->useragent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($requestHeader->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User Shop Account') ?></h4>
        <?php if (!empty($requestHeader->user_shop_account)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('Shop Username') ?></th>
                <th scope="col"><?= __('Shop Password') ?></th>
                <th scope="col"><?= __('Cookie File') ?></th>
                <th scope="col"><?= __('Request Header Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Deleted Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($requestHeader->user_shop_account as $userShopAccount): ?>
            <tr>
                <td><?= h($userShopAccount->id) ?></td>
                <td><?= h($userShopAccount->user_id) ?></td>
                <td><?= h($userShopAccount->shop_id) ?></td>
                <td><?= h($userShopAccount->shop_username) ?></td>
                <td><?= h($userShopAccount->shop_password) ?></td>
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
</div>
