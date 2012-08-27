<?php

/**
 * @file
 * Definition of Drupal\views\Tests\Language\ArgumentLanguage.
 */

namespace Drupal\views\Tests\Language;

use Drupal\Core\Language\Language;

/**
 * Tests the argument language handler.
 *
 * @see Views\language\Plugin\views\argument\Language.php
 */
class ArgumentLanguage extends LanguageTestBase {

  public static function getInfo() {
    return array(
      'name' => 'Argument: Language',
      'description' => 'Tests the argument language handler.',
      'group' => 'Views Handlers'
    );
  }

  public function testFilter() {
    foreach (array('en' => 'John', 'xx-lolspeak' => 'George') as $langcode => $name) {
      $view = $this->getBasicView();
      $view->display['default']->handler->override_option('arguments', array(
        'langcode' => array(
          'id' => 'langcode',
          'table' => 'views_test',
          'field' => 'langcode',
        ),
      ));
      $this->executeView($view, array($langcode));

      $expected = array(array(
        'name' => $name,
      ));
      $this->assertIdenticalResultset($view, $expected, array('views_test_name' => 'name'));
      $view->destroy();
    }
  }

}
