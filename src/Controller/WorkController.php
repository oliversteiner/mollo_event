<?php

namespace Drupal\mollo_event\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;
use Drupal\node\Entity\Node;

/**
 *
 * Get all Information from Work and Names from Composers and Writers
 *
 *  Bundle mollo_work
 * -----------------------------------------
 *    - field_mollo_composers
 *    - field_mollo_plot
 *    - field_mollo_name
 *    - field_mollo_plot_location_time
 *    - field_mollo_premiere_date
 *    - field_mollo_premiere_place
 *    - field_mollo_premiere_note
 *    - field_mollo_copyright
 *    - field_mollo_source_origin
 *    - field_mollo_world_premiere_date
 *    - field_mollo_world_premiere_place
 *    - field_mollo_world_premiere_note
 *    - field_mollo_writers
 *
 *
 **/

class WorkController extends ControllerBase
{
  // public  Vars for Twig Var Suggestion.
  // use in Template via:
  // {# @var work \Drupal\mollo_event\Controller\WorkController #}

  public $name;

  public $plot_location_time;

  public $category;

  public $work;

  public $plot;

  public $premiere_date;

  public $premiere_place;

  public $premiere_note;

  public $copyright;

  public $source_origin;

  public $world_premiere_date;

  public $world_premiere_place;

  public $world_premiere_note;

  public $composers;

  public $writers;

  /**
   * Getvars.
   *
   * @param $work_id
   *
   * @return array|string[] Return Hello string.
   *   Return Hello string.
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars($work_id): array
  {
    $variables = [
      'plot' => '',
      'name' => '',
      'plot_location_time' => '',
      'premiere_date' => '',
      'premiere_place' => '',
      'premiere_note' => '',
      'copyright' => '',
      'source_origin' => '',
      'world_premiere_date' => '',
      'world_premiere_place' => '',
      'world_premiere_note' => '',
      'composers' => '',
      'writers' => ''
    ];

    $node = Node::load($work_id);


    if (isset($node)) {




      // Get Field Content
      $plot = Helper::getFieldValue($node, 'field_mollo_plot');
      $name = Helper::getFieldValue($node, 'field_mollo_name');
      $plot_location_time = Helper::getFieldValue(
        $node,
        'field_mollo_plot_location_time'
      );
      $premiere_date = Helper::getFieldValue(
        $node,
        'field_mollo_premiere_date'
      );
      $premiere_place = Helper::getFieldValue(
        $node,
        'field_mollo_premiere_place'
      );
      $premiere_note = Helper::getFieldValue(
        $node,
        'field_mollo_premiere_note'
      );
      $copyright = Helper::getFieldValue($node, 'field_mollo_copyright');
      $source_origin = Helper::getFieldValue(
        $node,
        'field_mollo_source_origin'
      );
      $world_premiere_date = Helper::getFieldValue(
        $node,
        'field_mollo_world_premiere_date'
      );
      $world_premiere_place = Helper::getFieldValue(
        $node,
        'field_mollo_world_premiere_place'
      );
      $world_premiere_note = Helper::getFieldValue(
        $node,
        'field_mollo_world_premiere_note'
      );
      $composers_ids = Helper::getFieldValue(
        $node,
        'field_mollo_composers',
        null,
        true
      );
      $writers_ids = Helper::getFieldValue(
        $node,
        'field_mollo_writers',
        null,
        true
      );

      // Composer
      $composers = [];
      if ($composers_ids !== 0) {
        foreach ($composers_ids as $composers_id) {
          $composers[] = getArtist($composers_id);
        }
      }

      // Writer
      $writers = [];
      if ($writers_ids !== 0) {
        foreach ($writers_ids as $writers_id) {
          $writers[] = getArtist($writers_id);
        }
      }

      // Build Variables Array
      $variables = [
        'plot' => $plot,
        'name' => $name,
        'plot_location_time' => $plot_location_time,
        'premiere_date' => $premiere_date,
        'premiere_place' => $premiere_place,
        'premiere_note' => $premiere_note,
        'copyright' => $copyright,
        'source_origin' => $source_origin,
        'world_premiere_date' => $world_premiere_date,
        'world_premiere_place' => $world_premiere_place,
        'world_premiere_note' => $world_premiere_note,
        'composers' => $composers,
        'writers' => $writers
      ];
    }

    return $variables;
  }
}
