<?php

namespace Drupal\mollo_event\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;
use Drupal\node\Entity\Node;

/**
 * Class PreloadController.
 *
 * Preloading Vocabularies for better Performance
 *
 *
 *  - mollo_event_status
 *  - mollo_event_category
 *  - mollo_voice_position
 *  - mollo_instrument
 *  - mollo_function
 *  - mollo_position
 *  - mollo_speciality
 *  - mollo_country
 */
class PreloadController extends ControllerBase
{

  /**
   * Getvars.
   *
   * @return array
   *   Return Hello string.
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars(): array {
    $event_status = Helper::getTermsByName('mollo_event_status');
    $event_category = Helper::getTermsByName('mollo_event_category');
    $voice_position = Helper::getTermsByName('mollo_voice_position');
    $instrument = Helper::getTermsByName('mollo_instrument');
    $function = Helper::getTermsByName('mollo_function');
    $position = Helper::getTermsByName('mollo_position');
    $speciality = Helper::getTermsByName('mollo_speciality');
    $country = Helper::getTermsByName('mollo_country');

    return [
      'event_status' => $event_status,
      'event_category' => $event_category,
      'voice_position' => $voice_position,
      'instrument' => $instrument,
      'function' => $function,
      'position' => $position,
      'speciality' => $speciality,
      'country' => $country
    ];

  }
}
