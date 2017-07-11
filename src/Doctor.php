<?php
    class Doctor
    {
        private $specialty;
        private $name;
        private $id;

        function __construct($name, $specialty, $id = null)
        {
            $this->name = $name;
            $this->specialty = $specialty;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getSpecialty()
        {
            return $this->specialty;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO table_doctor (name, specialty) VALUES ('{$this->getName()}', '{$this->getSpecialty()}')");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        // return $found_doctor;
    }
?>
