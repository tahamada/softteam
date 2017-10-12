<?php
interface enregistrable
{
	public function lister($value);
	public function enregistrer($objet,$update);
	public function supprimer($objet);
}
?>