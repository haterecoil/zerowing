<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Account;
use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
    public function getAccount($username, $password) {
        $password = sha1($password);

        $account = $this->findOneBy(array(
        'username' => $username,
        'password' => $password
        ));

        return ($account instanceof Account) ? $account : null;
    }
}