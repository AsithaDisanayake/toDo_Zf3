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

        public function saveData($task){
            
             error_log("111111111111111");
            $data = [
                'name' => $task->getName(),
                'description' => $task->getDescription(),
                'startdate' => $task->getStartDate(),
                'enddate' => $task->getEnddate(),
            ];
            return $this->tableGateway->insert($data);
        }
    }


?> 