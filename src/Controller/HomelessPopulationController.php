<?php

namespace Drupal\homeless_population\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\homeless_population\Services\HomelessNewYorkCityJson;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HomelessPopulationController extends ControllerBase {
  private $homelessData;

  /**
   * HomelessPopulationController constructor.
   * @param $homelessData
   */
  public function __construct(HomelessNewYorkCityJson $homelessData) {
    $this->homelessData = $homelessData;
  }

  /**
   * @return array
   * Returns homeless population from service pulling from City of New York data.
   */
  public function homelessStats() {
    $homelessJsonArray = $this->homelessData->HomelessPopulationData();

    return [
      '#theme' => 'homeless_demographics',
      '#homelessData' => $homelessJsonArray,
    ];
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @return static
   * Drupal's dependency injection to inject custom service pulling NYC homeless data.
   */
  public static function create(ContainerInterface $container) {
    $homelessData = $container->get('homeless.nyc.population.yearly');

    return new static($homelessData);
  }
}