<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $numPhoto=array(6,7,9,10,12,13,15,16);
        $nom=array('Wampas','Brain Damage','JP Manova','Sax Machine','The Stranglers','The Bad Plus','Maalouf','Fat Freddy\'s Drop');
        $prenom=array('Didier','','','','','','Ibrahim','');
        $artistes=array();
        $nb=count($numPhoto);
        for($i=0;$i<$nb;$i++) {
            $artiste = new Artiste(
                $nom[$i] . "",
                $prenom[$i] . "",
                $numPhoto[$i] . ".jpg",
                $nom[$i] . " Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
            );
            $artistes[]=$artiste;
            $manager->persist($artiste);
        }

        for($i=0;$i<$nb;$i++){
            $concert=new Concert(new \DateTime(mt_rand(-60,+60).' day'),"Super Concert",mt_rand(10,50));
            $concert->setArtiste($artistes[$i]);
            $manager->persist($concert);
        }

        $manager->flush();
    }
}
