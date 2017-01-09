<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Shops'), ['action' => 'index']) ?></li>
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
<div class="shops form large-9 medium-8 columns content">
    <?= $this->Form->create($shop) ?>
    <fieldset>
        <legend><?= __('Add Shop') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
