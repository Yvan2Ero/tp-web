<?php

    require_once "./../../ressources/fonctions.php";
    require_once "./../vendor/autoload.php";
    require_once "./../controler/Student.class.php";

    $tab = ["Dr.", "Prof.", "Mr.", "Ms.", "Mrs."];
  
    $faker = Faker\Factory::create();
    for($i=0; $i<1000; $i++)

        {  do{
            $names = explode(" ", $faker->name);
            $name = $names[0];
            $surname = $names[1];
        }while(in_array($name, $tab));

        $date_burn = $faker->date();
        $classe = $faker->randomElement([
            "6eme","5eme","4eme All","4eme Esp","3eme All", "3eme Esp","2nde C",
            "2nde A", "1ere C", "1ere D","1ere A", "Tle C", "Tle D", "Tle A"
        ]);
        $sex = $faker->randomElement(["1","2"]);
        $student = new Student($name, $surname, $date_burn, $faker->city, $classe,"12345678","wd", $sex);
        $student->enregistrer();
    }
    echo "1000 eleves ajoutes";
