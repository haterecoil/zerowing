<?php
/**
 * File TargetInterface.php
 *
 * PHP Version 5.6
 *
 * @category  Interface
 * @package   zerowing
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */

namespace AppBundle\Utils\Target;

/**
 * Une cible c'est :
 *  - une route
 *  - des paramètres
 *
 * Interface TargetInterface
 * @package AppBundle\Utils\TargetInterface
 */
interface TargetInterface
{
    /**
     * Set an url, can be a URL or an IP address
     * @return mixed
     */
    function setUrl();

    /**
     * Return the url of a target
     * @return mixed
     */
    function getUrl();

    /**
     * Different parameters are useful for a TargetInterface.
     * In case of SQL Injection it would be URL parameters
     * In case of Port Scanning it would be a range of ports
     * In case of bruteforce it could be URL parameters or type of bruteforce
     * @return mixed
     */
    function setParameters();

    /**
     * Returns the parameters
     * @return mixed
     */
    function getParameters();
}