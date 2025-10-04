# Axproo Project

Bienvenue dans le backend du projet Axproo.
Ce dépôt contient l’API backend développée avec CodeIgniter 4, ainsi que la configuration pour l’intégration continue (CI) et le déploiement continu (CD) via GitHub Actions.

## Description
Axproo console est bien plus qu’une application SaaS : c’est le point de rencontre entre **efficacité, collaboration et innovation**.  
Conçue pour être intuitive, modulable et performante, Axproo console permet à notre équipe de travailler **ensemble de manière harmonieuse**, en suivant des standards modernes et des bonnes pratiques de développement.

Chaque ligne de code, chaque fonctionnalité et chaque API que nous construisons contribue à un objectif commun : **créer une solution robuste et scalable**, capable de répondre aux besoins réels des utilisateurs tout en offrant un environnement de travail stimulant pour les développeurs.  

**Slogan** : un cœur puissant et flexible pour nos données et API. 

Ensemble, chaque membre de l’équipe contribue à un projet qui valorise **la créativité, la rigueur et l’excellence technique**. 🌟

Ce README sert de guide pour l’équipe.

---

## Prérequis
Avant de contribuer au projet, chaque membre doit installer en local :
- PHP >= 8.1 + extensions (mbstring, intl, mysql, xml, curl)
- Composer
- MySQL/MariaDB
- Git
---

## Installation
1. Cloner le projet :
### HTTPS
```bash
git clone https://github.com/axproo/api-sandbox.git
cd axproo-sandbox 
```

### SSH
```bash
git git@github.com:axproo/api-sandbox.git
cd axproo-sandbox
```

2. Installer les dépendances PHP
```bash
composer install
```

3. Configurer .env :
```bash
cp env .env
```

```bash
database.default.hostname = localhost
database.default.database = nom-de-la-base-de-données
database.default.username = nom-utilisateur
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
- API disponible sur : http://localhost:8080
```

## Tests (CI)
Le projet utilise PHPUnit pour les tests unitaires.

Lancer les tests localement :
```bash
vendor\bin\phpunit
```
Sur GitHub, les tests sont exécutés automatiquement à chaque push ou pull request.

## Déploiement (CD)
Le déploiement est automatisé via GitHub Actions.
À chaque push sur main, le backend est déployé automatiquement sur notre hébergeur cPanel (ftp.axproo.fr).

## Secrets GitHub à configurer
Dans Settings > Secrets and variables > Actions :

- FTP_SERVER → ftp.axproo.fr
- FTP_USERNAME → utilisateur FTP cPanel
- FTP_PASSWORD → mot de passe FTP cPanel
- FTP_PORT → 21 (FTP) ou 22 (SFTP si activé)

## Workflow Git
Pour éviter les conflits :

1. Créer une branche par fonctionnalité
```bash
git checkout -b feature/nom-fonctionnalite
```

2. Commit clair et concis
```bash
git add feature/nom-fonctionnalite
git commit -m "feat(auth): ajout du login API"
```

3. Push de la branche
```bash
git push origin feature/nom-fonctionnalite
```

4. Ouvrir une Pull Request (PR) pour merge vers main.
```bash
git checkout library/cors
git add .
git commit -m "Ajout de la gestion filter (cors, auth...)"
git push origin library/cors
```
### Ouvrir la Pull Request
- Sur GitHub (ou GitLab) → ton repo.
- Cliquer sur la bannière : “Compare & Pull Request”.
- Vérifie que ta branche library/cors est bien la source (base: main ← compare: library/cors).

### Rédige ta PR
- Titre clair :
    Ajout de la gestion de filter ou library
- Description : explique ce qui a été ajouté, modifié, testé.

### Créer la PR
Clique sur Create Pull Request.

### Revue & Merge
- Tes reviewers (ou toi-même si tu bosses seul) valident.
- Quand tout est OK → clique sur Merge Pull Request puis Confirm merge.
- Enfin, supprime ta branche si elle n’est plus utile :
```bash
git branch -d library/cors
git push origin --delete library/cors
```

## Objectif de ce projet
Construire une API backend fiable et sécurisée pour l’écosystème Axproo, avec un workflow moderne :

- Développement collaboratif simplifié
- Tests automatisés (CI)
- Déploiement automatique (CD) sur serveur cPanel
- Documentation claire pour chaque membre
---

Ce projet est le cœur technique de la plateforme Axproo.
Chaque contribution compte pour bâtir une solution robuste et évolutive.

## Prochaines étapes :
- Intégrer la gestion des migrations DB automatiques dans le déploiement
- Ajouter des tests fonctionnels et d’intégration
- Relier le backend au frontend Vue 3

## Contacts
- Responsable projet : Christian Djomou