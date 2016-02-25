<?php
/**
 * File FuzzTarget.php
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


class FuzzTarget implements TargetInterface
{

    /**
     * The URL tested. Without parameters.
     * @var string
     */
    private $_url;

    /**
     * Stores Parameters as
     *      "key"=>"default_value"
     * note: default value can be empty.
     * example:
     *  array(
     *      "user"     =>"admin"
     *      "password" => null
     *  )
     *
     * @var array
     */
    private $_request_parameters;

    /**
     * HTTP Verb (or method) GET/POST/PUT/...
     * @var string
     */
    private $_method;

    /**
     * Csrf's hidden input name. If not null then there is a csrf to grab
     * @var string
     */
    private $csrf;

    /**
     * FuzzTarget constructor.
     * @param string $method
     * @param string $url
     * @param array  $params
     */
    public function __construct($method = "GET", $url = "", $params = array())
    {
        $this->setMethod($method);
        $this->setUrl($url);
        $this->setParameters($params);
    }

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
    function setMethod($method)
    {
        $method = strtolower($method);
        $this->_method = $method;
    }

    /**
     * Return the HTTP Method/verb
     * @return string
     */
    function getMethod()
    {
        return $this->_method;
    }
}