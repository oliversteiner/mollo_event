<?php

namespace Drupal\mollo_event\Controller;

use Drupal;
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
   *    Bundle mollo_artist
   * -----------------------------------------
   *
   *   General
   *    - field_mollo_first_name
   *    - field_mollo_last_name
   *    - field_mollo_event ( Entity: mollo_event )
   *    - field_mollo_is_active ( boolean )
   *    - field_mollo_entry
   *    - field_mollo_resigning
   *    - field_mollo_hystoric  ( boolean ) TODO: Rename Field to historic
   *    - field_mollo_artist_groups
   *
   *   Images
   *     - field_mollo_title_image (Entity: Media)
   *     - field_mollo_media (Entity: Media)
   *
   *   Classification
   *     - field_mollo_function ( Term: mollo_function )
   *     - field_mollo_voice_position ( Term: mollo_voice_position )
   *     - field_mollo_instrument ( Term: mollo_instrument )
   *     - field_mollo_position ( Term: mollo_position )
   *     - field_mollo_speciality ( Term: mollo_speciality )
   *
   *   Contact
   *     - field_mollo_email
   *     - field_mollo_links
   *     - field_mollo_facebook
   *     - field_mollo_mobile
   *     - field_mollo_phone
   *     - field_mollo_wikipedia
   *
   *   Personal
   *     - field_mollo_birthday
   *
   *   Address
   *     - field_mollo_street_and_number
   *     - field_mollo_city
   *     - field_mollo_zip_code
   *     - field_mollo_country ( Term: mollo_country )
   *
   *   Helper
   *     - field_mollo_token
   *     - field_mollo_user ( Entity: Drupal user ID )
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
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($artist_id);

    if (isset($node)) {
      // Get Field Values
      $first_name = Helper::getFieldValue($node, 'field_mollo_first_name');
      $last_name = Helper::getFieldValue($node, 'field_mollo_last_name');

      // Get only IDs
      $title_image = Helper::getFieldValue($node, 'field_mollo_title_image');

      // Get Taxonomy Content
      $voice_position = Helper::getFieldValue(
        $node,
        'field_mollo_voice_position',
        'mollo_voice_position',
        TRUE
      );
      $function = Helper::getFieldValue(
        $node,
        'field_mollo_function',
        'mollo_function',
        TRUE
      );
      $instrument = Helper::getFieldValue(
        $node,
        'field_mollo_instrument',
        'mollo_instrument',
        TRUE
      );
      $position = Helper::getFieldValue(
        $node,
        'field_mollo_position',
        'mollo_position',
        TRUE
      );
      $speciality = Helper::getFieldValue(
        $node,
        'field_mollo_speciality',
        'mollo_speciality',
        TRUE
      );
      $country = Helper::getFieldValue(
        $node,
        'field_mollo_country',
        'mollo_country',
        TRUE
      );

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
        'country' => $country,
      ];
    }

    return [];
  }

  /**
   * @param $event_id
   * @param $vocabularies
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getArtistsFromEvent($event_id, $vocabularies): array {
    $all_artists = [];

    // load all Node IDs from "mollo_artist" with mollo_event ID
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_artist')
      ->condition('field_mollo_event', $event_id)
      // Access
      ->accessCheck(FALSE);

    $artist_ids = $query->execute();

    // Nodes found
    if (count($artist_ids) !== 0) {
      // Load all Artists
      foreach ($artist_ids as $artist_id) {
        // Output Array
        $all_artists[] = self::getVars($artist_id, $vocabularies);
      }
    }

    return $all_artists;
  }




  /**
   *
   *
   * @param array $artists
   * @param $vocabularies
   *
   * @param $function
   *
   * @return array
   */
  public static function getFilteredArtist(
    array $artists,
    $vocabularies,
    $function
  ): array {
    // {# @var artist \Drupal\mollo_event\Controller\ArtistController #}

    switch ($function) {
      case 'musician':
        $needle = 'Orchester';
        $vocabulary = 'instrument';
        break;
      default:
        // default is singers
        $needle = 'Chor';
        $vocabulary = 'voice_position';
        break;
    }

    // Build Twig Array from Vocabularies
    $terms = [];
    foreach ($vocabularies[$vocabulary] as $term_id => $term_name) {
      $artists_filtered = artistFilter(
        $term_name,
        $vocabulary,
        $needle,
        $artists
      );

      if (count($artists_filtered) > 0) {
        $terms[] = [
          'name' => $term_name,
          'artists' => $artists_filtered,
        ];
      }
    }

    return $terms;
  }

}

/**
 *
 *
 * @param $term_name
 * @param $vocabulary
 * @param $needle
 * @param $artists
 *
 * @return array
 */
function artistFilter($term_name, $vocabulary, $needle, $artists) {
  $results = [];
  $ids = [];
  foreach ($artists as $artist) {
    foreach ($artist['function'] as $function) {

      // Needle in Function (Choir, Orchestra, Leadership)
      if (in_array($needle, $artist['function'], TRUE)) {

        // term in Voc ( Voice Position, Instruments
        if (in_array($term_name, $artist[$vocabulary], TRUE)) {

          // Eliminate duplicates
          if (!in_array($artist['id'], $ids, TRUE)) {
            $ids[] = $artist['id'];

            // Add filterd Artist to Result
            $results[] = $artist;
          }
        }
      }
    }
  }
  return $results;
}
