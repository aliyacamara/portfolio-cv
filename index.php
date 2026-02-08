<?php
// Traitement du formulaire de contact - VERSION CORRIGÉE
$message_envoye = "";
$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs ne sont pas vides
    if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['message'])){
        
        // Sécurisation et validation
        $nom = htmlspecialchars(trim($_POST['nom']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars(trim($_POST['message']));
        
        // Valider l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur = "Adresse email invalide.";
        } else {
            // Configuration de l'envoi
            $to = "camaraliya07@gmail.com";
            $subject = "✉️ Nouveau message de $nom (Portfolio)";
            
            // CORPS DU MESSAGE en HTML pour meilleur rendu
            $body = "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
            </head>
            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px; background: #f4f4f4; border-radius: 10px;'>
                    <h2 style='color: #00d4ff; border-bottom: 3px solid #00d4ff; padding-bottom: 10px;'>
                        📧 Nouveau message depuis votre portfolio
                    </h2>
                    
                    <div style='background: white; padding: 20px; border-radius: 5px; margin: 20px 0;'>
                        <p><strong>👤 Nom :</strong> $nom</p>
                        <p><strong>📧 Email :</strong> <a href='mailto:$email'>$email</a></p>
                        <hr style='border: 1px solid #eee;'>
                        <p><strong>💬 Message :</strong></p>
                        <p style='background: #f9f9f9; padding: 15px; border-left: 4px solid #00d4ff;'>
                            $message
                        </p>
                    </div>
                    
                    <p style='font-size: 12px; color: #999; text-align: center;'>
                        Ce message a été envoyé depuis alicam.alwaysdata.net
                    </p>
                </div>
            </body>
            </html>
            ";

            // EN-TÊTES CORRIGÉS pour Gmail
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            // IMPORTANT : Utiliser l'adresse AlwaysData comme expéditeur
            $headers .= "From: Portfolio Aliya <no-reply@alicam.alwaysdata.net>\r\n";
            
            // Reply-To pour que vous puissiez répondre directement
            $headers .= "Reply-To: $nom <$email>\r\n";
            
            // Headers anti-spam
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $headers .= "X-Priority: 3\r\n";

            // Envoi avec gestion d'erreur
            if(mail($to, $subject, $body, $headers)){
                $message_envoye = "✅ Message envoyé avec succès ! Je vous répondrai rapidement.";
            } else {
                $erreur = "❌ Erreur : L'envoi a échoué. Contactez-moi directement à camaraliya07@gmail.com";
            }
        }
    } else {
        $erreur = "⚠️ Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aliya Camara CV</title>

  <link rel="icon" href="assets/icones/iconeCV.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>
    <!-- navbar -->
    <?php include 'menuNav.php'; ?>
    <nav id="navbar" class="navbar">
    <ul>
    <?php foreach ($menu as $id => $titre): ?>
      <li>
        <a class="nav-link scrollto" href="#<?php echo $id; ?>">
          <?php echo $titre; ?>
        </a>
      </li>
    <?php endforeach; ?>
    </ul>
    </nav>
  
    <!-- ============================================
         HERO
         ============================================ -->
    <section id="hero">
  <div class="hero-content">
    <!-- BANNIERE CANVA : place ton image banner en assets/img/banniereHeroBleu.png -->
    <div class="hero-banner" role="img" aria-label="Bannière Aliya Camara"></div>

    <a href="assets/CV_ALIYA.pdf" download class="btn btn-download">
      Télécharger mon CV ↓
    </a>
  </div>
</section>
    <!-- ============================================
         À PROPOS
         ============================================ -->
    <section id="about">
        <div class="container">
            <h2>À propos</h2>
            <p class="about-text">
                Étudiante passionnée par le développement web et les dispositifs interactifs, 
                je suis actuellement en 2e année de BUT MMI. Mon objectif est de créer des 
                expériences numériques modernes et accessibles, alliant design et performance 
                technique.
                Je suis à la recherche d'un stage d'au minimum 10 semaines, à partir du 13 avril 2026,
                pour mettre en pratique mes compétences et contribuer à des projets innovants.
            </p>
        </div>
    </section>

    <!-- ============================================
         FORMATIONS
         ============================================ -->
    <section id="formations">
        <div class="container">
            <h2>Formations</h2>
            
            <div class="formations-grid">
                
                <!-- Bloc 1 : BUT MMI -->
                <div class="formation-card fade-in">
                    <div class="formation-annee">2024 - 2027</div>
                    <h3>BUT Métiers du Multimédia et de l'Internet</h3>
                    <p class="formation-lieu">IUT de Cergy-Pontoise - site de Sarcelles</p>
                    <p class="formation-specialite">Spécialité : Développement web et dispositifs interactifs</p>
                    <ul class="formation-details">
                        <li>Programmation et intégration/développement web.</li>
                        <li>Graphisme et UX/UI design.</li>
                        <li>Marketing.</li>
                        <li>Stratégie et communication numérique..</li>
                        <li>Audiovisuel, motion et sound design..</li>
                        <li>Gestion de projet numérique.</li>
                    </ul>
                </div>

                <!-- Bloc 2 : Lycée -->
                <div class="formation-card fade-in">
                    <div class="formation-year">2021 - 2024</div>
                    <h3>Baccalauréat Général</h3>
                    <p class="formation-place">Lycée Marie Curie, Nogent-sur-Oise</p>
                    <p class="formation-speciality">Spécialités :</p>
                    <ul class="formation-details">
                        <li>Mathématiques</li>
                        <li>Humanités, Littérature et Philosophie</li>
                        <li>Sciences de la vie et de la Terre</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================
         EXPÉRIENCES
         ============================================ -->
    <section id="experiences">
    <div class="container">
        <h2>Expériences</h2>

        <div class="timeline">

        <div class="timeline-item fade-in">
                <div class="timeline-date">Octobre 2025 - Janvier 2026</div>
                <h3>Opératrice d'attraction</h3>
                <p class="timeline-company">Parc Astérix</p>
                <ul>
                    <li>Assurer l'accueil.</li>
                    <li>Gestion de la file d'attente.</li>
                    <li>Pilotage du manège.</li>
                    <li>Contrôles de sécurité.</li>
                </ul>
            </div>

             <div class="timeline-item fade-in">
                <div class="timeline-date">Juillet - Août 2025</div>
                <h3>Assistante déménagement</h3>
                <p class="timeline-company">ITGA PARIS</p>
                <ul>
                    <li>Assurer la logistique du déménagement.</li>
                    <li>Préparer et étiqueter les cartons.</li>
                    <li>Réaliser l’inventaire du matériel.</li>
                    <li>Aider à l’aménagement des locaux.</li>
                </ul>
            </div>

            <div class="timeline-item fade-in">
                <div class="timeline-date">2023 - 2025</div>
                <h3>Technicienne en rehaussement de cils</h3>
                <p class="timeline-company">Freelance</p>
                <ul>
                    <li>Formation et lancement pour des prestations de rehaussement de cils.</li>
                    <li>Gérer des rendez-vous et l’accueil.</li>
                    <li>Appliquer des soins techniques précis.</li>
                    <li>Respecter des protocoles d’hygiène.</li>
                </ul>
            </div>

            <div class="timeline-item fade-in">
                <div class="timeline-date">2022</div>
                <h3>Bénévolat</h3>
                <p class="timeline-company">ONG Ummah Charity</p>
                <ul>
                    <li>Préparer des colis alimentaires.</li>
                    <li>Emballer, étiqueter et mettre en cartons des fournitures scolaires.</li>
                    <li>Organiser et ranger le stock.</li>
                    <li>Encadrer des enfants lors d’événements caritatifs.</li>
                    <li>Animer un gala caritatif.</li>
                </ul>
            </div>

        </div>
    </div>
</section>

    <!-- ============================================
         Projets
         ============================================ -->

<section id="projets">
        <div class="container">
            <h2>Projets</h2>
            
            <div class="projets-container">
                
                <div class="projet-card fade-in">
                    <div class="projet-header">
                        <h3>Site Vitrine BUT MMI</h3>
                        <span class="projet-tag">SAE 1.05</span>
                    </div>
                    <p class="projet-tech">Technologies : HTML/CSS, PHP</p>
                    <p class="projet-desc">
                        Création d'un site web responsive pour présenter la formation MMI.
                        Premières manipulations en PHP pour l'inclusion de parties communes (header/footer) et génération de contenu.
                    </p>
                </div>

                <div class="projet-card fade-in">
                    <div class="projet-header">
                        <h3>Site Dynamique & BDD</h3>
                        <span class="projet-tag">SAE 2.03</span>
                    </div>
                    <p class="projet-tech">Technologies : HTML/CSS, PHP, MySQL</p>
                    <p class="projet-desc">
                        Évolution du site précédent avec connexion à une base de données MySQL.
                        Génération de pages dynamiques (fiches cours/projets) et amélioration de l'accessibilité web.
                    </p>
                    <a href="https://alicam.alwaysdata.net/SAE203/code/" target="_blank" class="btn-projet">Voir le site →</a>
                </div>

                <div class="projet-card fade-in">
                    <div class="projet-header">
                        <h3>Refonte "Mamba"</h3>
                        <span class="projet-tag">EXERCICE ACADÉMIQUE</span>
                    </div>
                    <p class="projet-tech">Technologies : PHP (Statique vers Dynamique)</p>
                    <p class="projet-desc">
                        Exercice de transformation d'un code statique vers une architecture dynamique en PHP. 
                        Optimisation de la structure du code et gestion des routes.
                    </p>
                    <a href="https://alicam.alwaysdata.net/Mamba/" target="_blank" class="btn-projet">Voir le site →</a>
                </div>

                <div class="projet-card fade-in">
                    <div class="projet-header">
                        <h3>Visualisation : Baguette des Franciliens</h3>
                        <span class="projet-tag">SAE 3.03</span>
                    </div>
                    <p class="projet-tech">Technologies : JavaScript, Leaflet, Chart.js, HTML/CSS</p>
                    <p class="projet-desc">
                        Application de data-visualisation interactive pour localiser les boulangeries artisanales en Île-de-France. 
                        Intègre une carte dynamique (clustering), un tableau de bord statistique et un moteur de recherche avec autocomplétion.
                    </p>
                    <a href="https://alicam.alwaysdata.net/sae303/" target="_blank" class="btn-projet">Voir le site →</a>
                </div>


            </div>
        </div>
    </section>

    <!-- ============================================
         COMPÉTENCES
         ============================================ -->
    <section id="competences">
    <div class="container">
        <h2>Compétences</h2>
        
        <div class="skills-grid">
            <div class="skill-item fade-in">
                <img src="assets/icones/iconeHTML.png" alt="HTML5">
                <p>HTML</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeCSS.png" alt="CSS3">
                <p>CSS</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconePhp.png" alt="PHP">
                <p>PHP</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeJS.png" alt="JavaScript">
                <p>JavaScript</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeSQL.png" alt="SQL">
                <p>MySQL</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeWordpress.png" alt="WordPress">
                <p>WordPress</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconePS.png" alt="Photoshop">
                <p>Photoshop</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeAI.png" alt="Illustrator">
                <p>Illustrator</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeAE.png" alt="After Effects">
                <p>After Effects</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeIndesign.png" alt="InDesign">
                <p>InDesign</p>
            </div>

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeFigma.png" alt="Figma">
                <p>Figma</p>
            </div>    

            <div class="skill-item fade-in">
                <img src="assets/icones/iconeGit.png" alt="Git">
                <p>Git</p>
            </div>
        </div>
    </div>
</section>

    <!-- ============================================
         LANGUES
         ============================================ -->
    <section id="langues">
        <div class="container">
            <h2>Langues</h2>
            
            <div class="langues-grid">
                <div class="langue-item fade-in">
                    <img src="assets/img/drapeauUSA.png" alt="Anglais">
                    <p>Anglais</p>
                    <span class="niveau">Niveau B2</span>
                </div>

                <div class="langue-item fade-in">
                    <img src="assets/img/drapeauEspagne.png" alt="Espagnol">
                    <p>Espagnol</p>
                    <span class="niveau">Niveau A2+</span>
                </div>
            </div>
        </div>
    </section>

  <section id="contact">
        <div class="container">
            <h2>Me contacter</h2>
            
            <?php if(!empty($message_envoye)): ?>
                <p class="alert-msg" style="text-align:center; color: #4CAF50; font-weight:bold; margin-bottom:20px;">
                    <?php echo $message_envoye; ?>
                </p>
            <?php endif; ?>

            <div class="contact-wrapper">
                
                <form action="#contact" method="POST" class="contact-form fade-in">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required placeholder="Votre nom">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="votre@email.com">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Bonjour, je vous contacte pour..."></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Envoyer le message</button>
                </form>

                <div class="contact-infos fade-in">
                        <h3>Mes coordonnées</h3>
                        <p>En recherche active d'un stage de 10 semaines à partir du 13 avril 2026.</p>
    
                    <div class="info-item">
                    <strong>Email :</strong>
                    <a href="mailto:camaraliya07@gmail.com">camaraliya07@gmail.com</a>
                    </div>
    
                <div class="info-item">
                <strong>Téléphone :</strong>
                    <p>07 49 30 15 35</p>
                 </div>
    
    <div class="social-links" style="margin-top: 20px;">
        <a href="https://www.linkedin.com/in/aliya-camara/" target="_blank" class="btn-linkedin">
            Mon LinkedIn
        </a>
        </div>

</div>

            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content-bottom">
                <p>© <?php echo date('Y'); ?> Aliya Camara. Tous droits réservés.</p>
                </div>
        </div>
    </footer>
</html>