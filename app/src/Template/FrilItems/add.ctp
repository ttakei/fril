<?php
$this->start('title');
echo '商品予約登録';
$this->end('title');
$this->start('tb_sidebar');
echo $this->element('sidebar', array('current_user' => $current_user, 'current_user_shop_account' => $current_user_shop_account, 'sidebar_profile' => true));
$this->end('tb_sidebar');
?>
<div class="frilItems form large-9 medium-8 columns content">
    <?= $this->Form->create(null, ['type' => 'file']) ?>
    <fieldset>
        <?php
            echo '<legend>画像</legend>';
            echo '<ul id="item_imgs" style="list-style:none">';
            echo "<li>";
            echo $this->Form->input('item_img[]', array(
                'label' => false,
                'type' => 'file',
                'accept' => 'jpg|jpeg|gif|png',
                'class' => 'item_img',
            ));
            echo "</li>";
            echo "</ul>";
            echo '<legend>商品詳細</legend>';
            echo $this->Form->input('category_id', array(
                'label' => 'カテゴリ',
                'type' => 'select',
                'default' => '',
                'options' => [$category],
            ));
            echo $this->Form->input('size_id', array(
                'label' => 'サイズ',
                'type' => 'select',
                'default' => '',
                'options' => [$size],
            ));
            echo $this->Form->input('brand_id', array(
                'label' => 'ブランド',
                'type' => 'select',
                'default' => '',
                'options' => [$brand],
            ));
            echo $this->Form->input('status', array(
                'label' => '商品の状態',
                'type' => 'select',
                'default' => '1',
                'options' => [$status],
            ));
            echo '<legend>配送情報</legend>';
            echo $this->Form->input('carriage', array(
                'label' => '配送料の負担',
                'type' => 'select',
                'default' => '1',
                'options' => [$carriage],
            ));
            echo $this->Form->input('delivery_method', array(
                'label' => '配送方法',
                'type' => 'select',
                'default' => '1',
                'options' => [$delivery_method],
            ));
            echo $this->Form->input('delivery_date', array(
                'label' => '発送日の目安',
                'type' => 'select',
                'default' => '1',
                'options' => [$delivery_date],
            ));
            echo $this->Form->input('delivery_area', array(
                'label' => '発送元の地域',
                'type' => 'select',
                'default' => '1',
                'options' => [$delivery_area],
            ));
            echo '<legend>購入申請</legend>';
            echo $this->Form->input('request_required', array(
                'label' => '購入申請',
                'type' => 'select',
                'default' => '1',
                'options' => [$request_required],
            ));
            echo '<legend>商品情報</legend>';
            echo $this->Form->input('name', array(
                'label' => '商品名',
                'type' => 'text',
                'value' => '',
            ));
            echo $this->Form->input('detail', array(
                'label' => '商品説明',
                'type' => 'textarea',
                'value' => '',
            ));
            echo $this->Form->input('sell_price', array(
                'label' => '商品価格',
                'type' => 'text',
                'value' => '',
            ));
            echo $this->Form->label('登録と同時に出品する');
            echo $this->Form->input('direct_exhibit', array(
                'label' => false,
                'type' => 'radio',
                'value' => '1',
                'options' => [
                    ['value' => '1', 'text' => 'する'],
                    ['value' => '0', 'text' => 'しない'],
                ],
            ));
        ?>
    </fieldset>
    <?= $this->Form->button('送信') ?>
    <?= $this->Form->end() ?>
</div>
<script>
$("document").ready(function(){
    $(".item_img").change(fileInputChange);
});

/* 
function fileInputChange(){
    if($(".item_img").last().val() != ""){
        $("#item_imgs").append('<li><div class="form-group file"><input type="file" name="item_img[]" class="item_img" accept="jpg|jepg|gif|png"/></div></li>')
        .bind('change', fileInputChange);
    }
}
*/
/*
$("document").ready(function(){
    $(".item_img").change(fileInputChange);
});
*/
function fileInputChange(){
    var size = $('.item_img').length;
    if (size < 4) {
        if($(".item_img").last().val() != ""){
            $("#item_imgs").append('<li><div class="form-group file"><input type="file" name="item_img[]" class="item_img" accept="jpg|jepg|gif|png"/></div></li>')
            .bind('change', fileInputChange);
        }
    }
}
</script>
