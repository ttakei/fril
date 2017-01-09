<ul class="nav nav-sidebar" id="nav_sidebar">
<?php if(isset($user_shop_account) && !empty($user_shop_account->id)): ?> 
    <li><a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_exhibit" class="<?php !empty($sidebar_exhibit)?'collapsed':'' ?>">出品</a></li>
    <li>
        <div id="collapse_exhibit" class="collapse list-group">
            <?= $this->MyHtml->sidebar_link($this->request, '一括出品', ['controller' => 'fril_item_bulk_exhibit', 'action' => 'index', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '出品中', ['controller' => 'fril_items', 'action' => 'selling', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '取引中', ['controller' => 'fril_items', 'action' => 'trading', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '売却済', ['controller' => 'fril_items', 'action' => 'sold', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '再出品ログ', ['controller' => 'fril_items', 'action' => 'log', $user_shop_account->id]) ?>
        </div>
    </li>
<?php endif; ?>
<?php if(isset($user_shop_account) && !empty($user_shop_account->id)): ?> 
    <li><a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_exhibit_setting" class="<?php !empty($sidebar_exhibit_setting)?'collapsed':'' ?>">出品設定</a></li>
    <li>
        <div id="collapse_exhibit_setting" class="panel-collapse collapse">
            <?= $this->MyHtml->sidebar_link($this->request, '再出品設定', ['controller' => 'fril_item_setting', 'action' => 'cron', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, 'リクエストヘッダー設定', ['controller' => 'fril_item_setting', 'action' => 'header', $user_shop_account->id]) ?>
        </div>
    </li>
<?php endif; ?>
<?php if(isset($user_shop_account) && !empty($user_shop_account->id)): ?> 
    <li><a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_tmpl_setting" class="<?php !empty($sidebar_tmpl_setting)?'collapsed':'' ?>">定型文</a></li>
    <li>
        <div id="collapse_tmpl_setting" class="panel-collapse collapse">
            <?= $this->MyHtml->sidebar_link($this->request, '注文承認定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'apply_order', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '支払受付定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'receive_fee', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '発送定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'ship', $user_shop_account->id]) ?>
            <?= $this->MyHtml->sidebar_link($this->request, '評価定型文', ['controller' => 'fril_tmpl_setting', 'action' => 'evaluate', $user_shop_account->id]) ?>
        </div>
    </li>
<?php endif; ?>
<?php if(isset($user) && !empty($user->id)): ?> 
    <li>
        <a data-toggle="collapse" data-parent="#nav_sidebar" href="#collapse_profile" class="<?php !empty($sidebar_profile)?'collapsed':'' ?>">プロフィール</a>
    </li>
    <li>
        <div id="collapse_profile" class="panel-collapse collapse list-group">
            <?= $this->MyHtml->sidebar_link($this->request, 'プロフィール編集', ['controller' => 'users', 'action' => 'edit', $user->id]) ?>
        </div>
    </li>
<?php endif; ?>
</ul>
