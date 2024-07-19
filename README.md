# API de Gestion des Magasins

Cette application est une API REST permettant de gérer une liste de magasins. Elle offre des fonctionnalités pour lister, filtrer, trier, ajouter, modifier et supprimer des magasins.
J'avais pour obligation de n'utiliser aucun framework tel que Symfony ou Laravel.

## Installation

1. **Configurer la base de données :**
    - Créez une base de données MySQL nommée `api-store` et exécutez le script SQL `db.sql` afin créer la table `stores` et insérer des données de test :
       
2. **Configurer l'environnement :**
    - Créez un fichier `.env` en copiant le fichier `.env.dist` à la racine du projet et ajoutez les informations de connexion à la base de données :
        ```plaintext
        DB_HOST=localhost
        DB_NAME=api-store
        DB_USER=votre_user
        DB_PASS=votre_mot_de_passe
        ```

3. **Démarrer le serveur :**
    - Si vous utilisez le serveur intégré de PHP, exécutez la commande suivante :
        ```sh
        php -S localhost:8000
        ```

## Utilisation

### Endpoints de l'API

https://documenter.getpostman.com/view/4737023/2sA3kUFMH3

#### 1. Récupérer tous les magasins

- **URL** : `/stores`
- **Méthode** : `GET`
- **Paramètres de requête optionnels** :
    - `name` (string) : Filtrer par nom
    - `city` (string) : Filtrer par ville
    - `sort` (string) : Champ à trier (`name`, `city`)
    - `order` (string) : Ordre de tri (`ASC` ou `DESC`)
- **Réponse** :
    ```json
    [
        {
            "id": 1,
            "name": "Magasin Alpha",
            "city": "Paris"
        },
        {
            "id": 2,
            "name": "Magasin Beta",
            "city": "Lyon"
        }
    ]
    ```

#### 2. Récupérer un magasin par ID

- **URL** : `/stores`
- **Méthode** : `GET`
- **Paramètres de requête** :
    - `id` (int) : ID du magasin
- **Réponse** :
    ```json
    {
        "id": 1,
        "name": "Magasin Alpha",
        "city": "Paris"
    }
    ```

#### 3. Créer un nouveau magasin

- **URL** : `/stores`
- **Méthode** : `POST`
- **En-têtes** :
    - `Content-Type: application/json`
- **Corps de la requête** :
    ```json
    {
        "name": "Nouveau Magasin",
        "city": "Nouvelle Ville"
    }
    ```
- **Réponse** :
    ```json
    {
        "message": "Store created successfully."
    }
    ```

#### 4. Mettre à jour un magasin

- **URL** : `/stores`
- **Méthode** : `PUT`
- **En-têtes** :
    - `Content-Type: application/json`
- **Corps de la requête** :
    ```json
    {
        "id": 1,
        "name": "Magasin Mis à Jour",
        "city": "Ville Mise à Jour"
    }
    ```
- **Réponses** :
    - **Succès** :
        ```json
        {
            "message": "Store updated successfully."
        }
        ```
    - **Magasin non trouvé** :
        ```json
        {
            "message": "Store not found."
        }
        ```
    - **Erreur** :
        ```json
        {
            "message": "Unable to update store."
        }
        ```

#### 5. Supprimer un magasin

- **URL** : `/stores`
- **Méthode** : `DELETE`
- **En-têtes** :
    - `Content-Type: application/json`
- **Corps de la requête** :
    ```json
    {
        "id": 1
    }
    ```
- **Réponses** :
    - **Succès** :
        ```json
        {
            "message": "Store deleted successfully."
        }
        ```
    - **Magasin non trouvé** :
        ```json
        {
            "message": "Store not found."
        }
        ```
    - **Erreur** :
        ```json
        {
            "message": "Unable to delete store."
        }
        ```

#### 6. Récupérer tous les magasins avec filtre par nom et tri par ville en ordre croissant

- **URL** : `/stores?name=Shop&sort=city&order=ASC`
- **Méthode** : `GET`
- **Réponse attendue** : Une liste de magasins dont le nom contient "Shop", triée par ville en ordre croissant.

#### 7. Récupérer tous les magasins avec filtre par ville et tri par nom en ordre décroissant

- **URL** : `/stores?city=Lyon&sort=name&order=DESC`
- **Méthode** : `GET`
- **Réponse attendue** : Une liste de magasins situés à Lyon, triée par nom en ordre décroissant.

## Tests avec Postman

Vous pouvez utiliser Postman pour tester les différentes fonctionnalités de l'API en suivant les exemples ci-dessus.

1. **Ouvrir Postman** et créer une nouvelle requête.
2. **Sélectionner la méthode HTTP appropriée**.
3. **Entrer l'URL** et ajouter les paramètres ou le corps de la requête selon les besoins.
4. **Envoyer la requête** et vérifier la réponse.

En suivant ces instructions, vous pouvez installer, configurer et tester efficacement votre API de gestion des magasins.
