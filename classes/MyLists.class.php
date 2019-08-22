<?php
    require_once("Db.class.php");

    class MyLists {
        private $title;
        

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        public function RegisterList() {
    
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('insert into lists(title) VALUES (:title)');
                $statement->bindParam(':title', $this->title);
                $statement->execute();
                $result = $statement->fetchAll();
    
                return $result;
            } catch ( Throwable $t ) {
                return false;
    
            }
        
        }
        public static function getLists() {
    
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from lists');
                $statement->execute();
                $result = $statement->fetchAll();
    
                return $result;
            } catch ( Throwable $t ) {
                return false;
    
            }
        
        }
        public static function getListInformation($listId) {
    
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from lists where id= :list_id');
                $statement->bindParam(':list_id', $listId);
                $statement->execute();
                $result = $statement->fetchAll();
    
                return $result;
            } catch ( Throwable $t ) {
                return false;
    
            }
        
        }
        public static function getListTitle($listId) {
    
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select title from lists where id= :list_id');
                $statement->bindParam(':list_id', $listId);
                $statement->execute();
                $result = $statement->fetchAll();
    
                return $result;
    
            } catch ( Throwable $t ) {
                return false;
    
            }
        
        }
    }