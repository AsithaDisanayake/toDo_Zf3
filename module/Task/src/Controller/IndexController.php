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
use Zend\View\Model\JsonModel; 

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
            
        }              
        
        $task = new Task();

        $form->setData($request->getPost());      
        if(!$form->isValid()){
            // echo '<script language="javascript">';
            // echo 'alert("check the fields")';
            // echo '</script>';
            return new ViewModel(['form' => $form]);           
        }       
     
        $task->exchangeArray($form->getData());      
        $this->table->saveData($task);

        return $this->redirect()->toRoute(
            'task',[
                'controller'=> 'index', 
                'action' => 'add-task'
            ]);
        
    }

    public function viewTaskAction(){
       $id = (int) $this->params()->fromRoute('id','0');
       if($id == 0){
           exit('Error');
       }

       try{
            $task= $this->table->getTask($id);
       }catch(Exception $e){
            exit('Error');
       }
       //var_dump($task);
       return new viewModel([
           'task' => $task,
            'id' => $id  
       ]);
    }

    public function editTaskAction(){
        
        $id = (int) $this->params()->fromRoute('id','0');
       if($id == 0){
           exit('Error');
       }

       try{
            $task= $this->table->getTask($id);
       }catch(Exception $e){
            exit('Error');
       }
      
       $form = new TaskForm();
       $form->bind($task);
       $request = $this->getRequest();
       if(!$request->isPost()){
           return new ViewModel([
               'form' => $form,
               'id' => $id
           ]);
       }

       $form->setData($request->getPost());
       if(!$form->isValid()){
           exit('ERROR !');
       }

       $this->table->saveData($task);
            return $this->redirect()->toRoute('task',[
                'controller' => 'index',
                'action' => '',
                'id' => $id
            ]);
        
         

    }

    public function deleteAction(){
        // $viewRender = $this->getServiceLocator()->get('ViewRenderer');
        // $html = $viewRender->render($viewModel);
        $id = (int) $this->params()->fromRoute('id','0');   
        if($id == 0){
            exit('Error');
        }    
        $delete = $this->table->deleteTask($id);
        if($delete){

            echo json_encode(array('data' => 'success'));
            $jsonData = json_encode(array('data' => 'success'));
            $view = new JsonModel($jsonData); 
            $view->setTerminal(true); 
            return view;
            //  return new JsonModel(array(
            //     'data' => 'success',
            // ));
        }
  
    }

    public function completeAction(){
        $id = (int) $this->params()->fromRoute('id','0');   
        if($id == 0){
            exit('Error');
        }    
        $complete = $this->table->completeTask($id);
        if($complete){

            echo json_encode(array('data' => 'success'));
            
            // return new JsonModel(array(
            //     'data' => 'success',
            // ));
        }
  
    }
} 
