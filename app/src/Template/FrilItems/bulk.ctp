<?php
$this->start('title');
echo '一括商品予約登録';
$this->end('title');
$this->start('tb_sidebar');
echo $this->element('sidebar', array('current_user' => $current_user, 'current_user_shop_account' => $current_user_shop_account, 'sidebar_profile' => true));
$this->end('tb_sidebar');
?>
<div class="frilItems form large-9 medium-8 columns content">
    <?= $this->Form->create(null, ['type' => 'file']) ?>
    <fieldset>
        <?php
            echo '<legend>出品内容 <a href="/fril_bulk_sample.xlsx" target="_blank" style="font-size:small">サンプル</a></legend>';
            echo $this->Form->label('画像');
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
            echo $this->Form->label('フィールド');
            echo $this->Form->input('item_format', array(
                'label' => false,
                'type' => 'radio',
                'value' => 'tsv',
                'options' => [
                    ['value' => 'tsv', 'text' => 'タブ区切り'],
                    ['value' => 'csv', 'text' => 'カンマ区切り'],
                ],
            ));
            echo $this->Form->input('item_csv', array(
                'label' => false,
                'type' => 'textarea',
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
 
function fileInputChange(){
    if($(".item_img").last().val() != ""){
        $("#item_imgs").append('<li><div class="form-group file"><input type="file" name="item_img[]" class="item_img" accept="jpg|jepg|gif|png"/></div></li>')
        .bind('change', fileInputChange);
    }
}
</script>
