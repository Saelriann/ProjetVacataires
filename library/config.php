<?php 
/**
 * Page de configuration contenant les variables globales
 * Inspirée d'un tutoriel sur le pattern MVC
 */

// Bases
$GLOBALS['ep_base_url'] = "http://localhost/M1/ProjetVacataires/"; // url de base du site
$GLOBALS['ep_dynamic_url'] = "http://localhost/M1/ProjetVacataires/"; // url dynamique du site
$GLOBALS['seourl'] = "false"; // Faux si l'on développe en local / Vrai si le serveur est compatible avec .htaccess.
$GLOBALS['ep_first_page'] = "login"; // Page par défaut sur laquelle l'utilisateur arrive lorqu'il lance le site  
$GLOBALS['website_name'] = "Gestion des vacataires"; // Nom du site 
$GLOBALS['authors'] = "Robin Heckenauer - Marie Anne Poty"; // Auteurs
$GLOBALS['majors'] = "Architecture N-Tiers - M1 IMR/MIAGE"; // Nom de la matière et de la filière 

// Base de données
$GLOBALS['ep_hostname'] = "localhost"; // Hôte de la BDD
$GLOBALS['ep_username'] = "root"; // Utilisateur de la BDD
$GLOBALS['ep_password'] = ""; // Mot de passe de la BDD
$GLOBALS['ep_database'] = "projet_vacataires"; // Nom de la BDD utilisée

// Configuration de l'email (dans le cas où nous allons utiliser un service de réinitialisation de mot de passe ...)
$GLOBALS['ep_smpt_server'] = ""; // Nom du serveur SMPT Ex: smtp.gmail.com pour Gmail
$GLOBALS['ep_smpt_port'] = ""; // Port
$GLOBALS['ep_smpt_username'] = ""; // Nom d'utilisateur
$GLOBALS['ep_smpt_password'] = ""; // Mot de passe
$GLOBALS['SMTPSecure'] = "tls"; // Protocole de sécurisation (Transport Layer Security)
$GLOBALS['Mailer'] = "smtp"; // Type

// Vues de bases
$GLOBALS['ep_header'] = "header.php"; // Vue du haut de page
$GLOBALS['ep_footer'] = "footer.php"; // Vue du bas de page

