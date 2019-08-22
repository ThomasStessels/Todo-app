<?php
    require_once("Db.class.php");

    class Todo {
        private $title;
        private $time;
        private $date;
        private $userId;
        private $todoId;
        private $listId;
       

        /**
         * Get the value of naam
         */ 
        public function getTitle()
        {
                return $this->title;
        }
        /**
         * Set the value of naam
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }
        /**
         * Get the value of time
         */ 
        public function getTime()
        {
                return $this->time;
        }
        /**
         * Set the value of time
         *
         * @return  self
         */ 
        public function setTime($time)
        {
                $this->time = $time;

                return $this;
        }
        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }
        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }
        /**
         * Get the value of userId
         */ 
        public function getUserId()
        {
                return $this->userId;
        }
        /**
         * Set the value of userId
         *
         * @return  self
         */ 
        public function setUserId($userId)
        {
                $this->userId = $userId;

                return $this;
        }
             /**
         * Get the value of todoId
         */ 
        public function getTodoId()
        {
                return $this->todoId;
        }

        /**
         * Set the value of todoId
         *
         * @return  self
         */ 
        public function setTodoId($todoId)
        {
                $this->todoId = $todoId;

                return $this;
        }

        /**
         * Get the value of listId
         */ 
        public function getListId()
        {
                return $this->listId;
        }

        /**
         * Set the value of listId
         *
         * @return  self
         */ 
        public function setListId($listId)
        {
                $this->listId = $listId;

                return $this;
        }

        public function registerTodo() {
    
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('insert into todos( title, time, date, list_id) VALUES (:title, :time, :date, :listId)');
                $statement->bindParam(':title', $this->title);
                $statement->bindParam(':time', $this->time);
                $statement->bindParam(':date', $this->date);
                $statement->bindParam(':listId', $this->listId);
                $statement->execute();
    
            } catch ( Throwable $t ) {
                return false;
    
            }
        
        }
        public function updateTodo() {
                try {
                    $conn = Db::getInstance();
                    $statement = $conn->prepare('update todos set ( title, time, date) VALUES (:title, :time, :date) where id = :todo_id');
                    $statement->bindParam('todo_id', $this->todoId);
                    $statement->bindParam(':title', $this->title);
                    $statement->bindParam(':time', $this->time);
                    $statement->bindParam(':date', $this->date);
                    $statement->execute();       
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }

        public static function getTodos()
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from todos ORDER BY date DESC');
                $statement->execute();
                $result = $statement->fetchAll();

                return $result;
            } catch (Throwable $t) {
                echo $t;
            }
        }
        public static function getTodosFromList($listId)
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from todos where list_id= :list_id');
                $statement->bindParam(':list_id', $listId);
                $statement->execute();
                $result = $statement->fetchAll();

                return $result;
            } catch (Throwable $t) {
                echo $t;
            }
        }
        public static function getCheckedTodos()
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from todos where done=1 ORDER BY date ASC');
                $statement->execute();
                $result = $statement->fetchAll();

                return $result;
            } catch (Throwable $t) {
                echo $t;
            }
        }
        public static function getUncheckedTodos()
        {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from todos where done=0 ORDER BY date ASC');
                $statement->execute();
                $result = $statement->fetchAll();

                return $result;
            } catch (Throwable $t) {
                echo $t;
            }
        }



        public static function getTodoInfo($todoId) {
                try {
                        $conn = Db::getInstance();
                        $statement = $conn->prepare('select * from todos where id= :todo_id');
                        $statement->bindParam(':todo_id', $todoId);
                        $statement->execute();
                        
                        return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                } catch ( Throwable $t ) {
                        return false;
            
                    }
        } 

        public static function canAdd($userId, $admins) {
                if (in_array($userId, $admins) ) {
                        return "visible";
                    } else {
                        return "invisible";
                    }
        }

        public static function onlyAdmin($userId, $admins) {
                if (in_array($userId, $admins)) {
                        return "visible";
                    } else {
                        return "invisible";
                    }
        }

        public static function checkTodo($todoId) {
                try {
                    $conn = Db::getInstance();
                    $statement = $conn->prepare('update todos set done= 1 where id = :todo_id');
                    $statement->bindParam('todo_id', $todoId);
                    $statement->execute();       
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }

            public static function uncheckTodo($todoId) {
                try {
                    $conn = Db::getInstance();
                    $statement = $conn->prepare('update todos set done= 0 where id = :todo_id');
                    $statement->bindParam('todo_id', $todoId);
                    $statement->execute();       
            } catch ( Throwable $t ) {
                    return false;
        
                }
            }

   
    }