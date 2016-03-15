<?php
/**
 * @author
 * @property dd $dd
 */
class ManagementsController extends AppController
{   
    public $uses = array(
            'MstUser',
            'MstInterpreter',
            'TrnLog',
            'MstLanguage'
    );
    
    public $paginate = array(
            'page' => 1,
            'conditions' => array(),
            'fields' => array(),
            'sort' => 'id',
            'limit' => 25,
            'recursive' => 1
    );
    
    public function index() {
       
    }
    
    public function hyouji() {
        
    }
    
    public function serach() {
        
    }
    
    public function delete() {
        
    }
    
    public function update() {
        
    }
    
    public function update2() {
        
    }
}