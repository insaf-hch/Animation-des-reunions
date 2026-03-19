# 🧠 SMARTMEETING

> **Projet** : Animation des Réunions de l'Administration  
> **Établissement** : ESTSB  
> **Thème** : Les Techniques d'Animation de Réunion

---

## 📌 Description

**SMARTMEETING** est une application web dédiée à l'amélioration de la conduite et de l'animation des réunions au sein des administrations publiques et organisationnelles. Elle accompagne les animateurs et participants tout au long du cycle de vie d'une réunion — de la préparation à l'évaluation — en s'appuyant sur les meilleures techniques d'animation collaborative.

Ce projet s'inscrit dans le cadre du module **Animation des Réunions de l'Administration** dispensé à l'**École Supérieure de Technologie de Sidi Bennour (ESTSB)**.

---

## 🎯 Objectifs du Projet

- Comprendre et appliquer les **techniques d'animation de réunion** (brainstorming, méthode des 6 chapeaux, world café, Phillips 66, etc.)
- Faciliter la **préparation structurée** des réunions (ordre du jour, objectifs, participants)
- Assurer un **suivi en temps réel** des échanges et des décisions
- Produire automatiquement des **comptes rendus** exploitables
- Évaluer la **qualité et l'efficacité** des réunions tenues

---

## ✨ Fonctionnalités Principales

| Fonctionnalité | Description |
|---|---|
| 📅 Planification | Création de réunions avec ordre du jour, durée, rôles |
| 👥 Gestion des participants | Invitation, confirmation de présence, attribution des rôles |
| 🎨 Techniques d'animation | Bibliothèque de méthodes interactives intégrées |
| ⏱️ Minuteur intelligent | Gestion du temps par point de l'ordre du jour |
| 📝 Prise de notes collaborative | Édition partagée en temps réel |
| ✅ Suivi des décisions | Actions, responsables, délais |
| 📊 Compte rendu automatique | Génération et export (PDF / Word) |
| 📈 Évaluation post-réunion | Formulaires de satisfaction et indicateurs de performance |

---

## 🗂️ Structure du Projet

```
SMARTMEETING/
│
├── 📁 frontend/              # Interface utilisateur (React / HTML-CSS-JS)
│   ├── components/
│   ├── pages/
│   └── assets/
│
├── 📁 backend/               # Logique serveur (Node.js / Django / PHP)
│   ├── routes/
│   ├── controllers/
│   └── models/
│
├── 📁 database/              # Schémas et scripts SQL / NoSQL
│   └── smartmeeting.sql
│
├── 📁 docs/                  # Documentation du projet
│   ├── cahier_des_charges.pdf
│   ├── diagrammes_UML/
│   └── rapport_final.pdf
│
├── 📁 tests/                 # Tests unitaires et fonctionnels
│
├── .env.example              # Variables d'environnement (modèle)
├── .gitignore
├── package.json
└── README.md
```

---

## 🧩 Techniques d'Animation Couvertes

L'application intègre un guide interactif et des outils dédiés aux techniques suivantes :

- **Brainstorming** — Génération libre d'idées en groupe
- **Méthode des 6 Chapeaux de Bono** — Analyse multidimensionnelle d'un problème
- **World Café** — Dialogue en petits groupes tournants
- **Phillips 66** — Sous-groupes de 6 personnes pendant 6 minutes
- **Tour de table** — Expression ordonnée des participants
- **Métaplan / Post-it numérique** — Collecte et organisation visuelle d'idées
- **Vote / Priorisation** — Dot voting et matrices de décision
- **RACI** — Clarification des rôles et responsabilités

---

## 🛠️ Technologies Utilisées

| Couche | Technologie |
|---|---|
| Frontend | HTML5 / CSS3 / JavaScript (ou React.js) |
| Backend | Node.js / Express (ou PHP / Django) |
| Base de données | MySQL / PostgreSQL / MongoDB |
| Authentification | JWT / Sessions |
| Export | PDF.js / docx |
| Temps réel | Socket.IO (optionnel) |
| Versioning | Git / GitHub |

---

## 🚀 Installation et Lancement

### Prérequis

- Node.js ≥ 16 (ou PHP ≥ 8 / Python ≥ 3.9 selon le stack choisi)
- npm ou yarn
- MySQL / PostgreSQL installé et configuré

### Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/ESTSB/smartmeeting.git
cd smartmeeting

# 2. Installer les dépendances
npm install

# 3. Configurer les variables d'environnement
cp .env.example .env
# Éditer le fichier .env avec vos paramètres (DB, port, etc.)

# 4. Initialiser la base de données
npm run db:migrate

# 5. Lancer l'application
npm run dev
```

L'application sera accessible à l'adresse : `http://localhost:3000`

---

## 👤 Rôles Utilisateurs

| Rôle | Accès |
|---|---|
| **Animateur** | Création, conduite, clôture de la réunion |
| **Participant** | Consultation, contribution, vote |
| **Secrétaire** | Prise de notes, rédaction du compte rendu |
| **Administrateur** | Gestion des utilisateurs et paramètres |

---

## 📚 Ressources & Références

- Mucchielli, R. — *La conduite des réunions*, ESF Éditeur
- De Bono, E. — *Six Thinking Hats*
- Obrecht, M. — *Le guide de l'animateur de réunion*
- Support de cours — Module **Animation des Réunions de l'Administration**, ESTSB

---

## 👨‍💻 Équipe du Projet

> Projet réalisé dans le cadre de la formation à l'**École Supérieure de Technologie de Sidi Bennour (ESTSB)**

| Nom | Rôle |
|---|---|
| **Mehdi Ghine** | Chef de projet |
| **Youssef Bsibiss** | Planificateur |
| **Insaf Hammouchi** | Développeuse Frontend |
| **Doha Maazouz** | Développeuse Backend |
| **Fatima Ezzahra Rebbouh** | Responsable Documentation |
| **Anass Bellagrid** | Testeur |

*Encadré par :* **[Nom de l'encadrant]** — Enseignant, ESTSB

---

## 📄 Licence

Ce projet est réalisé à des fins **pédagogiques** dans le cadre du cursus de l'ESTSB.  
Toute réutilisation doit mentionner la source.

---

<p align="center">
  🏫 <strong>ESTSB</strong> — École Supérieure de Technologie de Sidi Bennour <br/>
  📌 Projet : Animation des Réunions de l'Administration <br/>
  💡 Application : <strong>SMARTMEETING</strong>
</p>
