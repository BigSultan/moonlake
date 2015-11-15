<?php
/**
 * Created by PhpStorm.
 * User: Jencicek
 * Date: 15.11.2015
 * Time: 15:31
 */

namespace App\Model;
use Nette;


class MenuModel {

    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    /**
     * @param
     */

    public function nactiMenu() {
/*
        $menuDB = $this->database->table('menu')
            ->where('id_nadmenu', NULL);

        $menu = array();

        foreach ($menuDB as $menuPrvek) {
            //$menu[] = $menuPrvek['nazev'];
            $menu[$menuPrvek['id_menu']] = MenuModel::nactiPodkategorie($menuPrvek['id_menu']);
        }
*/
        return MenuModel::nactiPodkategorie(NULL);
    }

    //nacte podkategorie z db
    //[id, id, id, ...]
    public function nactiPodkategorie($kategorie) {
        $podkategorieDB = $this->database->table('menu')
            ->where('id_nadmenu', $kategorie);

        $pom = array();

        foreach ($podkategorieDB as $podkategorie) {
            if ($prvky = $this->database->table('menu')->where('id_nadmenu', $podkategorie['id_menu']))
                $pom[$podkategorie['id_menu']] = MenuModel::nactiPodkategorie($podkategorie['id_menu']);
            else
                $pom[$podkategorie['id_menu']] = NULL;
        }

        return $pom;
    }


    //nacte kategorie menu z DB
    //[id => nazev, ...]
    public function nactiKategorie() {
        $kategorieDB = $this->database->table('menu');

        $kategorie = array();

        foreach ($kategorieDB as $jednaKategorie) {
            $kategorie[$jednaKategorie['id_menu']] = $jednaKategorie['nazev'];
        }

        return $kategorie;
    }

}