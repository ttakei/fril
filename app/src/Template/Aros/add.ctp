<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Aros'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Aros'), ['controller' => 'Aros', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Aro'), ['controller' => 'Aros', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acos'), ['controller' => 'Acos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aco'), ['controller' => 'Acos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="aros form large-9 medium-8 columns content">
    <?= $this->Form->create($aro) ?>
    <fieldset>
        <legend><?= __('Add Aro') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentAros, 'empty' => true]);
            echo $this->Form->input('model');
            echo $this->Form->input('foreign_key');
            echo $this->Form->input('alias');
            echo $this->Form->input('acos._ids', ['options' => $acos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
