<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
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
                "brand_id" => 2,
                "name" => "Air Force 1 Low Tear Away Sail",
                "description" => "La marque au swoosh laisse place à la créativité avec un mystérieux Air Force 1 Tear Away Pack, composé de deux versions : Sail et White.",
                "price" =>  205,
                "image" => "fr1.png",
                "active" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "brand_id" => 2,
                "name" => "Air Max 2090 White",
                "description" => "La Nike Air Max 2090 White arbore un upper translucide, placé sur la base blanche de la paire. On note le swoosh coupé, prenant ses inspirations de la Air Max 90, dont seulement les contours noirs sont présents. Le design se complète avec un heeltab en forme de cordage plutôt moderne.",
                "price" =>  210,
                "image" => "air1.png",
                "active" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "brand_id" => 1,
                "name" => "Air Jordan 3 Animal Instinct",
                "description" => "La Air Jordan 3 Animal Instinct se compose d’un upper en pony hair combinant différents imprimés animaliers. La base noire est contrastée par un print tigre, zèbre et léopard venant apporter des touches de couleurs à la paire. On retrouve un empiècement jaune au niveau du talon avec le branding Nike Air. Le tout se finalise sur une semelle équipée de la technologie AIR pour un confort de rêve.",
                "price" =>  300,
                "image" => "j1.png",
                "active" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "brand_id" => 3,
                "name" => "New Balance 827 Abzorb White Grey",
                "description" => "New Balance s’inspire de ses archives et réédite un modèle sortie dans les années 90 : la New Balance 827 Abzorb, maintenant disponible dans un coloris plus classique.",
                "price" =>  190,
                "image" => "nw1.png",
                "active" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],
            [
                "brand_id" => 4,
                "name" => "Yeezy 700 Carbon Blue",
                "description" => "C’est le retour d’une des collaborations les plus appréciées par la communauté sneaker. Adidas et Kanye collaborent à nouveau pour nous proposer une nouvelle déclinaison du modèle Yeezy 700.",
                "price" =>  420,
                "image" => "yz1.png",
                "active" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ],

        ];


        $posts = new Product();
        $posts->insert($array);
        $posts->save();

    }
}
