<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<style>
			td {
				border: 1px solid black;
				width: 50px;
				height: 50px;
				cursor: pointer;
				font-size: 30px;
				text-align: center;
			}

			.joueur-x {
				color: blue;
			}

			.joueur-o {
				color: red;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>Tic Tac Toe</h1>

			<?php if ($_GET['joueur'] == 'x'): ?>
				<p>Lien pour votre adversaire: <input type="text" id="lien" value="http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?joueur=o&partie=' . $_GET['partie']; ?>"></p>
			<?php endif; ?>

			<p id="mon-tour"<?php if ($_GET['joueur'] != 'x'): ?> style="display: none"<?php endif; ?>>C'est à votre tour de jouer!</p>
			<p id="tour-adversaire"<?php if ($_GET['joueur'] != 'o'): ?> style="display: none"<?php endif; ?>>C'est à votre adversaire de jouer!</p>
			<h2 id="partie-terminee" style="display: none">Le joueur <span></span> a gagné!</h2>
		
			<table id="grille">
				<?php
					for($y = 0; $y < 3; $y++) {
						echo '<tr>';
						for($x = 0; $x < 3; $x++) {
							echo "<td id=\"case-$x-$y\" data-x=\"$x\" data-y=\"$y\"></td>";
						}
						echo '</tr>';
					}
				?>
			</table>
		</div>

		<?php include('github.html'); ?>

		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script>
			var partie = <?php echo json_encode($_GET['partie']); ?>;
			var monJoueur = <?php echo json_encode($_GET['joueur']); ?>;
		</script>
		<script src="partie.js"></script>
	</body>
</html>