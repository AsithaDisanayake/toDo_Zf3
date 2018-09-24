<?php

namespace Task\Model;

class Task{
    protected $id;
    protected $name;
    protected $description;
    protected $startdate;
    protected $enddate;

    public function exchangeArray($data){

        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->startdate = $data['startdate'];
        $this->enddate = $data['enddate'];


    }


    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getStartdate(){
        return $this->startdate;
    }

    public function getEnddate(){
        return $this->enddate;
    }

}
?>