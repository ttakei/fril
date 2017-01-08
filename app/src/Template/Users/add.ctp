<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
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
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('group_id', ['options' => $groups]);
            echo $this->Form->input('license_id', ['options' => $licenses]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('deleted_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
