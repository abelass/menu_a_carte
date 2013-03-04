<?php
/**
 * Préchargement des formulaires d'édition de objets_menu
 *
 * @plugin     Ménu à la carte
 * @copyright  2013
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Menu_a_carte\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/precharger_objet');

/**
 * Retourne les valeurs à charger pour un formulaire d'édition d'un objets_menu
 *
 * Lors d'une création, certains champs peuvent être préremplis
 * (c'est le cas des traductions) 
 *
 * @param string|int $id_objets_menu
 *     Identifiant de objets_menu, ou "new" pour une création
 * @param int $id_rubrique
 *     Identifiant éventuel de la rubrique parente
 * @param int $lier_trad
 *     Identifiant éventuel de la traduction de référence
 * @return array
 *     Couples clés / valeurs des champs du formulaire à charger.
**/
function inc_precharger_objets_menu_dist($id_objets_menu, $id_rubrique=0, $lier_trad=0) {
	return precharger_objet('objets_menu', $id_objets_menu, $id_rubrique, $lier_trad, 'titre');
}

/**
 * Récupère les valeurs d'une traduction de référence pour la création
 * d'un objets_menu (préremplissage du formulaire). 
 *
 * @note
 *     Fonction facultative si pas de changement dans les traitements
 * 
 * @param string|int $id_objets_menu
 *     Identifiant de objets_menu, ou "new" pour une création
 * @param int $id_rubrique
 *     Identifiant éventuel de la rubrique parente
 * @param int $lier_trad
 *     Identifiant éventuel de la traduction de référence
 * @return array
 *     Couples clés / valeurs des champs du formulaire à charger
**/
function inc_precharger_traduction_objets_menu_dist($id_objets_menu, $id_rubrique=0, $lier_trad=0) {
	return precharger_traduction_objet('objets_menu', $id_objets_menu, $id_rubrique, $lier_trad, 'titre');
}


?>