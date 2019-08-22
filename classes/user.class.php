<?php

    require_once("Security.class.php");
    require_once("Db.class.php");


    class User {
        private $voornaam;
        private $familienaam;
        private $email;
        private $password;
        private $passwordConfirmation;



        /**
         * Get the value of voornaam
         */ 
        public function getVoornaam()
        {
                return $this->voornaam;
        }

        /**
         * Set the value of voornaam
         *
         * @return  self
         */ 
        public function setVoornaam($voornaam)
        {
                $this->voornaam = $voornaam;

                return $this;
        }

        /**
         * Get the value of familienaam
         */ 
        public function getFamilienaam()
        {
                return $this->familienaam;
        }

        /**
         * Set the value of familienaam
         *
         * @return  self
         */ 
        public function setFamilienaam($familienaam)
        {
                $this->familienaam = $familienaam;

                return $this;
        }
        
        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }  
        /**
         * Get the value of passwordConfirmation
         */ 
        public function getPasswordConfirmation()
        {
                return $this->passwordConfirmation;
        }

        /**
         * Set the value of passwordConfirmation
         *
         * @return  self
         */ 
        public function setPasswordConfirmation($passwordConfirmation)
        {
                $this->passwordConfirmation = $passwordConfirmation;

                return $this;
        }
        

        
        /**
         * @return boolean - true if registration, false if unsuccessful.
         */
        public function register() {

                $password = Security::hash($this->password);
        
                try {
                    $conn = Db::getInstance();
                    $statement = $conn->prepare('INSERT INTO user (voornaam, familienaam, email, password) values (:voornaam, :familienaam, :email, :password)');
                    $statement->bindParam(':voornaam', $this->voornaam);
                    $statement->bindParam(':familienaam', $this->familienaam);
                    $statement->bindParam(':email', $this->email);
                    $statement->bindParam(':password', $password);  
                    $statement->execute();
                
                    $getData = $conn->prepare('select * from user where email = :email');
                    $getData->bindParam(':email', $this->email);
                    $getData->execute();
                    $data = $getData->fetchAll();
                
                    if(!empty($data)){
                        return array($data[0]['id'], $data[0]['email']);
                    }else{
                        return false;
                    }

        
                } catch ( Throwable $t ) {
                    return false;
        
                }
            
        }

        public static function checkLogin()
        {
            if (isset($_SESSION)) {
                // session_start();
            }
            if (!isset($_SESSION['user'])) {
                header('Location: login.php');
            }
        }

        public static function findByEmail($email){
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from user where email = :email limit 1");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if(!empty($result)){
                    return true;
            }else{
                    return false;
            }
            
        }

        public static function isAccountAvailable($email){
            $e = self::findByEmail($email);
            
            // PDO returns false if no records are found so let's check for that
            if($e == false){
                return true;
            } else {
                return false;
            }
        }

        public function canILogin(){
                $conn = Db::getInstance();
                $statement = $conn->prepare("select * from user where email = :email");
                $statement->bindParam(":email", $this->email);
                $statement->execute();
                $result = $statement->fetchAll();
                // var_dump($result);
                if(!empty($result)){
                    if(password_verify($this->password, $result[0]['password'])){
                        return array($result[0]['id'], $result[0]['email']);
                    }
                    return false;
                }
        }

        public static function getUserById($id){
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from user where id = :id');
                $statement->bindParam(':id', $id);
                $statement->execute();
                $result = $statement->fetch();
                return $result;
        }

        


    }
