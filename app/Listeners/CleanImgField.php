<?php

namespace App\Listeners;

use App\Models\Product;

/*
 * L'enregistrement de l'image avec Cloudinary renvoie un identifiant de fichier.
 * L'idée est d'intercepter l'enregistrement et de formater cet identifiant avant de l'enregistrer en base.
 */

class CleanImgField
{
    public function handle(Product $product)
    {
        $img = $product->img;

        // Nettoyer le nouvel identifiant
        while (is_string($img) && $this->isJson($img)) {
            $img = json_decode($img, true);
        }

        // getOriginal permet de récupérer les données originales, directement en base de données
        $original = $product->getOriginal('img');

        /* 
        * Le "sur-enregistrement" d'identifiants peut avoir comme effet de "sur-encoder" les identifiants déjà en base.
        * On doit donc les nettoyer pour qu'ils ne soient encodé qu'une seule fois, comme l'identifiant à ajouter.
        */
        while (is_string($original) && $this->isJson($original)) {
            $original = json_decode($original, true);
        }

        // Si original n'est pas un tableau (ce qui est normal lors du premier enregistrement), alors forcer un tableau vide
        if (!is_array($original)) {
            $original = [];
        }

        /* Fusionner les images déjà en base avec celles entrantes.
         * array_unique permet de supprimer les doublons le cas échéant.
         * array_merge permet de fusionner les tableaux.
         */
        $merged = array_unique(array_merge($original, is_array($img) ? $img : []));

        if (count($merged) < 2) {
            throw new \Exception('Le champ "img" doit contenir entre deux et quatre images.');
        }

        // Mettre à jour avec les images fusionnées
        $product->img = array_values($merged);
    }

    private function isJson($string)
    {
        if (!is_string($string)) {
            return false;
        }
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
}
