<style>
    td {
        padding:8px;
    }
    th {
        padding:8px;
    }
    
    .updateTable {
        font-size: 120%; 
        margin-bottom : 17px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('#backButton').click(function () {
        	parent.history.back();
        	return false;
        });
    });
</script>
    <form method="post" action="../updateRecord">
        <table class="updateTable table-bordered table-hover table-horizon">
            <thead>
                <tr>
                    <th>項目</th>
                    <th>値</th>
                </tr>
            </thead>
            <?php
                $arr = $log['Log'];
                echo "<tr>";
                    echo "<th>NO</th>";
                    echo "<td>{$arr['id']}</td>";
                    echo "<input type='hidden' name = 'id' value = {$arr['id']}>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>件名</th>";
                    echo "<td><input type='text' class='form-control' name = 'subject' value = '{$arr['subject']}'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>詳細内容</th>";
                    echo "<td><input type='text' class='form-control' name = 'detail' value = '{$arr['detail']}'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>状態</th>";
                    $stateSelected = array($arr['state']);
                    $stateArray = array();
                    for ($i = 0; $i < count($code); $i++) {
                        $arr2 = $code[$i]['MstCode'];
                        $stateArray[$arr2['code']] = $arr2['code'].'('.$arr2['name'].')';
                    }
                    echo "<td>";
                        echo $this->Form->input('state', array('options' => $stateArray, 'selected' => $stateSelected, 'class' => 'form-control', 'label' => false));
                    echo "</td>";
                echo "</tr>";
               echo "<tr>";
                    echo "<th>登録者</th>";
                    $personSelected = array($arr['register']);
                    $personArray = array();
                    for ($i = 0; $i < count($person); $i++) {
                        $arr3 = $person[$i]['MstPersonIC'];
                        $personArray[$arr3['code']] = $arr3['code'].'('.$arr3['name'].')';
                    }
                    echo "<td>";
                        echo $this->Form->input('register', array('options' => $personArray, 'selected' => $personSelected, 'class' => 'form-control', 'label' => false));
                    echo "</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th>更新者</th>";
                    echo "<td>";
                        echo $this->Form->input('updater', array('options' => $personArray, 'selected' => $personSelected, 'class' => 'form-control', 'label' => false));
                    echo "</td>";
                echo "</tr>";
            ?>
        </table>
        <div class="row">
            <div class="col-md-3 text-center">
                <button class="btn btn-default" id = "backButton">戻る</button>
                <input type='submit' class="btn btn-warning" value='更新'>
            </div>
        </div>
    </form>
</div>