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

        // protected function tearDown()
        // {
        //     Doctor::deleteAll();
        //     Category::deleteAll();
        // }

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
    }
?>
