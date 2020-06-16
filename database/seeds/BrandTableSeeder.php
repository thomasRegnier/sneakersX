<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $array = [
            [
                "name" => "Jordan",
                "description" => "Créée en 1997, la marque Jordan doit tout à celui dont elle porte le nom : Michael Jordan. Véritable prodige du basket, le joueur est devenu le porte-étendard de cette marque. C'est lui que tu retrouves symbolisé par le logo jumpman présent sur tous les vêtements, chaussures et accessoires. Après avoir séduit les sportifs, la marque a conquis tous les fans de sportswear et les amateurs d'une mode stylée et branchée.",
                "logo" =>  "1592233218.jpg",
                "banner" => "jordan_header.jpg",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],

            [
                "name" => "Nike",
                "description" => "Nike inspire les athlètes du monde entier avec des produits, des expériences et des services innovants.",
                "logo" => "nike_logo.jpg",
                "banner" => "nike_header.png",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],

            [
                "name" => "New Balance",
                "description" => "Entraînez-vous en toute confiance avec les chaussures de course et vêtements signés New Balance.",
                "logo" => "newbalance_logo.jpg",
                "banner" => "1592233089.jpg",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],

            [
                "name" => "Adidas",
                "description" => "Adidas est une firme allemande fondée en 1949 par Adolf Dassler, spécialisée dans la fabrication d'articles de sport, basée à Herzogenaurach en Allemagne. Elle est mondialement connue sous l'appellation « la marque aux trois bandes », en raison des trois bandes parallèles qui constituent son logo.",
                "logo" =>   "adidas_logo.jpg",
                "banner" => "1592233153.jpg",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],

            [
                "name" => "Valentino",
                "description" => "Valentino est une maison de couture italienne, cr&eacute;&eacute;e &agrave; Rome en 1960 par Giancarlo Giammetti et Valentino Garavani. Filiale du Valentino Fashion Group, elle est depuis 2012 la propri&eacute;t&eacute; de la famille r&eacute;gnante du Qatar par l'interm&eacute;diaire d'un de leurs fonds d'investissement.",
                "logo" =>   "1592227419.jpg",
                "banner" => "1592227421.jpg",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
        ];


        $posts = new Brand;
        $posts->insert($array);
        $posts->save();
    }
}
