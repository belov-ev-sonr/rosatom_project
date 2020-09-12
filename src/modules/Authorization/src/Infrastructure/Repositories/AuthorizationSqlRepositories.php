<?php


use Rosatom\Common\MySqlAdapter;

class AuthorizationSqlRepositories
{
    /**
     * @var MySqlAdapter
     */
    private $dbContext;

    /**
     * AuthorizationSqlRepositories constructor.
     * @param $dbContext
     */
    public function __construct()
    {
        $this->dbContext = new MySqlAdapter();
    }

    /**
     * @return MySqlAdapter
     */
    public function getDbContext(): MySqlAdapter
    {
        return $this->dbContext;
    }

    public function loginIn(AuthorizationDTO $dataLogin){
        $nameLogin = $dataLogin['nameLogin'];
        $passwordLogin = $dataLogin['passwordLogin'];
        $emailLogin = $dataLogin['emailLogin'];

        $sql = "
                SELECT 
                id 
                FROM 
                kyplinov_rosatom.user 
                WHERE 
                `name_login` = '$nameLogin' 
                OR
                `email_login` = '$emailLogin'
                AND 
                `password_login` = '$passwordLogin'
                ";

        var_dump($sql);
        die();
        $idUser = $this->dbContext->select($sql);
        return $idUser;
    }

}