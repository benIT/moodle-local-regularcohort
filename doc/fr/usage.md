# Utilisation

## Cohortes

Créer 2 cohortes:
- une cohorte pour les utilisateurs réguliers. Relevez l'identifiant de la cohorte. Par exemple :   `regular-user-cohort`.
- une cohorte pour les utilisateurs exceptionnels. Par exemple: `exceptional-user-cohort`.


## Paramétrer le plugin

Il faut maintenant renseigner dans le plugin les identifiants des 2 cohortes : `Administration du site / ► Plugins / ► Plugins locaux / ► Gestion des utilisateurs réguliers et exceptionels`

![settings-cohorts](img/settings-cohorts.png)

## Comment restreindre l'accès à un cours sensible aux utilisateurs réguliers ?

Dans le cours en question, restreindre l'auto-inscription aux membres de la cohortes des utilisateurs réguliers et enregistrer.
Ainsi seuls, les membres de la cohorte des utilisateurs réguliers pourront s'auto-inscrire.

![regular-user-cohort-only](img/regular-user-cohort-only.png)

## Comment fonctionne la synchronisation des cohortes ?

### Principe

- Tout utilisateur qui est membre de la cohorte exceptionelle sera enlevé de la cohorte régulière lors de la synchronisation
- Les utilisateurs vont par défaut dans la cohorte régulière

### Déclenchement

- La synchronisation initiale peut être lancée via le bouton de synchronisation. 
- La synchronisation des cohortes est déclenchée à chaque connexion et mise à jour de profil.

![sync-users](img/sync-users.png)