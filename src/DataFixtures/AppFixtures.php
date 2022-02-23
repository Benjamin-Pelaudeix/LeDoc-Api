<?php

namespace App\DataFixtures;

use App\Entity\BloodGroup;
use App\Entity\Gender;
use App\Entity\Patient;
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

        // PATIENTS DATAS
        for ($i=0;$i<=10;$i++)
        {
            $patient = new Patient();
            $patient->setFirstName($faker->firstName);
            $patient->setLastName($faker->lastName);
            $patient->setHeight('1'.$faker->randomNumber(2, true));
            $patient->setWeight($faker->randomNumber(2, true));
            $patient->setSocialNumber($faker->randomNumber(7,true).$faker->randomNumber(7,true));
            $patient->setAllergies($faker->word());
            $patient->setBloodGroup($manager->getRepository(BloodGroup::class)->findAll()[random_int(0,sizeof($groups)-1)]);
            $patient->setGender($manager->getRepository(Gender::class)->findAll()[random_int(0,1)]);
            $patient->setNotes('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc risus justo, consectetur eu posuere sed, maximus eget nunc. In consequat sapien eget erat ultrices, at sagittis est ullamcorper.');
            $manager->persist($patient);
        }
        $manager->flush();
    }
}
