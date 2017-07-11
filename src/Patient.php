<?php

    class Patient
    {
        private $name;
        private $birthdate;
        private $id;

        function __construct($name, $birthdate, $id = null)
        {
            $this->name = $name;
            $this->birthdate = $birthdate;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getBirthdate()
        {
            return $this->birthdate;
        }

        function setName($moniker)
        {
            $this->name = $moniker;
        }

        function setBirthdate($b_day)
        {
            $this->birthdate = $b_day;
        }

        static function getAll()
        {
            $returned_patients = $GLOBALS['DB']->query("SELECT * FROM table_patient");
            $patients = array();
            foreach($returned_patients as $pat) {
                $pat_name = $pat['name'];
                $pat_birthdate = $pat['birthdate'];
                $pat_id = $pat['id'];
                $new_pat = new Patient($pat_name, $pat_birthdate, $pat_id);
                array_push($patients, $new_pat);
            }
            return $patients;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM table_patient;");
            if ($executed) {
               return true;
            } else {
               return false;
            }
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO table_patient (name, birthdate) VALUES ('{$this->getName()}', '{$this->getBirthdate()}')");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }
    }

?>
