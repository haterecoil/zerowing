<?php
/**
 * File Reporter.php
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
 * Class Reporter
 * @category  Class
 * @package AppBundle\Utils\Reporter
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */
class Reporter
{
    /**
     * Store all reports
     * @var  Report[]
     */
    private $_reports;

    /**
     * Type of the Reports
     * @var  string
     */
    private $_type;

    /**
     * Reporter constructor.
     * @param string $type the type of the report
     */
    public function __construct($type = "")
    {
        $this->_type = $type;
    }

    /**
     * Log a message
     * @param bool $success
     * @param string $msg A message to you ho... :)
     */
    public function report($success, $msg)
    {
        $report = new Report();
        $report->setType($this->_type)
            ->setSuccess($success)
            ->setMsg($msg);

        $this->_reports[] = $report;
    }

    /**
     * Return all reports
     * @return Report[]
     */
    public function getReports()
    {
        return $this->_reports;
    }
}