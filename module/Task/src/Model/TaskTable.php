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
            $data = [
                'name' => $task->getName(),
                'description' => $task->getDescription(),
                'startdate' => $task->getStartDate(),
                'enddate' => $task->getEnddate(),
            ];

            if($task->getId()){
                $this->tableGateway->update($data,[
                    'id' => $task->getId()
                ]);
            }else{
                $this->tableGateway->insert($data);
            }

            
        }

        public function getTask($id){
            $data = $this->tableGateway->select(['id' => $id]);
            return $data->current();
        }

        public function deleteTask($id){
          
            $this->tableGateway->delete([
                'id' => $id
            ]);
        }


        public function completeTask(){
            
        }

    }


?> 