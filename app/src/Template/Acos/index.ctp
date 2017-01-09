<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Aco'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Aros'), ['controller' => 'Aros', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Aro'), ['controller' => 'Aros', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acos index large-9 medium-8 columns content">
    <h3><?= __('Acos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('model') ?></th>
                <th scope="col"><?= $this->Paginator->sort('foreign_key') ?></th>
                <th scope="col"><?= $this->Paginator->sort('alias') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($acos as $aco): ?>
            <tr>
                <td><?= $this->Number->format($aco->id) ?></td>
                <td><?= $aco->has('parent_aco') ? $this->Html->link($aco->parent_aco->id, ['controller' => 'Acos', 'action' => 'view', $aco->parent_aco->id]) : '' ?></td>
                <td><?= h($aco->model) ?></td>
                <td><?= $this->Number->format($aco->foreign_key) ?></td>
                <td><?= h($aco->alias) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $aco->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aco->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aco->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
