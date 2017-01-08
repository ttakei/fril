<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Acos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Acos'), ['controller' => 'Acos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Aco'), ['controller' => 'Acos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acos form large-9 medium-8 columns content">
    <?= $this->Form->create($aco) ?>
    <fieldset>
        <legend><?= __('Add Aco') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentAcos, 'empty' => true]);
            echo $this->Form->input('model');
            echo $this->Form->input('foreign_key');
            echo $this->Form->input('alias');
            echo $this->Form->input('aros._ids', ['options' => $aros]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
