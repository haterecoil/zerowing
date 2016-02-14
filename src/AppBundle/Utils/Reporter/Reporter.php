<?php

/**
 * File Reporter.php
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

class Reporter
{
    /** @var  Report[] */
    private $reports;

    /** @var  string */
    private $type;

    /**
     * Reporter constructor.
     * @param $type string
     */
    public function __construct($type = "")
    {
        $this->$type = $type;
    }

    // TODO secure it
    public function report($msg)
    {
        $report = new Report();
        $report->setType($this->type)
            ->setMsg($msg);

        $this->reports[] = $report;
    }

    public function getReports()
    {
        return $this->reports;
    }
}