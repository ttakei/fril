<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userShopApplyOrderTmpl->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userShopApplyOrderTmpl->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List User Shop Apply Order Tmpl'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userShopApplyOrderTmpl form large-9 medium-8 columns content">
    <?= $this->Form->create($userShopApplyOrderTmpl) ?>
    <fieldset>
        <legend><?= __('Edit User Shop Apply Order Tmpl') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('shop_id', ['options' => $shops]);
            echo $this->Form->input('body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
