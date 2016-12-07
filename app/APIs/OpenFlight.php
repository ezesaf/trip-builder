<?php

namespace App\APIs;

use App\Contracts\Providers\AirportDataProvider;
use Exception;

class OpenFlight implements AirportDataProvider
{
    /**
     * The connection resource.
     * 
     * @var resource
     */
    protected $connection;

    /**
     * Returns a list of airports with their corresponding
     * name, city, country, IATA, FAA and/or ICAO code.
     *
     * @return array
     */
    public function getAirportData()
    {
        $url = $this->getAirportDataURL();

        $this->connect($url);
        $data = $this->parseAirportData();
        $this->closeConnection();

        return $data;
    }

    /**
     * Establishes a connection with an OpenFlight endpoint.
     * 
     * @param $url
     * @return void
     * @throws Exception
     */
    protected function connect($url)
    {
        if (($connection = fopen($url, 'rb')) === false) {
            throw new Exception('Cannot connect to OpenFlight Service');
        }

        $this->connection = $connection;
    }

    /**
     * Closes the connection with the endpoint.
     * 
     * @return void
     */
    protected function closeConnection()
    {
        if (is_resource($this->connection)) {
            fclose($this->connection);
        }
    }

    /**
     * Parses the stream of airport data as a csv
     * and returns only the required information for each airport.
     * 
     * @return array
     */
    protected function parseAirportData()
    {
        $airports = [];

        while(($data = fgetcsv($this->connection)) !== false) {
            $airports[] = [
                'name' => $data[1],
                'city' => $data[2],
                'country' => $data[3],
                'iata_faa_code' => $data[4],
                'icao_code' => $data[5],
            ];
        }

        return $airports;
    }

    /**
     * returns OpentFlight endpoint for airport data.
     * 
     * @return string
     */
    protected function getAirportDataURL()
    {
        return config('services.openflight.airports');
    }
}