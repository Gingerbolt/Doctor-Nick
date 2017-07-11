<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Doctor.php";
    require_once __DIR__."/../src/Patient.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=doctor';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });
    // $app->get("/doctors", function() use ($app) {
    //     return $app['twig']->render('doctor.html.twig', array('doctors' => Doctor::getAll()));
    // });

    $app->get("/everyone", function() use ($app) {
        return $app['twig']->render('everyone.html.twig', array('patients' => Patient::getAll(), 'doctors' => Doctor::getALL()));
    });

    $app->post("/add_doctor", function() use ($app) {

        $name = $_POST['name'];
        $specialty = $_POST['special'];
        $doctor = new Doctor($name, $specialty);
        $doctor->save();
        return $app['twig']->render('add_doctor.html.twig', array('new_doc' => $doctor));
    });

    $app->post("/add_patient", function() use ($app) {
        $name = $_POST['name'];
        $birthdate = $_POST['birthdate'];
        $patient = new Patient($name, $birthdate);
        $patient->save();
        return $app['twig']->render('add_patient.html.twig', array('new_pat' => $patient));
    });

    $app->post("/associate", function() use ($app) {
        
        return $app['twig']->render('associate.html.twig');
    });

    $app->get("/purge", function() use ($app) {
        Doctor::deleteAll();
        Patient::deleteAll();
        return $app['twig']->render('page_cleared.html.twig');
    });

    $app->post("/delete_doctor", function() use ($app) {
        Doctor::deleteAll();
        return $app['twig']->render('index.html.twig');
    });
    $app->post("/delete_patients", function() use ($app) {
        Patient::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
?>
