<?php
$this->start('title');
echo 'ログイン';
$this->end('title');
?>
<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= 'ログイン情報を入力してください' ?></legend>
        <?= $this->Form->input('username', ['label'=>'ユーザ名']) ?>
        <?= $this->Form->input('password', ['label'=>'パスワード']) ?>
    </fieldset>
<?= $this->Form->button('ログイン'); ?>
<?= $this->Form->end() ?>
</div>
