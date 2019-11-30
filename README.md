# combatEpic

## Bundles utilisés :

* VichUploaderBundle :  upload des images
* LiipImagineBundle : charger les images recadrer et les stocker en cache pour gagner en performance d'affichage.

## Pour charger les combattants 
`php bin/console doctrine:fixtures:load`

## Amélioration possible 
* mieux sécuriser le formulaire d'upload de fichier
* Améliorer l'interface graphique 
* remettre des PV automatiquement lorsque l'on "ressuscite" ( en mettant sa date de mort à *null*) un combattant 
