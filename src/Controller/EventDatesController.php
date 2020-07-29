<?php

namespace Drupal\mollo_event\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;

/**
 * Class EventDatesController.
 *
 *
 *  Bundle mollo_event_date
 * -----------------------------------------
 */
class EventDatesController extends ControllerBase
{
  // public  Vars for Twig Var Suggestion.
  // use in Template via:
  // {# @var event_date \Drupal\mollo_event\Controller\EventDatesController #}

  public $event;

  public $number;

  public $status;

  public $start;

  public $end;

  public $door_opening;

  public $location;

  public $description;

  public $show_start;

  public $show_end;

  public $host;

  public $director;

  public $notes;

  /**
   * Getvars
   *
   *    Bundle mollo_event_date
   * -----------------------------------------
   *
   *
   *    - field_mollo_event
   *    - field_mollo_number
   *    - field_mollo_status   TODO: make own Voc like mollo_event_date_status
   *    - field_mollo_start
   *    - field_mollo_end
   *    - field_mollo_door_opening
   *    - field_mollo_locations
   *    - field_mollo_description
   *    - field_mollo_show_start
   *    - field_mollo_show_end
   *    - field_mollo_host
   *    - field_mollo_director
   *    - field_mollo_notes
   *
   *
   *
   * @param $date_id
   *
   * @return array|string[]
   *   Return Event Date Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars($date_id, $vocabularies): array
  {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($date_id);

    if (isset($node)) {
      $event = Helper::getFieldValue($node, 'field_mollo_event');
      $number = Helper::getFieldValue($node, 'field_mollo_number');
      $status = Helper::getFieldValue($node, 'field_mollo_status');
      $start = Helper::getFieldValue($node, 'field_mollo_start');
      $end = Helper::getFieldValue($node, 'field_mollo_end');
      $door_opening = Helper::getFieldValue($node, 'field_mollo_door_opening');
      $location_ids = Helper::getFieldValue($node, 'field_mollo_locations',null,TRUE);
      $description = Helper::getFieldValue($node, 'field_mollo_description');
      $show_start = Helper::getFieldValue($node, 'field_mollo_show_start');
      $show_end = Helper::getFieldValue($node, 'field_mollo_show_end');
      $host = Helper::getFieldValue($node, 'field_mollo_host');
      $director = Helper::getFieldValue($node, 'field_mollo_director');
      $notes = Helper::getFieldValue($node, 'field_mollo_notes');

      // get Names



      // Build Variables Array
      return [
        'event' => $event,
        'number' => $number,
        'status' => $status,
        'start' => $start,
        'end' => $end,
        'door_opening' => $door_opening,
        'location_ids' => $location_ids,
        'description' => $description,
        'show_start' => $show_start,
        'show_end' => $show_end,
        'host' => $host,
        'director' => $director,
        'notes' => $notes
      ];
    }
    return [];
  }

  /**
   * @param $event_id
   * @param $vocabularies
   *
   * @param $locations
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getDatesFromEvent($event_id, $vocabularies, $locations): array
  {
    $dates = [];

    // load all Node IDs from "mollo_event_date" with mollo_event ID
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_event_date')
      ->condition('field_mollo_event', $event_id)
      // Order
        ->sort('field_mollo_start', 'ASC')
      // Access
      ->accessCheck(false);

    $date_ids = $query->execute();

    // Nodes found
    if (count($date_ids) !== 0) {
      // Load all Dates
      foreach ($date_ids as $date_id) {
        // Output Array
        $date = self::getVars($date_id, $vocabularies);

        // Add Location
        // TODO can only get first Location
        $location_ids = $date['location_ids'];
        foreach ($locations as $location){
          if($location['id'] === $location_ids[0]){
            $date['location'] = $location;
          }
        }

      $dates[] = $date;
      }
    }

    return $dates;
  }
}
