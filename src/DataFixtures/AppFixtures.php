<?php

namespace App\DataFixtures;

use App\Entity\BloodGroup;
use App\Entity\Document;
use App\Entity\Drug;
use App\Entity\Gender;
use App\Entity\Meet;
use App\Entity\Patient;
use App\Entity\Tour;
use App\Entity\Treatment;
use App\Repository\GenderRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // GENDER DATAS
        $male = new Gender();
        $male->setLabel('Homme');
        $female = new Gender();
        $female->setLabel('Femme');
        $manager->persist($male);
        $manager->persist($female);
        $manager->flush();

        // BLOODGROUP DATAS
        $groups = ['O+','0-','A+','A-','B+','B-','AB+','AB-'];
        foreach ($groups as $group)
        {
            $bloodGroup = new BloodGroup();
            $bloodGroup->setLabel($group);
            $manager->persist($bloodGroup);
        }
        $manager->flush();

        // DRUG DATAS
        for ($i=0;$i<=10;$i++)
        {
            $drug = new Drug();
            $drug->setLabel($faker->word);
            $manager->persist($drug);
        }
        $manager->flush();

        // TOUR DATAS
        for ($i=0;$i<10;$i++)
        {
            $tour = new Tour();
            $tour->setName($faker->word);
            $tour->setDate(new \DateTime('now'));
            $manager->persist($tour);
        }
        $manager->flush();

        // PATIENTS DATAS
        for ($i=0;$i<=10;$i++)
        {
            $patient = new Patient();
            $patient->setFirstName($faker->firstName);
            $patient->setLastName($faker->lastName);
            $patient->setHeight('1'.$faker->randomNumber(2, true));
            $patient->setWeight($faker->randomNumber(2, true));
            $patient->setSocialNumber('1234');
            $patient->setAllergies($faker->word());
            $patient->setBloodGroup($manager->getRepository(BloodGroup::class)->findAll()[random_int(0,sizeof($groups)-1)]);
            $patient->setGender($manager->getRepository(Gender::class)->findAll()[random_int(0,1)]);
            $patient->setNotes('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc risus justo, consectetur eu posuere sed, maximus eget nunc. In consequat sapien eget erat ultrices, at sagittis est ullamcorper.');
            $manager->persist($patient);
        }
        $manager->flush();

        // MEETS DATAS
        $patients = $manager->getRepository(Patient::class)->findAll();
        $tours = $manager->getRepository(Tour::class)->findAll();
        for($i=0;$i<=50;$i++)
        {
            $meet = new Meet();
            $meet->setSubject($faker->word);
            $meet->setStartDateTime($faker->dateTimeThisMonth);
            $meet->setNotes($faker->word);
            $meet->setIsUrgent($faker->randomElement([true,false]));
            $meet->setIsVideo($faker->randomElement([true,false]));
            $meet->setIsMissedMeet($faker->randomElement([true,false]));
            $meet->setTour($tours[random_int(0,count($tours)-1)]);
            $nbMeet = random_int(1,5);
            for ($j=0;$j<=$nbMeet-1;$j++)
            {
                $meet->addPatient($patients[random_int(0,count($patients)-1)]);
            }
            $manager->persist($meet);
        }
        $manager->flush();

        // TREATMENT DATAS
        for ($i=0;$i<=20;$i++)
        {
            $date = $faker->dateTimeThisMonth;
            $treatment = new Treatment();
            $treatment->setStartDate($date);
            $treatment->setEndDate($date->modify('+1 hour'));
            $treatment->setRepeats([]);
            $treatment->setPatient($patients[random_int(0,count($patients)-1)]);
            $manager->persist($treatment);
        }
        $manager->flush();

        // DOCUMENT DATAS
        for ($i=0;$i<=20;$i++)
        {
            $document = new Document();
            $document->setPatient($patients[random_int(0,count($patients)-1)]);
            $document->setName($faker->word);
            $document->setIsOrdonnance($faker->randomElement([true,false]));
            $document->setUploadAt(new \DateTime('now'));
            $manager->persist($document);
        }
        $manager->flush();
    }


}
