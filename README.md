# Axproo Project

## Description
Axproo console est bien plus qu’une application SaaS : c’est le point de rencontre entre **efficacité, collaboration et innovation**.  
Conçue pour être intuitive, modulable et performante, Axproo console permet à notre équipe de travailler **ensemble de manière harmonieuse**, en suivant des standards modernes et des bonnes pratiques de développement.

Chaque ligne de code, chaque fonctionnalité et chaque API que nous construisons contribue à un objectif commun : **créer une solution robuste et scalable**, capable de répondre aux besoins réels des utilisateurs tout en offrant un environnement de travail stimulant pour les développeurs.  

**Slogan** : un cœur puissant et flexible pour nos données et API. 

Ensemble, chaque membre de l’équipe contribue à un projet qui valorise **la créativité, la rigueur et l’excellence technique**. 🌟

Ce README sert de guide pour l’équipe.

---

## Prérequis
- PHP >= 8.1 + extensions (mbstring, intl, mysql, xml, curl)
- Composer
- MariaDB
- Git
---

## Installation
1. Cloner le repo :
```bash
git clone https://github.com/<ORG>/axproo-sandbox.git
cd axproo-sandbox 
```

2. Installer les dépendances
```bash
composer install
```

3. Configurer .env :
```bash
database.default.hostname = localhost
database.default.database = axproo_db
database.default.username = axproo_user
database.default.password = motdepasse
database.default.DBDriver = MySQLi
```

4. Créer la DB et exécuter les migrations :
```bash
php spark migrate
```

5. Démarrer le serveur
```bash
php spark serve
- Accessible sur : http://localhost:8080
```

## Base de données
- DB locale : axproo_sandbox
- Migrations pour créer tables
- Seeds pour données de test :
```bash
php spark db:seed UsersSeeder
```

## API Endpoints
- GET /api/hello → test API
- Ajouter toutes les routes avec description et paramètres

## Workflow Git
- Branch par fonctionnalité (`feature/<nom>`)
- Pull Requests obligatoire
- Merges sur `main` après validation

---

## Contacts
- Responsable projet : Christian Djomou
