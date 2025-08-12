## À propos

#### Stack utilisé

* **Laravel/Blade**
* **Filament**
* **Livewire**
* **TailwindCSS**

#### Les points importants à noter

1. Authentification via Laravel Breeze
2. Réservation des propriétés (Maison, Appartement, etc.)
3. Design responsive avec TailwindCSS sur toutes les pages (Acceuil, Tableau de bord utilisateur/admin, etc.)
4. Créer, Modifier, Supprimer, et Afficher des réservations et des propriétés dans le tableau de bord Filament
5. Certains composants ont été créé avec Livewire (PropertyCard, ReservationModal)

#### Design

Pour la page principale j'ai pris un template suivant pour inspiration: 

[Page d'acceuil design template](https://www.canva.com/templates/EAFwdRNUPUk-real-estate-website-in-purple-and-light-purple-modern-photocentric-style/)


#### Tester le projet

> **À noter:** les commandes à exécuter que vous allez voir pour l'installation du projet sont basées sur Linux (Ubuntu) dans mon cas.

Je vais présumer que vous avez des technos nécessaires installées:

* **PHP**
* **Composer**
* **MySQL**
* **Node.js & NPM**
* **Git**

```
$ git clone https://github.com/MrNesli/Real-Estate-Web-App.git
```

```
$ cd Real-Estate-Web-App/
```

```
$ composer install
```

```
$ npm install
```

```
$ php artisan key:generate
```

```
$ cp .env.example .env
```

Ensuite, créez une nouvelle base de données MySQL et un utilisateur qui puisse y accéder. Remplissez les champs de base données dans le fichier .env

```
DB_DATABASE=<Votre base de données>
DB_USERNAME=<Utilisateur MySQL>
DB_PASSWORD=<Mot de passe de l'utilisateur>
```

Migrez et seedez la base de données:

```
$ php artisan migrate
```

```
$ php artisan db:seed
```

Et c'est tout. Normalement, le lien local de l'appli c'est: 

```
http://localhost:8000
```
