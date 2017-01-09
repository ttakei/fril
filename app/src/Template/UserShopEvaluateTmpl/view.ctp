<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Shop Evaluate Tmpl'), ['action' => 'edit', $userShopEvaluateTmpl->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Shop Evaluate Tmpl'), ['action' => 'delete', $userShopEvaluateTmpl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userShopEvaluateTmpl->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Shop Evaluate Tmpl'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Shop Evaluate Tmpl'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userShopEvaluateTmpl view large-9 medium-8 columns content">
    <h3><?= h($userShopEvaluateTmpl->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userShopEvaluateTmpl->has('user') ? $this->Html->link($userShopEvaluateTmpl->user->id, ['controller' => 'Users', 'action' => 'view', $userShopEvaluateTmpl->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shop') ?></th>
            <td><?= $userShopEvaluateTmpl->has('shop') ? $this->Html->link($userShopEvaluateTmpl->shop->name, ['controller' => 'Shops', 'action' => 'view', $userShopEvaluateTmpl->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userShopEvaluateTmpl->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userShopEvaluateTmpl->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userShopEvaluateTmpl->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($userShopEvaluateTmpl->body)); ?>
    </div>
</div>
