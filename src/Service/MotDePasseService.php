<?php
declare(strict_types=1);

namespace App\Service;



class MotDePasseService {

    /**
     * @param $unMotDePasse
     * @return bool
     */
    public static function estRobuste($unMotDePasse) : bool {
        return strlen($unMotDePasse) >= 8;
    }

}