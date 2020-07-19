<?php

namespace Drupal\mollo_event\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the mollo_event module.
 */
class ArtistControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "mollo_event ArtistController's controller functionality",
      'description' => 'Test Unit for module mollo_event and controller ArtistController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests mollo_event functionality.
   */
  public function testArtistController() {
    // Check that the basic functions of module mollo_event.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
