<?php
namespace Task\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class TaskForm  extends Form{
    public function __construct($name = null) {
        parent::__construct('task');
        $this->setAttribute('method','POST');
         
        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'text',
            // 'class'=>'form-control',
            'options' => [
                'label' => 'Name'
            ]
        ]); 

        $this->add([
            'name' => 'description',
            'type' => 'textarea',
            // 'class'=>'form-control',
            'options' => [
                'label' => 'Description'
            ]
        ]);

        $this->add([
            'name' => 'startdate',
            'type' => 'date',
            // 'class'=>'form-control',
            'options' => [
                'label' => 'Start Date'
            ]
        ]);

        $this->add([
            'name' => 'enddate',
            'type' => 'date',
            // 'class'=>'form-control',
            'options' => [
                'label' => 'End Date'
            ]
        ]);

        $this->add([
            'name' => 'status',
            'type' => 'hidden',
            // 'class'=>'form-control',
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'buttonSave'
            ],
            // 'class'=>'btn btn-submit'
        ]);
    }    
}



?>