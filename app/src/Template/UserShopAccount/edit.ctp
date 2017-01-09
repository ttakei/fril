<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userShopAccount->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userShopAccount->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List User Shop Account'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Request Headers'), ['controller' => 'RequestHeaders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request Header'), ['controller' => 'RequestHeaders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userShopAccount form large-9 medium-8 columns content">
    <?= $this->Form->create($userShopAccount) ?>
    <fieldset>
        <legend><?= __('Edit User Shop Account') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('shop_id', ['options' => $shops]);
            echo $this->Form->input('shop_username');
            echo $this->Form->input('shop_password');
            echo $this->Form->input('cookie_file');
            echo $this->Form->input('request_header_id', ['options' => $requestHeaders, 'empty' => true]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('deleted_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
