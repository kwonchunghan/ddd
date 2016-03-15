<style>
    td {
        padding:8px;
    }
    th {
        padding:8px;
    }
    
    .fontTable {
        font-size: 120%; 
        margin-bottom : 17px;
    }
</style>
<table class="fontTable table table-bordered table-header">
    <tr>
        <th>NO</th>
        <th>件名</th>
        <th>詳細内容</th>
        <th>状態</th>
        <th>登録者</th>
        <th>更新者</th>
        <th>更新日付</th>
        <th>登録日付</th>
        <th>編集</th>
        <th>削除</th>
    </tr>
    <?php
        for ($i = 0; $i < count($log); $i++) {
            $arr = $log[$i]['Log'];
            $arr2 = $log[$i]['MstCode'];
            $arr3 = $log[$i]['MstPersonICR'];
            $arr4 = $log[$i]['MstPersonICU'];
            echo "<tr class='text-center'>";
                echo "<td>{$arr['id']}</td>";
                echo "<td>{$arr['subject']}</td>";
                echo "<td>{$arr['detail']}</td>";
                echo "<td>{$arr2['name']}</td>";
                echo "<td>{$arr3['name']}</td>";
                echo "<td>{$arr4['name']}</td>";
                echo "<td>{$arr['regist_date']}</td>";
                echo "<td>{$arr['update_date']}</td>";
                echo "<td>". $this->Html->link('編集', array('controller' => 'Managements', 'action' => 'update', $arr['id']), array('class' => 'btn btn-warning btn-xs btn-block')) . "</td>";
                echo "<td>". $this->Html->link('削除', array('controller' => 'Managements', 'action' => 'delete', $arr['id']), array('class' => 'btn btn-danger btn-xs btn-block deleteButton')) . "</td>";
            echo "</tr>";
        }
    ?>
    </table>