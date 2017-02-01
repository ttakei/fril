<?php
$this->start('title');
echo '商品予約一覧';
$this->end('title');
$this->start('tb_sidebar');
echo $this->element('sidebar', array('current_user' => $current_user, 'current_user_shop_account' => $current_user_shop_account, 'sidebar_profile' => true));
$this->end('tb_sidebar');
?>
<div class="frilItems form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <?= "<legend>リスト</legend>" ?>
    <fieldset>
    <table class="table">
        <thead>
            <tr>
                <th><input type="checkbox" id="alldel" /> 全選択・全解除</th>
                <th>商品名</th>
                <th>画像</th>
                <th>値段</th>
                <th>再出品タイプ</th>
                <th>出品回数</th>
                <th>最終出品時刻</th>
                <th>次回出品予定時刻</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($fril_items as $item) {
                if($item['re_exhibit_type'] == 'normal') {
                    $re_exhibit_type = "再出品";
                } elseif($item['re_exhibit_type'] == 'dupl') {
                    $re_exhibit_type = "重複出品";
                } elseif($item['re_exhibit_type'] == 'nocomment') {
                    $re_exhibit_type = "コメントなし重複出品";
                } else {
                    $re_exhibit_type = "再出品しない";
                }
                echo "<tr>";
                echo "<td><input class=\"del\" type=\"checkbox\" name=\"del\" value=\"{$item['id']}\" /></td>";
                echo "<td>{$item['name']}</td>";
//                echo "<td><img src=\"/img/app_item/{$item['imgdir']}/{$item['imgfile_1']}</td>\" alt=\"{$item['name']}\" /></td>";
                echo "<td>". $this->Html->image("app_item/{$item['imgdir']}/{$item['imgfile_1']}", array('alt' => $item['name'])). "</td>";
                echo "<td>{$item['sell_price']}</td>";
                echo "<td>{$re_exhibit_type}</td>";
                echo "<td>{$item['exhibit_cnt']}</td>";
                echo "<td>{$item['last_exhibit_datetime']}</td>";
                echo "<td></td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    </fieldset>
    <?= $this->Form->button('一括削除') ?>
    <?= $this->Form->end() ?>
</div>
<script>
$('#alldel').on('change', function() {
    $('input[name=del]').prop('checked', this.checked);
});
</script>
