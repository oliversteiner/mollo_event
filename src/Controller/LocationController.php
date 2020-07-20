<?php

namespace Drupal\mollo_event\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\mollo_utils\Utility\Helper;

/**
 * Class LocationController.
 *
 *
 *  Bundle mollo_locations
 * -----------------------------------------
 */
class LocationController extends ControllerBase {

  // public  Vars for Twig Var Suggestion.
  // use in Template via:
  // {# @var location \Drupal\mollo_event\Controller\LocationController #}

  public $description;

  public $name;

  public $notes;

  public $place;

  public $street_and_number;

  public $city;

  public $zip_code;

  public $country;

  public $map;

  public $links;

  public $email;

  public $phone;

  public $mobile;

  public $facebook;

  public $title_image;

  public $media;


  /**
   * Getvars
   *
   *    Bundle mollo_locations
   * -----------------------------------------
   *
   *   General
   *    - field_mollo_description
   *    - field_mollo_name
   *    - field_mollo_notes
   *
   *   Address
   *    - field_mollo_place
   *    - field_mollo_street_and_number
   *    - field_mollo_city
   *    - field_mollo_zip_code
   *    - field_mollo_country
   *    - field_mollo_map
   *
   *   Contact
   *    - field_mollo_links
   *    - field_mollo_email
   *    - field_mollo_phone
   *    - field_mollo_mobile
   *    - field_mollo_facebook
   *
   *   Media
   *    - field_mollo_title_image ( Entity: Media )
   *    - field_mollo_media       ( Entity: Media )
   *
   *
   * @param $location_id
   *
   * @return array|string[]
   *   Return Location Twig Vars
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public static function getVars($location_id): array {
    $node = Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($location_id);

    if (isset($node)) {
      $description = Helper::getFieldValue($node, 'field_mollo_description');
      $name = Helper::getFieldValue($node, 'field_mollo_name');
      $notes = Helper::getFieldValue($node, 'field_mollo_notes');
      $place = Helper::getFieldValue($node, 'field_mollo_place');
      $street_and_number = Helper::getFieldValue($node, 'field_mollo_street_and_number');
      $city = Helper::getFieldValue($node, 'field_mollo_city');
      $zip_code = Helper::getFieldValue($node, 'field_mollo_zip_code');
      $country = Helper::getFieldValue($node, 'field_mollo_country');
      $map = Helper::getFieldValue($node, 'field_mollo_map');
      $links = Helper::getFieldValue($node, 'field_mollo_links');
      $email = Helper::getFieldValue($node, 'field_mollo_email');
      $phone = Helper::getFieldValue($node, 'field_mollo_phone');
      $mobile = Helper::getFieldValue($node, 'field_mollo_mobile');
      $facebook = Helper::getFieldValue($node, 'field_mollo_facebook');
      $title_image = Helper::getFieldValue($node, 'field_mollo_title_image');
      $media = Helper::getFieldValue($node, 'field_mollo_media');


      // Build Variables Array
      return [
        'id' => $location_id,
        'name' => $name,
        'description' => $description,
        'place' => $place,
        'street_and_number' => $street_and_number,
        'city' => $city,
        'zip_code' => $zip_code,
        'country' => $country,
        'map' => $map,
        'links' => $links,
        'email' => $email,
        'phone' => $phone,
        'mobile' => $mobile,
        'facebook' => $facebook,
        'title_image' => $title_image,
        'media' => $media,
        'notes' => $notes,
      ];
    }
    return [];
  }


}
