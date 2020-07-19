<?php

namespace Drupal\mollo_event\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;
use Drupal\node\Entity\Node;

/**
 * Class ArtistController.
 *
 * Get all Information from Work and Names from Composers and Writers
 *
 *  Bundle mollo_work
 * -----------------------------------------
 */
class ArtistController extends ControllerBase {
  // public  Vars for Twig Var Suggestion.
  // use in Template via:
  // {# @var artist \Drupal\mollo_event\Controller\ArtistController #}

public $artist_groups;
public $birthday;
public $city;
public $email;
public $entry;
public $event;
public $facebook;
public $first_name;
public $function;
public $hystoric;
public $instrument;
public $is_active;
public $last_name;
public $links;
public $media;
public $mobile;
public $phone;
public $position;
public $resigning;
public $speciality;
public $street_and_number;
public $title_image;
public $token;
public $user;
public $voice_position;
public $wikipedia;
public $zip_code;

  /**
   * Getvars.
   *
   *  *  Bundle mollo_artist
   * -----------------------------------------
   *     - field_mollo_artist_groups
   *     - field_mollo_birthday
   *     - field_mollo_city
   *     - field_mollo_email
   *     - field_mollo_entry
   *     - field_mollo_event
   *     - field_mollo_facebook
   *     - field_mollo_first_name
   *     - field_mollo_function
   *     - field_mollo_hystoric
   *     - field_mollo_instrument
   *     - field_mollo_is_active
   *     - field_mollo_last_name
   *     - field_mollo_links
   *     - field_mollo_media
   *     - field_mollo_mobile
   *     - field_mollo_phone
   *     - field_mollo_position
   *     - field_mollo_resigning
   *     - field_mollo_speciality
   *     - field_mollo_street_and_number
   *     - field_mollo_title_image
   *     - field_mollo_token
   *     - field_mollo_user
   *     - field_mollo_voice_position
   *     - field_mollo_wikipedia
   *     - field_mollo_zip_code
   *
   *
   *
   * @param $artist_id
   *
   * @param $vocabularies
   *
   * @return array|string[]
   *   Return Artist Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars($artist_id, $vocabularies): array {

    $node = Node::load($artist_id);

    if (isset($node)) {

      // Get Field Values
      $first_name = Helper::getFieldValue($node, 'field_mollo_first_name');
      $last_name = Helper::getFieldValue($node, 'field_mollo_last_name');

      // Get only IDs
      $title_image = Helper::getFieldValue($node, 'field_mollo_title_image');

      // Get Taxonomy Content TODO: Preload Taxonomy Data
      $voice_position = Helper::getFieldValue($node, 'field_mollo_voice_position');
      $function = Helper::getFieldValue($node, 'field_mollo_function');
      $instrument = Helper::getFieldValue($node, 'field_mollo_instrument');
      $position = Helper::getFieldValue($node, 'field_mollo_position');
      $speciality = Helper::getFieldValue($node, 'field_mollo_speciality');

      // Build Variables Array
      return [
        'id' => $artist_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'function' => $function,
        'voice_position' => $voice_position,
        'instrument' => $instrument,
        'position' => $position,
        'speciality' => $speciality,
        'image' => $title_image,
      ];

    }


    return [];

  }

  /**
   * @param $event_id
   * @param $vocabularies
   */
  public static function getAllFromEvent($event_id, $vocabularies){
    // load all Nids from "mitwirkende" for this Operette
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('status', 1)
      ->condition('type', 'mitwirkende')
      ->condition('field_operettenauffuehrungen', $nid)
      ->condition('field_funktion', $funktion_terms[$funktion])
      //
      // Order by
      // ->sort('weight', 'ASC')
      //
      // Access
      ->accessCheck(FALSE);


    $nids = $query->execute();


    // if  Nids are found for this operette
    if (count($nids) !== 0) {

      // Load all Mitwirkende
      foreach ($nids as $_nid) {


        // Output Array
        $variables[$i] = [];

        $node = Drupal::entityTypeManager()
          ->getStorage('node')
          ->load($_nid);

        if ($node) {

}

}
