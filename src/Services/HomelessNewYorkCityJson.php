<?php

namespace Drupal\homeless_population\Services;

use GuzzleHttp\Exception\RequestException;
use Drupal\Component\Serialization\Json;

class HomelessNewYorkCityJson {
  public function HomelessPopulationData() {
    // Data source for NYC homeless population from 2009-2012.
    $homelessUri = 'https://data.cityofnewyork.us/api/views/5t4n-d72c/rows.json';

    // Attempt to make connection to get json response for the data and return as array.
    try {
      $homelessResponse = \Drupal::httpClient()->get($homelessUri, array(
        'Accept' => 'application/json'
      ));
      $homelessData = $homelessResponse->getBody();
      if (empty($homelessData)) {
        return FALSE;
      }
    }
    catch (RequestException $e) {
      return FALSE;
    }

    return Json::decode($homelessData);
  }
}