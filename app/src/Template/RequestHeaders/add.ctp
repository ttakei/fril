<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Request Headers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User Shop Account'), ['controller' => 'UserShopAccount', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Shop Account'), ['controller' => 'UserShopAccount', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requestHeaders form large-9 medium-8 columns content">
    <?= $this->Form->create($requestHeader) ?>
    <fieldset>
        <legend><?= __('Add Request Header') ?></legend>
        <?php
            echo $this->Form->input('useragent');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
