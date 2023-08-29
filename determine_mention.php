<!DOCTYPE html>
<html>
<head>
    <title>Détermination de la Mention</title>
    <!-- Charger les styles de Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Détermination de la Mention</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="nom" class="form-label">Entrez le Nom Complet de l'élève :</label>
                <input type="text" class="form-control" id="nom" name="nom"  pattern="[A-Za-z\s]+" title="Veuillez entrer un nom valide (lettres et espaces uniquement)" placeholder="Nourou Sy" required>
            </div>
            <div class="mb-3">
                <label for="moyenne" class="form-label">Entrez la moyenne de l'élève :</label>
                <input type="number" class="form-control" id="moyenne" name="moyenne" step="0.1" required>
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>

        <?php
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $nom = strval($_POST["nom"]);
            $moyenne = floatval($_POST["moyenne"]);

            // Vérifier la moyenne saisie
            if ($moyenne < 0 || $moyenne > 20) {
                echo '<p class="text-danger">La moyenne doit être comprise entre 0 et 20.</p>';
            } else {
                // Déterminer la décision
                $decision = ($moyenne >= 10) ? "Admis" : "Éliminé";

                // Déterminer la mention
                if ($moyenne >= 17) {
                    $mention = "Excellent";
                    $mention_class = "text-primary"; 
                } elseif ($moyenne >= 16) {
                    $mention = "Très Bien";
                    $mention_class = "text-success"; 
                } elseif ($moyenne >= 14) {
                    $mention = "Bien";
                    $mention_class = "text-info"; 
                } elseif ($moyenne >= 12) {
                    $mention = "Assez Bien";
                    $mention_class = "text-warning"; 
                }elseif ($moyenne >= 10) {
                    $mention = "Passable";
                    $mention_class = "text-dark"; 
                }else {
                    $mention = "Pas de Mention";
                    $mention_class = "text-danger"; 
                }

                // Affichage du résultat dans le tableau
                echo '<h2 class="mt-4">Résultats :</h2>';
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Nom de l\'élève</th>';
                echo '<th>Décision</th>';
                echo '<th>Moyenne</th>';
                echo '<th>Mention</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . htmlspecialchars($nom) . '</td>';
                echo '<td>' . $decision . '</td>';
                echo '<td>' . $moyenne . '</td>';
                echo '<td><strong class="' . $mention_class . '" style="font-size: 14px;">' . $mention . '</strong></td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
            }
        }
        ?>
    </div>
</body>
</html>
