<?php

namespace Rosatom\Authorization\Application\Service;

use AuthorizationDTO;
use AuthorizationSqlRepositories;

class AutorizationCRUD
{

    public function loginIn(AuthorizationDTO $dataLogin){
        $loginIn = new AuthorizationSqlRepositories();
        $userId = $loginIn->loginIn($dataLogin);
        return $userId;
    }

}