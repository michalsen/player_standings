<?php

/**
 *  CPHL Standings
 *
 */

use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;

\Drupal::logger('player_standings')->notice(t('Player Standings Computed'));

  $games = db_select('node__field_compute', 'n')
    ->fields('n', array('entity_id'))
    ->condition('field_compute_value' , 1, '=')
    ->execute()->fetchAll();

    $stats = [];

    // Create master arrays
    $gameStandings = [];

    // Loop and load each game
    foreach ($games as $key => $value) {
      $compare = [];
      $gameStandings[] = $key;
      $finishedGames[] = $value->entity_id;
      $stats[][$value->entity_id] = playerStats2($value->entity_id);
    }


  $playerData = [];
  foreach ($stats as $arrayKey => $arrayValue) {
    foreach ($arrayValue as $pkey => $pvalue) {
      if (isset($pvalue)) {
        if (in_array($pkey, $finishedGames)) {

      foreach ($pvalue as $game => $gv) {

          if (count($gv) > 0) {
            if (!isset($playerData[$gv['nid']])) {
              $playerData[$gv['nid']]['played'][]       = 'played';
              $playerData[$gv['nid']]['goals']          = $gv['field_pdh_goals'];
              $playerData[$gv['nid']]['assists']        = $gv['field_pdh_assists'];
              $playerData[$gv['nid']]['pim']            = $gv['field_pdh_pim'];
              $playerData[$gv['nid']]['sog']            = $gv['field_pdh_sog'];
              $playerData[$gv['nid']]['saves']          = $gv['field_pdh_saves'];
              $playerData[$gv['nid']]['ga']             = $gv['field_pdh_ga'];
              $playerData[$gv['nid']]['minutes_played'] = $gv['field_pdh_minutes_played'];
              $playerData[$gv['nid']]['points']         = $gv['field_pdh_points'];
              $playerData[$gv['nid']]['finished']       = $gv['field_pdh_finished'];

                if ($gv['field_pdh_game_won'] == 0 ||
                    $gv['field_pdh_game_won'] == 1) {
                  $playerData[$gv['nid']]['won']   = $gv['field_pdh_game_won'];
                  $playerData[$gv['nid']]['lost']  = $gv['field_pdh_game_lost'];
                }
            }
             else {
              $playerData[$gv['nid']]['played'][]       = 'played';
              $playerData[$gv['nid']]['goals']          = $playerData[$gv['nid']]['goals'] + $gv['field_pdh_goals'];
              $playerData[$gv['nid']]['assists']        = $playerData[$gv['nid']]['assists'] + $gv['field_pdh_assists'];
              $playerData[$gv['nid']]['pim']            = $playerData[$gv['nid']]['pim'] + $gv['field_pdh_pim'];
              $playerData[$gv['nid']]['sog']            = $playerData[$gv['nid']]['sog'] + $gv['field_pdh_sog'];
              $playerData[$gv['nid']]['saves']          = $playerData[$gv['nid']]['saves'] + $gv['field_pdh_saves'];
              $playerData[$gv['nid']]['ga']             = $playerData[$gv['nid']]['ga'] + $gv['field_pdh_ga'];
              $playerData[$gv['nid']]['minutes_played'] = $playerData[$gv['nid']]['minutes_played'] + $gv['field_pdh_minutes_played'];
              $playerData[$gv['nid']]['points']         = $playerData[$gv['nid']]['points'] + $gv['field_pdh_points'];
              $playerData[$gv['nid']]['finished']       = $playerData[$gv['nid']]['finished'] + $gv['field_pdh_finished'];
              if ($gv['field_pdh_game_won'] == 0 ||
                  $gv['field_pdh_game_won'] == 1) {
                $playerData[$gv['nid']]['won']          = $playerData[$gv['nid']]['won'] + $gv['field_pdh_game_won'];
                $playerData[$gv['nid']]['lost']         = $playerData[$gv['nid']]['lost'] + $gv['field_pdh_game_lost'];
              }
            }
             $playerData[$gv['nid']]['games_played']++;
          }
        }
      }
      }
    }
  }
