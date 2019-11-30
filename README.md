# combatEpic

## Bundles utilisés :

* VichUploaderBundle :  upload des images
* LiipImagineBundle : charger les images recadrer et les stocker en cache pour gagner en performance d'affichage.

## Pour charger les combattants 
Créer une base de donnée et appliquer les migrations.
**Attention** il faut ajouter un fichier .env 

puis lancer cette commande
`php bin/console doctrine:fixtures:load`

## Amélioration possible 
* mieux sécuriser le formulaire d'upload de fichier
* Améliorer l'interface graphique 
* remettre des PV automatiquement lorsque l'on "ressuscite" ( en mettant sa date de mort à *null*) un combattant 

## Route API
 * [liste des combattants](http://127.0.0.1:8000/api/v1/warriors) `http://127.0.0.1:8000/api/v1/warriors`
 * [un combattant](http://127.0.0.1:8000/api/v1/warriors/1) `http://127.0.0.1:8000/api/v1/warriors/{id}`
 * [liste des combats](http://127.0.0.1:8000/api/v1/fights) `http://127.0.0.1:8000/api/v1/fights`
 * [un combat](http://127.0.0.1:8000/api/v1/fights/1) `http://127.0.0.1:8000/api/v1/fights/{id}`
