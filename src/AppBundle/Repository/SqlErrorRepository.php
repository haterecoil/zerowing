<?php

namespace AppBundle\Repository;

use AppBundle\Entity\SqlError;
use Doctrine\ORM\EntityRepository;

/**
 * SqlErrorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SqlErrorRepository extends EntityRepository
{
    /**
     * here we get the sql strings from the DB by his id
     * if id is not defined id = 1
     * @param int $id
     * @return SqlError
     */
    public function getSqlError($id = 1)
    {
        //we find one by the id
        $sql_error = $this->findOneBy(
            array('id' => $id)
        );

        // we check if the result is what we want
        //dump($sql_error);
        // we return an object
        return $sql_error;
    }

}