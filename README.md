<p align="center">
  <img width="587" height="203" alt="image" src="https://github.com/user-attachments/assets/7ceb2342-5771-45d0-8f7a-9f8f35b816a9" />
</p>

## Contexte :
Dans le cadre de notre formation nous devons réaliser un stage en entreprise en fin d'année afin de valider notre parcours. pour cela, il nous est nécessaire d'effectuer des recherches afin de trouver une offre correspondant à certains critères, tels que le secteur d’activité, la durée ou encore la localisation. Ces recherches reposent principalement sur la mise en service de nos réseaux personnels et professionels (LinkedIN, GitHub, famille, proches, amis) ainsi que sur la consultation d'offres en lignes publiées sur des plateformes spécialisées (Hellowork, Welcome to the Jungle, Indeed). Dans cette continuité, notre équipe incarne le rôle de prestataire Web4All chargé de concevoir un site web dédié à la recherche de stages pour notre client, le porteur du projet.

## Présentation du projet :
"CHERCHE STAGE" est un projet visant à concevoir un site web entièrement dédié à la recherche de stage. Notre plateforme, nommée "Job's Horizon", doit intégrer un ensemble de fonctionnalités demandées par notre client tout au long du développement. L’objectif finale est de proposer un outil complet, intuitif et accessible, offrant aux étudiants un espace de confort leurs permettant de gérer et de consulter des opportunités de stage. Les entreprises disposent également de leur propre espace leur permettant de publier ou de retirer leurs offres. Les pilotes peuvent, quant à eux, gérer les promotions composées de leurs étudiants, tous rattachés à un même établissement. Enfin, les administrateurs disposent de l’ensemble des droits afin de superviser et arbitrer l’intégralité du système. Pour assurer le bon fonctionnement de notre site web, une base de données est mise en place afin de stocker toutes les informations nécessaires, qu’elles soient confidentielles, professionnelles ou personnelles.

## Objectifs :
L'objectif principal du projet est de concevoir un site web permettant de gérer et de centraliser efficacement les offres de stage proposées aux étudiants, afin de faciliter leur recherche et leur permettre de décrocher un stage.

Pour atteindre cette finalité, plusieurs objectifs intermédiaires doivent être réalisés afin de structurer le développement et l’évolution de la plateforme Job's Horizon :

- Création et gestion d’une base de données permettant de stocker les informations sur les entreprises, les offres de stage et les utilisateurs.
- Centralisation et simplification de l’accès aux offres de stage afin de faciliter la recherche pour les étudiants.
- Gestion de différents profils utilisateurs avec des droits d’accès adaptés.
- Respect du cahier des charges ainsi que la prise en compte des éventuelles demandes ou évolutions du client.
- Mise en place d’un système de gestion et de suivi des candidatures.
- Développement d’une plateforme web complète, structurée et sécurisée permettant une utilisation simple et efficace.

## Effectif :
Notre groupe projet se compose de quatre personnes :
- Kaëlig CLENET, Product Owner, développeur
- Anthony MOIZANT, développeur
- Mohamed SALL, développeur
- Swan DAGNAS, Scrum Master, développeur

## Matrice des permissions :
La matrice des permissions est également un élément important dans la gestion du développement de notre site web, car elle permet de définir les actions que peuvent effectuer les différents utilisateurs durant leur navigation. Elle garantit ainsi un accès réservé et contrôlé, tout en s’assurant que chaque utilisateur possède uniquement les fonctionnalités dont il a besoin.

De ce fait, nous avons quatre profils distincts :
- Étudiant
- Pilote
- Entreprise
- Administrateur


## Étudiant :
L'étudiant peut par exemple :
- Rechercher et afficher des offres
- Modifier ertaines informations de son compte
- Évaluer les entreprises
- Gérer sa wish-list

## Pilote :
Au contraire, le pilote dispose également de permissions mais celles-ci peuvent être différentes :
- Rechercher et afficher un compte étudiant
- Supprimer un compte étudiant
- Afficher la liste des offres auxquelles les élèves du pilote ont postulé
- Créer un compte étudiant

## Entreprise :
L'entreprise, quant à elle, peut :
- Créer une entreprise
- Créer une offre de stage
- modofier une entreprise avec certaines limites
- Consulter les statisques des offres

## Administrateur :
L’administrateur dispose de pratiquement tous les droits, à l’exception de trois permissions spécifiques liées à l’entreprise. Cependant, puisqu'il peut changer de profil à sa guise afin de tester l’intégralité de l’environnement, il peut alors accéder à ces permissions indirectement, mais pas directement depuis son profil administrateur personnel.


Les permissions que nous venons de présenter sont exhaustiveset elles ne représentent pas l’ensemble de toutes celles qui sont possibles pour chaque profile.

C'est pourquoi le tableau suivant répertorie toutes les actions pouvant être réalisées par chacun des utilisateurs :

<img width="1705" height="732" alt="image" src="https://github.com/user-attachments/assets/b2a186f4-febd-4e3d-92a5-f92c0040a096" />

Les réponses « Oui mais à échelle réduite » permettent de nuancer certaines permissions qui peuvent ne pas être totalement libres. Elles indiquent qu’une action est possible, mais avec certaines limitations ou restrictions.

Par exemple, un étudiant peut modifier son compte, mais uniquement dans certaines limites. Il pourra par exemple modifier des informations comme son CV ou encore son mot de passe mais le changement du prénom ou du nom peut être restreint afin d’éviter des erreurs ou des modifications contraignantes.

Ce système de permissions nous permet de garder un certain contrôle sur les informations sensibles tout en laissant aux utilisateurs une certaine autonomie dans leur choix.

## Architecture :
Une bonne architecture est primordiale puisqu'elle permet d'organiser avec rigueur le projet tout en facilitant son développement, sa maintenance ainsi que son évolution future. Cela permet aussi de structurer le code de manière visuelle, claire et précise pour toute l'équipe projet tout en gardant une logique et un plan fixe.

De plus, cette organisation simplifie grandement la correction de problèmes ainsi que l'ajout d'éléments ou de nouvelles fonctionnalités supplémentaires, comme des fichiers ou bien des interactions utilisateurs.

Pour notre cas présent, l'architecture que nous avons établie a été choisie en fonction du travail réalisé en amont et le résultat est le suivant :

<img width="526" height="500" alt="image" src="https://github.com/user-attachments/assets/fab215a8-46e7-4d01-a87e-7cacdfd463fb" />


## Base de données :
Pour notre plateforme de recherche de stage, l'implémentation d'une base de données est obligatoire afin de stocker, organiser et gérer les informations nécessaires au bon fonctionnement de celle-ci.
Pour ce faire, nous utilisons une base de données en localhost grâce à "PhpMyAdmin", que nous avons déjà utilisé dans un prosit précédent. Cet outil nous permet de créer, gérer et administrer facilement notre base de données MySQL.
La génération de nos données sont réaliser principalement avec le site internet "MOCKAROO", qui permet de créer rapidement des données fictives pour nos différentes tables. Ces données sont ensuite importées dans notre base de données afin de simuler un environnement réel ainsi que de tester les fonctionnalités de la plateforme.

Lien vers MOCKAROO : https://mockaroo.com/

<img width="629" height="410" alt="image" src="https://github.com/user-attachments/assets/921b2648-bb6f-415a-8a2d-f185a1672b47" />

Pour connecter notre base de données locale à notre site web, nous utilisons PDO. Il s'agit d'une extension de PHP permettant d’établir une connexion sécurisée et flexible avec différentes bases de données, notamment MySQL.

De plus, cette méthode de connexion nécessite certains paramètres d’authentification. Pour des raisons de sécurité, ces informations ne doivent en aucun cas apparaître dans le dépôt GitHub du projet.
- Host
- BDDname
- User
- Password
- Port

Ces paramètres sont donc stockés dans un fichier ".env", qui contient une liste de ces paramètres d'hautentification. Lorsqu’une nouvelle connexion est créée, PDO récupère automatiquement ces informations depuis ce fichier afin d’établir la connexion à la base de données. De plus, avec le fichier ".gitignore" nous pouvons lors d'un commit restreindre certains fichiers qui ne doivent pas être envoyé comme ici le ".env" mais aussi lui même. Cette méthode permet ainsi de sécuriser l'ensemble des informations sensibles tout en facilitant la connexion à notre base de données.

Le fichier ".gitignore" qui restreint les accès :

<img width="230" height="270" alt="image" src="https://github.com/user-attachments/assets/b0f24644-6505-45c6-a10d-676642837a6e" />



## Schéma MCD :
Le Modèle Conceptuel de Données (MCD) est un diagramme qui représente de manière abstraite et structurée les entités, leurs attributs ainsi que les relations qui existent entre elles dans une base de données. Il permet de formaliser l’organisation des données, de limiter les redondances et de préparer la transition vers un modèle logique ou relationnel pouvant être implémenté dans un Système de Gestion de Base de Données (SGBD).

Le diagramme suivant va nous permettre ensuite de créer le Modèle Logique des Données (MLD) pour notre base de données :

<img width="4710" height="3459" alt="mermaid-diagram-2026-03-30-212922" src="https://github.com/user-attachments/assets/c2400219-63aa-4f50-a54f-9941dbca2b97" />


## Schéma MLD :
Le Modèle Logique des Données (MLD) constitue une étape intermédiaire dans le processus de modélisation des nos données. Il permet de transformer le Modèle Conceptuel des Données (MCD) en un schéma adapté à l’implémentation dans une base de données relationnelle. Ce schéma reprend les informations définies dans le MCD tout en y ajoutant des éléments techniques tels que les clés primaires, les clés étrangères et les relations entre les tables. Le MLD sert ainsi de base à la mise en œuvre physique de la base de données et facilite la compréhension de la structure des données ainsi que des liens entre les différentes entités.

Le schéma suivant est ce lui de notre futur base de données :

<img width="5646" height="4516" alt="mermaid-diagram-2026-03-30-201940" src="https://github.com/user-attachments/assets/6f0836cb-08f4-4aba-b5ca-5c4d1a4a55eb" />

## Assets :
Dans cette partie de l’architecture de notre programme, nous retrouvons :
- Le dossier "font" contenant le thème de police Zanlando_Sans_Expanded.
- Le dossier "images" regroupant les images brutes utilisées pour la page de référence.
- Le dossier "style" incluant tous les fichiers CSS, à la fois pour le style global ainsi que pour les autres pages.

## Controllers :


## Models :


## Templates :


## Javascript :
L'utiliastion de Javascript joue un rôle essentiel dans le développement de notre site web, puisqu'il permet d'ajouter de l'interraction et d'améliorer l'expérience utilisateur lors de sa navigation.

Dans la gestion de notre plateforme, ce langage est souvent utilisé afin de gérer efficacement la vérification des information saisies dans les formulaires avant leur envoi comme un fichier, l’adresse email, le mot de passe ou les champs obligatoires. Cela permet d'éviter les erreurs et améliore la fiabilité des données récupérées et ainsi transmise par la suite.

Il peut également être utilisé pour rendre le font-end plus dynamique avec la possibilité d'afficher ou de masquer des éléments sans même recharger la page.

Pour Job's Horizon nous avons principalement utilisé ce langage sur :
- Les formulaires de connexions ainsi que pour postuler à une offre
- La gestion de boutons permettant de naviguer plus facilement
- La gestion de la wish-list et des notifications
- Le système d'avis d'entreprise

## Vendor :



