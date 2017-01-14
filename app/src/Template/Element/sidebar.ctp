<ul class="nav nav-sidebar" id="nav_sidebar">
<?php if(isset($current_user_shop_account) && !empty($current_user_shop_account->id)): ?> 
    <li><a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_exhibit" class="<?php !empty($sidebar_exhibit)?'collapsed':'' ?>">出品</a></li>
    <li>
        <div id="collapse_exhibit" class="collapse list-group">
            <?= $this->MyHtml->sidebar_link($this->request, '一括出品', ['controller' => 'fril_item_bulk_exhibit', 'action' => 'index', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '出品中', ['controller' => 'fril_items', 'action' => 'selling', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '取引中', ['controller' => 'fril_items', 'action' => 'trading', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '売却済', ['controller' => 'fril_items', 'action' => 'sold', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '再出品ログ', ['controller' => 'fril_items', 'action' => 'log', $current_user_shop_account->id]) ?>
        </div>
    </li>
<?php endif; ?>
<?php if(isset($current_user_shop_account) && !empty($current_user_shop_account->id)): ?> 
    <li><a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_exhibit_setting" class="<?php !empty($sidebar_exhibit_setting)?'collapsed':'' ?>">出品設定</a></li>
    <li>
        <div id="collapse_exhibit_setting" class="panel-collapse collapse">
            <?= $this->MyHtml->sidebar_link($this->request, '再出品設定', ['controller' => 'fril_item_setting', 'action' => 'cron', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, 'リクエストヘッダー設定', ['controller' => 'fril_item_setting', 'action' => 'header', $current_user_shop_account->id]) ?>
        </div>
    </li>
<?php endif; ?>
<?php if(isset($current_user_shop_account) && !empty($current_user_shop_account->id)): ?> 
    <li><a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_tmpl_setting" class="<?php !empty($sidebar_tmpl_setting)?'collapsed':'' ?>">定型文</a></li>
    <li>
        <div id="collapse_tmpl_setting" class="panel-collapse collapse">
            <?= $this->MyHtml->sidebar_link($this->request, '注文承認定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'apply_order', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '支払受付定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'receive_fee', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '発送定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'ship', $current_user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '評価定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'evaluate', $current_user_shop_account->id]) ?>
        </div>
    </li>
<?php endif; ?>
<?php if(isset($current_user) && !empty($current_user->id)): ?>
    <li>
        <a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_profile" class="<?php !empty($sidebar_profile)?'collapsed':'' ?>">プロフィール</a>
    </li>
    <li>
        <div id="collapse_profile" class="panel-collapse collapse list-group">
            <?= $this->MyHtml->sidebar_link($this->request, 'ショップアカウント', ['controller' => 'user_shop_accounts', 'action' => 'edit']) ?>
            <?= $this->MyHtml->sidebar_link($this->request, 'プロフィール編集', ['controller' => 'users', 'action' => 'edit']) ?>
        </div>
    </li>
<?php endif; ?>
</ul>
