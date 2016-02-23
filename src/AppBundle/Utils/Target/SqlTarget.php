<?php
/**
 * File SqlTarget.php
 *
 * PHP Version 5.6
 *
 * @category  Class
 * @package   zerowing
 * @author    mrgn <xyz@example.com>
 * @copyright 2016 mrgn
 * @license   MIT http://choosealicense.com/licenses/mit/
 * @link      http://lorem.ovh
 */

namespace AppBundle\Utils\Target;


class SqlTarget implements TargetInterface
{

    /**
     * The URL tested. Without parameters.
     *
     * @var string
     */
    private $_url;

    /**
     * Stores Parameters as
     *  "key"=>"default_value"
     *  note: defautl value can be empty.
     *
     * example: http://lorem.ovh?user=adminpassword=
     * array(
     *  "user"     =>"admin"
     *  "password" => null
     * "key"=>nomdelakey
     * )
     *
     * @var array
     */
    private $_request_parameters;
    private $_method;

    /**
     * @inheritdoc
     * @return void
     */
    function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * @inheritdoc
     * @return string
     */
    function getUrl()
    {
        return $this->_url;
    }

    /**
     * @inheritdoc
     * @return void
     */
    function setParameters($params)
    {
        $this->_request_parameters = $params;
    }

    /**
     * @inheritdoc
     * @return array
     */
    function getParameters()
    {
        return $this->_request_parameters;
    }

    /**
     * Set the HTTP Method/Verb
     * @param string $method
     * @return bool
     */
    function setMethod($method){
        $method = strtolower($method);
        $this->_method = $method;
    }

    /**
     * Return the HTTP Method/verb
     * @return string
     */
    function getMethod(){
        return $this->_method;
    }
}