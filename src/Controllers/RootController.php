<?php
/*
 * QualityCallTesterLib
 *
 * This file was automatically generated by APIMATIC BETA v2.0 on 12/07/2015
 */

namespace QualityCallTesterLib\Controllers;

use QualityCallTesterLib\APIException;
use QualityCallTesterLib\APIHelper;
use QualityCallTesterLib\Configuration;
use Unirest\Unirest;
class RootController {

    /* private fields for configuration */

    /**
     * API Authentication Token 
     * @var string
     */
    private $xAPITOKEN;

    /**
     * Constructor with authentication and configuration parameters
     */
    function __construct($xAPITOKEN)
    {
        $this->xAPITOKEN = $xAPITOKEN ? $xAPITOKEN : Configuration::$xAPITOKEN;
    }

    /**
     * Allow clients to test authentication.
     * @return mixed response from the API call*/
    public function getAuthentications () 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/authentications';

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json',
            'X-API-TOKEN' => $this->xAPITOKEN
        );

        //prepare API request
        $request = Unirest::get($queryUrl, $headers);

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 403) {
            throw new APIException('User not authorized to perform the operation', 403);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code);
        }

        return $response->body;
    }
        
}