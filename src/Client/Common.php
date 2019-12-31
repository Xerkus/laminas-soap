<?php

/**
 * @see       https://github.com/laminas/laminas-soap for the canonical source repository
 * @copyright https://github.com/laminas/laminas-soap/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-soap/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Soap\Client;

if (extension_loaded('soap')) {

/**
 * @category   Laminas
 * @package    Laminas_Soap
 * @subpackage Client
 */
class Common extends \SoapClient
{
    /**
     * doRequest() pre-processing method
     *
     * @var callable
     */
    protected $doRequestCallback;

    /**
     * Common Soap Client constructor
     *
     * @param callable $doRequestMethod
     * @param string $wsdl
     * @param array $options
     */
    public function __construct($doRequestCallback, $wsdl, $options)
    {
        $this->doRequestCallback = $doRequestCallback;

        parent::__construct($wsdl, $options);
    }

    /**
     * Performs SOAP request over HTTP.
     * Overridden to implement different transport layers, perform additional XML processing or other purpose.
     *
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int    $version
     * @param int    $one_way
     * @return mixed
     */
    public function __doRequest($request, $location, $action, $version, $one_way = null)
    {
        if ($one_way === null) {
            return call_user_func($this->doRequestCallback, $this, $request, $location, $action, $version);
        } else {
            return call_user_func($this->doRequestCallback, $this, $request, $location, $action, $version, $one_way);
        }
    }

}

} // end if (extension_loaded('soap')
