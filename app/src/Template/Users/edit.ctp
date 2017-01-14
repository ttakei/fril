<?php
$this->start('title');
echo 'プロフィール';
$this->end('title');
$this->start('tb_sidebar');
echo $this->element('sidebar', array('current_user' => $current_user, 'current_user_shop_account' => $current_user_shop_account, 'sidebar_profile' => true));
$this->end('tb_sidebar');
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= '編集' ?></legend>
        <?php
            echo $this->Form->input('username', ['label' => 'ユーザ名']);
            echo $this->Form->input('password',
                ['label' => 'パスワード', 'value' => '']);
            if($is_admin) {
                echo $this->Form->input('group_id', 
                    ['options' => $groups, 'label' => '権限']);
                echo $this->Form->input('license_id',
                    ['options' => $licenses, 'label' => 'ライセンス']);
            }
        ?>
    </fieldset>
    <?= $this->Form->button('送信') ?>
    <?= $this->Form->end() ?>
</div>
