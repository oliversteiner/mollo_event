<?php

namespace Drupal\mollo_event\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the mollo_event module.
 */
class PreloadControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "mollo_event PreloadController's controller functionality",
      'description' => 'Test Unit for module mollo_event and controller PreloadController.',
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
  public function testPreloadController() {
    // Check that the basic functions of module mollo_event.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
