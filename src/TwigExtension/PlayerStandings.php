<?php
namespace Drupal\player_standings\TwigExtension;

use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;

class PlayerStandings extends \Twig_Extension {

  /**
   * Gets a unique identifier for this Twig extension.
   */
  public function getName() {
    return 'player_standings';
  }

  /**
   * Generates a list of all Twig filters that this extension defines.
   */
  public function getFilters() {
    return [
      new \Twig_SimpleFilter('player_standings', array($this, 'playerstandings'), array('is_safe' => array('html')))
    ];
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('player_standings',
        array($this, 'playerstandings'),
        array('is_safe' => array('html')
      )));
  }

  /**
   * The php function to load a given block
   */
  public function playerstandings($game) {

    return  'test';


  }

}

