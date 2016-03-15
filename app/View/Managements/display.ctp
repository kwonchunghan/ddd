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
<script type="text/javascript">
    $(document).ready(function () {
        $('#resetRegist').click(function () {
            $('#registDateStart').val('');
            $('#registDateEnd').val('');
            return false;
        });
        $('#resetUpdate').click(function () {
            $('#updateDateStart').val('');
            $('#updateDateEnd').val('');
            return false;
        });
    });
</script>

<div class="row">
    <form method="get" action="display">
        <table class="search fontTable">
            <tr>
                <th class="th-label">NO</th>
                <td><input type="text" class="form-control" id="no" name="no" placeholder="NO" value = <?php if(!empty($no))print_r($no)?>></td>
            </tr>
            <tr>
                <th class="th-label">件名</th>
                <td><input type="text" class="form-control" id="subject" name="subject" placeholder="件名" value = <?php if(!empty($subject))print_r($subject)?>></td>
            </tr>
            <tr>
                <th class="th-label">詳細内容</th>
                <td><input type="text" class="form-control" id="detail" name="detail" placeholder="詳細内容" value = <?php if(!empty($detail))print_r($detail)?>></td>
            </tr>
            <?php 
            echo "<tr>";
                echo "<th class=\"th-label\">状態</th>";
                    $stateSelected = array(0);
                    if(!empty($state)) {
                        $stateSelected = array($state);
                    }
                    $stateArray = array();
                    $stateArray[0] = array('選択');
                    for ($i = 0; $i < count($code); $i++) {
                        $arr2 = $code[$i]['MstCode'];
                        $stateArray[$arr2['code']] = $arr2['code'].'('.$arr2['name'].')';
                    }
                    echo "<td>";
                        echo $this->Form->input('state', array('options' => $stateArray, 'selected' => $stateSelected, 'class' => 'form-control', 'label' => false));
                    echo "</td>";
                echo "</tr>";
            echo "<tr>";
            
            echo "<tr>";
                echo "<th class=\"th-label\">登録者</th>";
                    $personSelected = array(0);
                    if(!empty($register)) {
                        $personSelected = array($register);
                    }
                    $personArray = array();
                    $personArray[0] = array('選択');
                    for ($i = 0; $i < count($person); $i++) {
                        $arr3 = $person[$i]['MstPersonIC'];
                        $personArray[$arr3['code']] = $arr3['code'].'('.$arr3['name'].')';
                    }
                    echo "<td>";
                        echo $this->Form->input('register', array('options' => $personArray, 'selected' => $personSelected, 'class' => 'form-control', 'label' => false));
                    echo "</td>";
                echo "</tr>";
            echo "<tr>";
            
            echo "<th class=\"th-label\">更新者</th>";
            echo "<td>";
                    echo $this->Form->input('updater', array('options' => $personArray, 'selected' => $personSelected, 'class' => 'form-control', 'label' => false));
            echo "</td>";
            ?>
            <tr>
                <th class="th-label">更新日付</th>
                <td><input type="text" readonly=TURE class="form-control" id="updateDateStart" name="updateDateStart" placeholder="更新日付" value = <?php if(!empty($updateDateStart))print_r($updateDateStart)?>></td>
                <td>~</td>
                <td><input type="text" readonly=TURE class="form-control" id="updateDateEnd" name="updateDateEnd" placeholder="更新日付" value = <?php if(!empty($updateDateEnd))print_r($updateDateEnd)?>></td>
                <td><button id="resetUpdate" class="btn btn-primary btn-block">初期化</button></td>
            </tr>
            <tr>
                <th class="th-label">登録日付</th>
                <td><input type="text" readonly=TURE class="form-control" id="registDateStart" name="registDateStart" placeholder="登録日付" value = <?php if(!empty($registDateStart))print_r($registDateStart)?>></td>
                <td>~</td>
                <td><input type="text" readonly=TURE class="form-control" id="registDateEnd" name="registDateEnd" placeholder="登録日付" value = <?php if(!empty($registDateEnd))print_r($registDateEnd)?>></td>
                <td><button id="resetRegist" class="btn btn-primary btn-block">初期化</button></td>
            </tr>
            <tr>
                <td td class="text-center">
                    <div>
                       <button class="btn btn-primary btn-block">検索</button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>    

<table>
<tr>
    <td>
        <div class="row">
            <?php echo $this->element('display', array('log' => $log));?>
        </div>
    </td>
</tr>

<tr><td>
<div class="row">
    <div class="col-md-12 text-center">
        <?php echo $this->element('paginator', array('model' => 'Log'));?>
    </div>
</div>
</table>
</div>