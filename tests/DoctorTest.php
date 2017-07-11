<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Doctor.php";
    // require_once "src/Patient.php";

    $server = 'mysql:host=localhost:8889;dbname=doctor_office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DoctorTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Doctor::deleteAll();
            Patient::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $test_doctor_name = "Bob Ross";
            $test_doctor_specialty = "Bedside Manner";
            $test_doc = new Doctor($test_doctor_name, $test_doctor_specialty);

            //Act
            $executed = $test_doc->save();

            // Assert
            $this->assertTrue($executed, "Item not successfully saved to database");
        }

        function testGetAll()
        {
            $test_doctor_name = "Doctor Nick";
            $test_doctor_specialty = "Budget spleen repair";
            $test_doc = new Doctor($test_doctor_name, $test_doctor_specialty);
            $test_doc->save();

            $test_doctor_name_2 = "Dr. Kevorkian";
            $test_doctor_specialty_2 = "Creative life enhancement";
            $test_doc_2 = new Doctor($test_doctor_name_2, $test_doctor_specialty_2);
            $test_doc_2->save();

            $result = Doctor::getAll();
            $this->assertEquals([$test_doc, $test_doc_2], $result);

        }

        function testDeleteAll()
        {
            //Arrange
            $test_doctor_name = "1912 Louisville Slugger";
            $test_doctor_specialty = "Ricky Ricardo's Microphone";
            $test_doctor_name_2 = "Dr. Kevorkian";
            $test_doctor_specialty_2 = "Creative life enhancement";
            $test_doc = new Doctor($test_doctor_name, $test_doctor_specialty);
            $test_doc->save();
            $test_doc_2 = new Doctor($test_doctor_name_2, $test_doctor_specialty_2);
            $test_doc_2->save();

            //Act
            Doctor::deleteAll();

            //Assert
            $result = Doctor::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
