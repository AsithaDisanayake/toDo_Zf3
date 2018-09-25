<?php
    namespace Task\Model;

    use Zend\Db\TableGateway\TableGatewayInterface;

    class TaskTable{
         
        protected $tableGateway;

        function __construct(TableGatewayInterface $tableGateway){
            $this->tableGateway = $tableGateway;
        }

        public function fetchAll(){
            return $this->tableGateway->select();
        }
    }


?> 