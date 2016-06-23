<?php

require_once 'vendor/autoload.php';

use Doctrine\Common\Annotations\AnnotationRegistry;
use Navitia\Component\Request\DeparturesRequest;
use Navitia\Component\Request\Parameters\CoverageDeparturesParameters;
use Navitia\Component\Service\ServiceFacade;

// must be called to register Doctrine annotations
AnnotationRegistry::registerLoader('class_exists');

/**
 *  ************* Configuration ************
 */

$config = array(
    'url' => 'api.navitia.io',
    'token' => '3b036afe-0110-4202-b9ed-99718476c2e0', // This token has an access to sandbox data
);

$client = ServiceFacade::getInstance(new \Psr\Log\NullLogger());
$client->setConfiguration($config);

/**
 *  ************* First solution ************
 */

$query = array(
    'api' => 'departures',
    'parameters' => array(
        'region' => 'sandbox',
        'path_filter' => '/lines/line:RAT:M1/departures?from_datetime=20160615T1337'
    ),
);

$result = $client->call($query); // Returns an object with Api result

var_dump($result);

/**
 *  ************* Second solution ************
 */

$query = new DeparturesRequest();
$query->setRegion('sandbox')->setPathFilter('lines/line:RAT:M1');

$actionParameters = new CoverageDeparturesParameters();
$actionParameters->setDuration(1);
$actionParameters->setFromDatetime('20160615T1337');
$actionParameters->setForbiddenUris(['lines', 'modes']);
$actionParameters->setDataFreshness('realtime');

$query->setParameters($actionParameters);

$result = $client->call($query);

var_dump($result);
