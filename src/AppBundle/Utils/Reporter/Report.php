<?php

/**
 * File Report.php
 *
 * PHP Version 5.6
 *
 * @category  Class
 * @package   Zerowing
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */

namespace AppBundle\Utils\Reporter;

/**
 * Class Report
 * @category  Class
 * @package AppBundle\Utils\Reporter
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */
class Report
{
    /**
     * Type of the report
     * @var  string
     */
    private $_type;
    /**
     * String message
     * @var  string
     */
    private $_msg;

    /**
     * Setter
     * @param string $type set type of the message
     * @return Report
     */
    public function setType($type)
    {
        $this->_type = $type;

        return $this;
    }

    /**
     * Getter
     * @return string return a message
     */
    public function getMsg()
    {
        return $this->_msg;
    }

    /**
     * Setter
     * @param string $msg set a message
     * @return Report
     */
    public function setMsg($msg)
    {
        $this->_msg = $msg;

        return $this;
    }


}