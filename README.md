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
### Procédure Git pour mettre à jour `main` et créer une PR

Cette procédure garantit que votre branche locale est synchronisée avec le remote avant de créer une Pull Request (PR).

#### 1. Se placer sur la branche `main`
```bash
git checkout main
```

#### 2. Mettre à jour main depuis le remote avec rebase
```bash
git pull --rebase origin main
```
- Si des conflits apparaissent :
    ##### 1. Résoudre les conflits dans l’éditeur.
    ##### 2. Ajouter les fichiers résolus :

```bash
git add <fichier_conflit>
```

    ##### 3. Continuer le rebase :
```bash
git rebase --continue
```
    ##### 4. Pour annuler le rebase si nécessaire :
```bash
git rebase --abort
```

#### 3. Vérifier l’état du dépôt
```bash
git status
git log --oneline --graph --all
```

#### 4. Pousser les modifications locales sur le remote
```bash
git push origin main
```

#### Créer la Pull Request (PR)
1. Pousser votre branche de fonctionnalité si ce n’est pas déjà fait :
```bash
git push origin feature/ma-branche
```

2. Sur GitHub (ou GitLab) : créer une PR de feature/ma-branche → main.

### Astuce
Pour ne plus avoir à préciser --rebase à chaque git pull :
```bash
git config --global pull.rebase true
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