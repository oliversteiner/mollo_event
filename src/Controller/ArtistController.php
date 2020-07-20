<?php

namespace Drupal\mollo_event\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;

/**
 * Class ArtistController.
 *
 * Get all Information from Work and Names from Composers and Writers
 *
 *  Bundle mollo_work
 * -----------------------------------------
 */
class ArtistController extends ControllerBase
{
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

  public $historic;

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

  public $role_name;

  public $role_group;

  public $role_description;

  public $leadership;

  public $icon;

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
   *    - field_mollo_historic  ( boolean )
   *    - field_mollo_artist_groups
   *
   *   Images
   *     - field_mollo_title_image ( Entity: Media )
   *     - field_mollo_media ( Entity: Media )
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
   *
   * @return array|string[]
   *   Return Artist Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars($artist_id): array
  {
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
        true
      );
      $function = Helper::getFieldValue(
        $node,
        'field_mollo_function',
        'mollo_function',
        true
      );
      $instrument = Helper::getFieldValue(
        $node,
        'field_mollo_instrument',
        'mollo_instrument',
        true
      );
      $position = Helper::getFieldValue(
        $node,
        'field_mollo_position',
        'mollo_position',
        true
      );
      $speciality = Helper::getFieldValue(
        $node,
        'field_mollo_speciality',
        'mollo_speciality',
        true
      );
      $country = Helper::getFieldValue(
        $node,
        'field_mollo_country',
        'mollo_country',
        true
      );

      // Icon
      $icon = '';
      $value = $node->get('field_mollo_instrument')->getValue();
      if($value){
        $instrument_id = $value[0]['target_id'];
        $icon = Helper::getTermIconByID($instrument_id);
      }



      // Build Variables Array
      return [
        'id' => $artist_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'function' => $function,
        'voice_position' => $voice_position,
        'instrument' => $instrument,
        'icon' => $icon,
        'position' => $position,
        'speciality' => $speciality,
        'image' => $title_image,
        'country' => $country,
      ];
    }

    return [];
  }

  public $group_by; // Artists group by Taxonomy

  /**
   * getRoleVars.
   *
   *    Bundle mollo_role
   * -----------------------------------------
   *
   *   General
   *    - field_mollo_artist    ( Entity: mollo_artist )
   *    - field_mollo_event_1   ( Entity: mollo_event )
   *    - field_mollo_event     ( Do not use )
   *    - field_mollo_description ( text long, formatted)
   *    - field_mollo_name      ( text )
   *
   *
   *
   * @param $role_id
   *
   * @return array|string[]
   *   Return Artist Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getRoleVars($role_id): array
  {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($role_id);

    if (isset($node)) {
      // Get Field Values
      $name = Helper::getFieldValue($node, 'field_mollo_name');
      $artist_id = Helper::getFieldValue($node, 'field_mollo_artist');
      $description = Helper::getFieldValue($node, 'field_mollo_description');

      // Build Variables Array
      return [
        'id' => $role_id,
        'name' => $name,
        'description' => $description,
        'artist_id' => $artist_id
      ];
    }

    return [];
  }

  /**
   * getLeaderShipVars.
   *
   *    Bundle mollo_leadership
   * -----------------------------------------
   *
   *   General
   *    - field_mollo_artist    ( Entity: mollo_artist )
   *    - field_mollo_event_1   ( Entity: mollo_event )
   *    - field_mollo_position ( Term: mollo_position)
   *
   *
   *
   * @param $leader_id
   *
   * @return array|string[]
   *   Return Artist Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getLeaderShipVars($leader_id): array
  {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($leader_id);

    if (isset($node)) {
      // Get Field Values
      $position_id = Helper::getFieldValue($node, 'field_mollo_position');
      $artist_id = Helper::getFieldValue($node, 'field_mollo_artist');

      // Build Variables Array
      return [
        'id' => $leader_id,
        'position_id' => $position_id,
        'artist_id' => $artist_id
      ];
    }

    return [];
  }

  /**
   * @param $event_id
   * @param $vocabularies
   *
   * @param bool $musicians
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getArtistsFromEvent($event_id, $musicians = FALSE): array
  {
    $all_artists = [];
    if($musicians){
      $field_event = 'field_mollo_event_orchestra';
    }else{
      $field_event = 'field_mollo_event';

    }

    // load all Node IDs from "mollo_artist" with mollo_event ID
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_artist')
      ->condition($field_event, $event_id)
      // Access
      ->accessCheck(false);

    $artist_ids = $query->execute();

    // Nodes found
    if (count($artist_ids) !== 0) {
      // Load all Artists
      foreach ($artist_ids as $artist_id) {
        // Output Array
        $all_artists[] = self::getVars($artist_id);
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
    $artist_list = self::artistFilterFunction(
      $needle,
      $artists
    );

    foreach ($vocabularies[$vocabulary] as $term_id => $term_name) {
      $artists_filtered = self::artistFilterOrderByVoc(
        $term_name,
        $vocabulary,
        $needle,
        $artists
      );

      if (count($artists_filtered) > 0) {
        $terms[] = [
          'name' => $term_name,
          'artists' => $artists_filtered
        ];
      }
    }

    //  Group by Term
    $result['group_by'] = $terms;
    $result['artists'] = $artist_list;
    //  Artists

    return $result;
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
  public static function artistFilterOrderByVoc(
    $term_name,
    $vocabulary,
    $needle,
    $artists
  ): array {
    $results = [];
    $ids = [];
    foreach ($artists as $artist) {
      foreach ($artist['function'] as $function) {
        // Needle in Function (Choir, Orchestra, Leadership)
        if (in_array($needle, $artist['function'], true)) {
          // term in Voc ( Voice Position, Instruments
          if (in_array($term_name, $artist[$vocabulary], true)) {
            // Eliminate duplicates
            if (!in_array($artist['id'], $ids, true)) {
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
  public static function artistFilterFunction(
    $needle,
    $artists
  ): array {
    $results = [];
    $ids = [];
    foreach ($artists as $artist) {
      foreach ($artist['function'] as $function) {
        // Needle in Function (Choir, Orchestra, Leadership)
        if (in_array($needle, $artist['function'], true)) {
            // Eliminate duplicates
            if (!in_array($artist['id'], $ids, true)) {
              $ids[] = $artist['id'];
              // Add filterd Artist to Result
              $results[] = $artist;
          }
        }
      }
    }
    return $results;
  }


  public static function getSoloArtist(
    $event_id,
    array $artists,
    array $vocabularies
  ) {
    $solo_artists = [];
    $solo_artists_temp = [];
    $roles = [];

    // get all Roles for Event
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_role')
      ->condition('field_mollo_event_1', $event_id)
      // Access
      ->accessCheck(false);

    $role_ids = $query->execute();

    // Nodes found
    if (count($role_ids) !== 0) {
      // Load all Artists
      foreach ($role_ids as $role_id) {
        // Output Array
        $roles[] = self::getRoleVars($role_id);
      }
    }

    // Add Artist to Roles
    foreach ($roles as $role) {
      // Search in Artist
      foreach ($artists as $artist) {
        // Find Artist for Role
        if ($artist['id'] === $role['artist_id']) {
          // Add Role-Vars to Artist
          $artist['role_id'] = $role['id'];
          $artist['role_name'] = $role['name'];
          $artist['role_description'] = $role['description'];

          // Store Artist in Solo Artists
          // Group Artists by Roles ( like Soldaten, Zofen, Grissetten)
          $role_group = $role['name'];
          $solo_artists_temp[$role_group][] = $artist;
        }
      }
    }

    // Postprocessing
    // Add role_group 'solo' for Solo Artists
    $i = 0;
    foreach ($solo_artists_temp as $role_group) {
      $solo_artists[0]['name'] = 'solo';

      if (count($role_group) === 1) {
        $solo_artists[0]['artists'][] = $role_group[0];
      } else {
        foreach ($role_group as $artist) {
          $solo_artists[$i]['name'] = $artist['role_name'];
          $solo_artists[$i]['artists'][] = $artist;
        }
      }
      $i++;
    }

    return $solo_artists;
  }

  public static function getLeaderShip(
    int $event_id,
    array $artists,
    array $vocabularies
  ) {
    $leadership = [];
    $solo_artists_temp = [];
    $leaders = [];

    // get all Roles for Event
    $query = Drupal::entityQuery('node')
      //
      // Condition
      ->condition('type', 'mollo_event_leadership')
      ->condition('field_mollo_event_1', $event_id)
      // Access
      ->accessCheck(false);

    $leader_ids = $query->execute();

    // Nodes found
    if (count($leader_ids) !== 0) {
      // Load all Artists
      foreach ($leader_ids as $leader_id) {
        // Output Array
        $leaders[] = self::getLeaderShipVars($leader_id);
      }
    }

    // Add Artist to Roles
    foreach ($leaders as $leader) {
      // Search in Artist
      foreach ($artists as $artist) {
        // Find Artist for Role
        if ($artist['id'] === $leader['artist_id']) {
          // Get Name from Position Term
          if (isset($leader['position_id'])) {
            $artist['position'] =
              $vocabularies['position'][$leader['position_id']];
          }

          // Add Role-Vars to Artist
          $artist['artist_id'] = $leader['id'];

          // Store Artist in Solo Artists
          // Group Artists by Roles ( like Soldaten, Zofen, Grissetten)
          $leadership[] = $artist;
        }
      }
    }

    return $leadership;
  }
}
