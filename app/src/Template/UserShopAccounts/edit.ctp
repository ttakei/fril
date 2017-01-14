<?php
$this->start('title');
echo 'フリルアカウント';
$this->end('title');
$this->start('tb_sidebar');
echo $this->element('sidebar', array('current_user' => $current_user, 'current_user_shop_account' => $current_user_shop_account, 'sidebar_profile' => true));
$this->end('tb_sidebar');
?>
<div class="userShopAccount form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <?php
            echo $this->Form->input('shop_id[]', array(
                'type' => 'hidden',
                'value' => $shop_id,
            ));
            for ($i = 0; $i < $user->license->max_account; $i++) {
                echo(sprintf("<legend>アカウント%d</legend>", $i + 1));
//                echo '<div><div class="form-inline">';
                $id = '';
                $shop_nickname = '';
                $shop_username = '';
                $shop_password = '';
                if (!empty($user->user_shop_accounts[$i])) {
                    $id = $user->user_shop_accounts[$i]->id;
                    $shop_nickname = $user->user_shop_accounts[$i]->shop_nickname;
                    $shop_username = $user->user_shop_accounts[$i]->shop_username;
                    $shop_password = $user->user_shop_accounts[$i]->shop_password;
                }
                echo $this->Form->input("user_shop_accounts[$shop_id][id][]", array(
                    'type' => 'hidden',
                    'value' => $id,
                ));
                echo $this->Form->input("user_shop_accounts[$shop_id][shop_nickname][]", array(
                    'type' => 'text',
                    'label' => 'ニックネーム',
                    'value' => $shop_nickname,
                    'disabled' => 'disabled',
                ));
                echo $this->Form->input("user_shop_accounts[$shop_id][shop_username][]", array(
                    'type' => 'text',
                    'label' => 'メールアドレス',
                    'value' => $shop_username,
                ));
                echo $this->Form->input("user_shop_accounts[$shop_id][shop_password][]", array(
                    'type' => 'password',
                    'label' => 'パスワード',
//                    'class' => 'form-control',
                    'value' => $shop_password,
                ));
                echo '<hr/>';
            }
        ?>
    </fieldset>
    <?= $this->Form->button('送信') ?>
    <?= $this->Form->end() ?>
</div>
