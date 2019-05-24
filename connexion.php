<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("head.php"); ?>
    </head>
    <body>
        <header class="index_header">
            <?php include("header.php"); ?>
		</header>
        <section class="connexion_header">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Jean Forteroche</h2>
            <h3>Connexion à votre espace personnel</h3>
        </section>

        <section class="connexion_container">
            <form class="connexion_form" action="connexion.php" method="post">
                <input class="identifiant" type="text" name="identifiant" placeholder="Identifiant" id="identifiant"><br/>
                <input class="password" type="password" name="motdepasse" placeholder="motdepasse" id="password"><br/>
                <input class="connexion" type="submit" name="connexion" placeholder="Connexion" id="connexion"><br/>
            </form>
        </section>
    </body>

    <footer class="footer">
		<?php include("footer.php"); ?>
	</footer>
</html>