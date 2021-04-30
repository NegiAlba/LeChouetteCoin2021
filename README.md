# Le chouette coin

Le chouette coin est un site qui permet de vendre des objets de particuliers à particuliers. Par conséquent, il conviendra d'utiliser un système d'authentification afin de se connecter, et de faciliter la communication entre utilisateurs. Les objets seront rangés par catégories et pourront être consultés par tout le monde, à partir du moment où l'objet n'a pas déja été réservé. Seul l'utilisateur qui a créé l'annonce pourra verrouiller un objet.

## STRUCTURE DU PROJET

Structure de la base de données :

    - users : 
        - username (varchar, 255, unique)
        - email (varchar, 255, unique)
        - password (varchar, crypted, no-char-limit)
        - role (varchar, 255)
        - _city (varchar, 255)_
        - _phone (varchar, 20)_
    
    - products :
        - name (varchar, 255)
        - description (text)
        - price (int, 10)
        - created_at (datetime)
        - author (id of user)
        - category (id of category)
        - _status (id of status)_
    
    - categories :
        - name (varchar, 255, unique)
    
    - status :
        - name (varchar, 255, unique)

    ( maybe later, city table exported from villes_de_france_sql )

Structure du back-end :

    - Create :
        - users : inscription
        - products : création de products via interface accessible aux users
        - categories : création de categories via interface accessible aux admins
    
    - Read :
        - users : connexion, et liste users via interface accessible aux admins
        - products : liste products via interface accessible aux visiteurs
        - categories : reliées aux products, tri par categories via recherche

    - Update :
        - users : modification city & phone via interface accessible à l'user et l'admin
        - products : modification products via interface accessible à l'author et l'admin
        - categories : modification categories via interface accessible aux admins
    
    - Delete :
        - users : désinscription
        - products : suppression de products via interface accessible à l'author et l'admin
        - categories : suppression de categories via interface accessible aux admins