<?php
    class Doctor
    {
        private $specialty;
        private $name;
        private $id;
        private $patient;

        function __construct($name, $specialty, $id = null, $patient = null)
        {
            $this->patient = $patient;
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

        function getID()
        {
            return $this->id;
        }

        function getPatient()
        {
            return $this->patient;
        }

        function setPatient($patient_id)
        {
            $this->patient = $patient_id;
        }

        function setSpecialty($special)
        {
            $this->specialty = $special;
        }

        function setName($moniker)
        {
            $this->name = $moniker;
        }

        static function getAll()
        {
            $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM table_doctor");
            $doctors = array();
            foreach($returned_doctors as $doc) {
                $doc_name = $doc['name'];
                $doc_specialty = $doc['specialty'];
                $doc_id = $doc['id'];
                $new_doc = new Doctor($doc_name, $doc_specialty, $doc_id);
                array_push($doctors, $new_doc);
            }
            return $doctors;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM table_doctor;");
            if ($executed) {
               return true;
            } else {
               return false;
            }
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
        function recordPatientRelationship($pID)
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO table_doctor_patient (doctor_id, patient_id) VALUES ('{$this->getID}', '{$pID}')");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }
    }
?>
