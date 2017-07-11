<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patient.php";

    $server = 'mysql:host=localhost:8889;dbname=doctor_office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Doctor::deleteAll();
            Patient::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $test_patient_name = "Jeff Sessions";
            $test_patient_birthdate = 07/10/1940;
            $test_patient = new Patient($test_patient_name, $test_patient_birthdate);

            //Act
            $executed = $test_patient->save();

            // Assert
            $this->assertTrue($executed, "Patient not successfully saved to database");
        }

        function testGetAll()
        {
            $test_patient_name = "Slade Wilson";
            $test_patient_birthdate = date('1966-06-06 06:06:06');
            $test_pat = new Patient($test_patient_name, $test_patient_birthdate);
            $test_pat->save();

            $test_patient_name_2 = "Solomon Grundy";
            $test_patient_birthdate_2 = date('1977-07-07 07:07:07');
            $test_pat_2 = new Patient($test_patient_name_2, $test_patient_birthdate_2);
            $test_pat_2->save();

            $result = Patient::getAll();

            $this->assertEquals([$test_pat, $test_pat_2], $result);

        }

        function testDeleteAll()
        {
            //Arrange
            $test_patient_name = "Slade Wilson";
            $test_patient_birthdate = date('1966-06-06 06:06:06');
            $test_pat = new Patient($test_patient_name, $test_patient_birthdate);
            $test_pat->save();

            $test_patient_name_2 = "Solomon Grundy";
            $test_patient_birthdate_2 = date('1977-07-07 07:07:07');
            $test_pat_2 = new Patient($test_patient_name_2, $test_patient_birthdate_2);
            $test_pat_2->save();

            //Act
            Patient::deleteAll();

            //Assert
            $result = Patient::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
