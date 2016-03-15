<?php
/**
 * @author
 * @property Log $Log
 * @property MstCode $MstCode
 * @property MstPersonIC $MstPersonIC
 */
class ManagementsController extends AppController
{
    public $uses = array(
            'Log',
            'MstCode',
            'MstPersonIC'
    );
    
    public $paginate = array(
            'page' => 1,
            'conditions' => array(
                    'Log.delete_flag = ?' => 0
            ),
            'fields' => array(
                    'id',
                    'subject',
                    'detail',
                    'MstCode.name',
                    'MstPersonICR.name',
                    'MstPersonICU.name',
                    'regist_date',
                    'update_date'
            ),
            'sort' => 'id',
            'limit' => 10,
            'recursive' => 1,
            'joins' => array (
                    array (
                            'table' => 'mst_codes',
                            'alias' => 'MstCode',
                            'conditions' => 'MstCode.code
                                = Log.state'
                    ),
                    array (
                            'table' => 'mst_personics',
                            'alias' => 'MstPersonICR',
                            'conditions' => 'MstPersonICR.code
                                        = Log.register'
                    ),
                    array (
                            'table' => 'mst_personics',
                            'alias' => 'MstPersonICU',
                            'conditions' => 'MstPersonICU.code
                                        = Log.updater'
                    ))
    );
    
    public function index() {
        $this->redirect('display');
    }
    
    public function display() {
        $data = $this->params['url'];
        if (!empty($data['no'])){
            $this->set('no', $data['no']);
        }
        if (!empty($data['subject'])){
            $this->set('subject', $data['subject']);
        }
        if (!empty($data['detail'])){
            $this->set('detail', $data['detail']);
        }
        if (!empty($data['data'])){
            
            if (!empty($data['data']['state'])){
                $this->set('state', $data['data']['state']);
            }
            if (!empty($data['data']['register'])){
                $this->set('register', $data['data']['register']);
            }
            if (!empty($data['data']['updater'])){
                $this->set('updater', $data['data']['updater']);
            }
        }
        if (!empty($data['registDateStart'])){
            $this->set('registDateStart', $data['registDateStart']);
        }
        if (!empty($data['registDateEnd'])){
            $this->set('registDateEnd', $data['registDateEnd']);
        }
        if (!empty($data['updateDateStart'])){
            $this->set('updateDateStart', $data['updateDateStart']);
        }
        if (!empty($data['updateDateEnd'])){
            $this->set('updateDateEnd', $data['updateDateEnd']);
        }
        
        $condition = $this->getCondition($data);
        $log = $this->paginate('Log', $condition);
        $this->set('log', $log);
        
        $code = $this->MstCode->find('all');
        $this->set('code', $code);
        
        $person = $this->MstPersonIC->find('all');
        $this->set('person', $person);
    }
    
    public function delete($param) {
        $this->Log->id = $param;
        $this->Log->saveField('delete_flag', 1);
        $this->redirect('display');
    }
    
    public function update($param) {
        $log = $this->Log->find('first', array(
                'conditions' => array('Log.id' => $param)
        ));
        
        $this->set('log', $log);
        
        $code = $this->MstCode->find('all');
        $this->set('code', $code);
        
        $person = $this->MstPersonIC->find('all');
        $this->set('person', $person);
    }
    
    public function updateRecord() {
        if (!empty($this->data)) {
            $this->Log->id = $this->data['id'];
            $this->Log->saveField('subject', $this->data['subject']);
            $this->Log->saveField('detail', $this->data['detail']);
            $this->Log->saveField('state', $this->data['state']);
            $this->Log->saveField('register', $this->data['register']);
            $this->Log->saveField('updater', $this->data['updater']);
            $this->Log->saveField('update_date', date("Y/m/d H:i:s", time()));
        }
        $this->redirect('display');
    }
    
    private function getCondition($data) {
        $conditions = [];
        if (!empty($data['no'])){
            $no = $data['no'];
            $explode = explode('-', $no);
            //Aを探す EX:10
            if (count($explode) == 1){
                $conditions[] = array(
                        'Log.id = ? ' => $explode [0]
                );
            }
            if (count($explode) == 2){
            
                //A以下を探す EX:-10
                if ($explode [0] == ''){
                    $conditions[] = array (
                            'Log.id <= ?' => $explode [1]
                    );
                }
            
                //A以上を探す EX:10-
                if ($explode[1] == ''){
                    $conditions[] = array(
                            'Log.id >= ?' => $explode [0]
                    );
                }
            
                //AからBまで探す EX:10-20
                if ($explode[0] != '' && $explode [1] != ''){
                    $conditions[] = array(
                            'Log.id between ? and ?' => array(
                                    $explode [0],
                                    $explode [1]
                            )
                    );
                }
            }
        }
        
        if (!empty($data['subject'])){
            $subject = $data['subject'];
            $conditions[] = array(
                    'Log.subject like ?' => array(
                            "%{$subject}%"
                    )
            );
        }
        if (!empty($data['detail'])){
            $detail = $data['detail'];
            $conditions[] = array(
                    'Log.detail like ?' => array(
                            "%{$detail}%"
                    )
            );
        }
        if (!empty($data['data']['state'])){
            $state = $data['data']['state'];
            $conditions[] = array(
                    'Log.state = ? ' => $state
            );
        }
        if (!empty($data['data']['register'])){
            $register = $data['data']['register'];
            $conditions[] = array(
                    'Log.register = ? ' => $register
            );
        }
        if (!empty($data['data']['updater'])){
            $updater = $data['data']['updater'];
            $conditions[] = array(
                    'Log.updater = ? ' => $updater
            );
        }
        
        if (!empty($data['registDateStart']) || !empty($data['registDateEnd'])){
            $startTime = $data['registDateStart'];
            $endTime = $data['registDateEnd'];
            if ($startTime == '' || empty($startTime)) {
                $endTime .= ' 23:59:59';
                $conditions[] = array(
                        'Log.regist_date <= ?' => $endTime );
            } else if ($endTime == '' || empty($endTime)) {
                $startTime .= ' 00:00:00';
                $conditions[] = array(
                        'Log.regist_date >= ?' =>  $startTime);
            } else {
                $startTime .= ' 00:00:00';
                $endTime .= ' 23:59:59';
                $conditions[] = array(
                        'Log.regist_date <= ?' => $endTime );
                $conditions[] = array(
                        'Log.regist_date >= ?' =>  $startTime);
            }
        }
        
        if (!empty($data['updateDateStart']) || !empty($data['updateDateEnd'])){
            $startTime = $data['updateDateStart'];
            $endTime = $data['updateDateEnd'];
            if ($startTime == '' || empty($startTime)) {
                $endTime .= ' 23:59:59';
                $conditions[] = array(
                        'Log.update_date <= ?' => $endTime );
            } else if ($endTime == '' || empty($endTime)) {
                $startTime .= ' 00:00:00';
                $conditions[] = array(
                        'Log.update_date >= ?' =>  $startTime);
            } else {
                $startTime .= ' 00:00:00';
                $endTime .= ' 23:59:59';
                $conditions[] = array(
                        'Log.update_date <= ?' => $endTime );
                $conditions[] = array(
                        'Log.update_date >= ?' =>  $startTime);
            }
        }
        
        return $conditions;
    }
}