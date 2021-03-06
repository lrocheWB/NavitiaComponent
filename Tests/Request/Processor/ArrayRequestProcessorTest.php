<?php

namespace Navitia\Component\Tests\Request\Processor;

use Navitia\Component\Request\Processor\ArrayRequestProcessor;

/**
 * Description of ArrayRequestProcessorTest
 *
 * @author rndiaye
 */
class ArrayRequestProcessorTest extends \PHPUnit_Framework_TestCase
{
    private $service;
    private $query;

    protected function setUp()
    {
        $this->service = new ArrayRequestProcessor();
        $this->query = array(
            'api' => 'journeys',
            'parameters' => '?from=stop_area:TAN:SA:COMM&'.
                'to=stop_area:SCF:SA:SAOCE87481051&'.
                'datetime=20130819T153000&'.
                'datetime_represents=departure'
        );
    }

    /**
     * Test for ConvertToObjectRequest function
     * this request will be an instance of JourneysRequest
     */
    public function testConvertToObjectRequest()
    {
        $request = $this->service->convertToObjectRequest($this->query);
        $this->assertInstanceOf(
            'Navitia\Component\Request\JourneysRequest',
            $request
        );
    }
}
