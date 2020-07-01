# crowdfunding

## Questions

> Qu'est-ce qu'un DTO et à quoi sert-il ?
- Un DTO (Data Transfer Object) représente de la donnée qu'on peut recevoir ou envoyer sous forme de classe. Dans une API avec un endpoint /favoris qui retourne un favori (nom, adresse) on peut le voir comme une classe FavoriDTO avec les attributs nom et adresse. Ainsi on a un développement plus strict et qui évoluera mieux sur le temps.

> Quelle est la différence entre un listener et un subscriber dans Symfony ?
- Les deux ont le meme objectif : être à l'écoute d'events, cependant le listener est configuré dans un fichier (config en général) et ne peut pas être modifié au runtime alors que le subscriber est dans une classe qui peut avoir des conditions ce qui le rend plus souple.

> Qu'est-ce qu'un JWT ? Pourquoi l'utilise-t-on plutôt que les sessions PHP ?
- un JWT (JSON Web Token) est un token au format json utilisable pour appeler des routes sur une API. Il contient des informations sur l'utilisateur, à l'inverse d'une session stockée sur l'ordinateur le token peut être utilisé sans connaitre sa source.

> Qu'est-ce que CORS ?
- le CORS (Cross-Origin Ressource Sharing) est un mécanisme utilisé lors d'un appel pour chargé pour du css, js ou autre type de donnée depuis un autre domaine, elle se trouve dans l'entête de la requête et permet depuis un site de charger des ressources depuis des CDN comme jquery par exemple.

> Quelle est la différence entre JSON et JSON-LD ?
- le JSON-LD est un format de donnée proche du json qui utilise en plus un context et un type afin de créer une sémantique proche des données