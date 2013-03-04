<?php
/**
 * Utilisations de pipelines par Ménu à la carte
 *
 * @plugin     Ménu à la carte
 * @copyright  2013
 * @author     Rainer Müller
 * @licence    GNU/GPL
 * @package    SPIP\Menu_a_carte\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;
	

/*
 * Un fichier de pipelines permet de regrouper
 * les fonctions de branchement de votre plugin
 * sur des pipelines existants.
 */



/**
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function menu_a_carte_affiche_milieu($flux) {
	$texte = "";
	$e = trouver_objet_exec($flux['args']['exec']);

	// objets_menus sur les rubriques
	if (!$e['edition'] AND in_array($e['type'], array('rubrique'))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'objets_menus',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}

	if ($texte) {
		if ($p=strpos($flux['data'],"<!--affiche_milieu-->"))
			$flux['data'] = substr_replace($flux['data'],$texte,$p,0);
		else
			$flux['data'] .= $texte;
	}
    
    if(!$e['edition'] AND in_array($e['type'], array('objets_menu'))){
       $contexte=$flux['data'];
       $id_objets_menu=$flux['args']['id_objets_menu'];
       $lang=sql_getfetsel('lang','spip_objets_menus','id_objets_menu='.$id_objets_menu);
       $liste= recuperer_fond('prive/objets/liste/objets_menus_selection',array('objet_dest'=>'objets_menu','id_objet_dest'=>$id_objets_menu,'langue'=>array($lang)));
       $flux['data'] .= $liste;
    }

	return $flux;
}


/**
 * Optimiser la base de données en supprimant les liens orphelins
 * de l'objet vers quelqu'un et de quelqu'un vers l'objet.
 *
 * @pipeline optimiser_base_disparus
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function menu_a_carte_optimiser_base_disparus($flux){
	include_spip('action/editer_liens');
	$flux['data'] += objet_optimiser_liens(array('objets_menu'=>'*'),'*');
	return $flux;
}

?>