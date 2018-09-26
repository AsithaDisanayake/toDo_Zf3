<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Task\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Task\Form\TaskForm;
use Task\Model\Task;

class IndexController extends AbstractActionController
{
    protected $table; 

    public function __construct($table){
        $this->table = $table;                                              
    }

    public function indexAction(){   
        $tasks = $this->table->fetchAll(); 
     
        return new ViewModel(['tasks' => $tasks]);
    }

    public function addTaskAction() {        
        $form = new TaskForm(); 
        $request = $this->getRequest();
        
        if(!$request->isPost()){
            return new ViewModel(['form' => $form]);
        }else{
            error_log("dfdfgd");
        }              
        
        $task = new Task();

        $form->setData($request->getPost());      
        if($form->isValid()){
            exit('id is not correct');             
        }       
     
        $task->exchangeArray($form->getData());      
        $this->table->saveData($task);

        // return $this->redirect()->toRoute(
        //     'task',[
        //         'controller'=> 'index', 
        //         'action' => 'add-task'
        //     ]);
        
    }

    public function viewTaskAction(){
        return new ViewModel();
    }
}
