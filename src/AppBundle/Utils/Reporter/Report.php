<?php

/**
 * File Report.php
 *
 * PHP Version 5.6
 *
 * @category  Class
 * @package   Package zerowing
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */

namespace AppBundle\Utils\Reporter;

class Report
{
    /** @var  string */
    private $type;
    /** @var  string */
    private $msg;

    /**
     * @param string $type
     * @return Report
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param string $msg
     * @return Report
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }


}