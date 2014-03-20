$("#lien").click(function() {
	$(this).select(); //Sélectionner contenu de boîte de texte de lien pour adversaire lorsque cliqué
});

var monTour = true;
var partieTerminee = false;
var derniereMiseAJour = 0;

function faireTour(joueur, x, y) {
	$("#case-" + x + "-" + y).text(joueur).addClass("joueur-" + joueur);

	monTour = joueur != monJoueur; //C'est mon tour si le joueur qui vient de jouer n'est pas moi

	$("#mon-tour").toggle(monTour);
	$("#tour-adversaire").toggle(!monTour);

	verifierPartie();
}

function verifierPartie() {
	//Horizontales
	verifierLigne($("#case-0-0").text() + $("#case-1-0").text() + $("#case-2-0").text());
	verifierLigne($("#case-0-1").text() + $("#case-1-1").text() + $("#case-2-1").text());
	verifierLigne($("#case-0-2").text() + $("#case-1-2").text() + $("#case-2-2").text());

	//Verticales
	verifierLigne($("#case-0-0").text() + $("#case-0-1").text() + $("#case-0-2").text());
	verifierLigne($("#case-1-0").text() + $("#case-1-1").text() + $("#case-1-2").text());
	verifierLigne($("#case-2-0").text() + $("#case-2-1").text() + $("#case-2-2").text());

	//Diagonales
	verifierLigne($("#case-0-0").text() + $("#case-1-1").text() + $("#case-2-2").text());
	verifierLigne($("#case-0-2").text() + $("#case-1-1").text() + $("#case-2-0").text());
}

function verifierLigne(str) {
	if (str == "xxx" || str == "ooo") {
		partieTerminee = true;
		var gagnant = str.charAt(0);

		$("#partie-terminee").show().find("span").text(gagnant).addClass("joueur-" + gagnant);
		$("#mon-tour, #tour-adversaire").hide();
	}
}

//Jouer un tour
$("#grille td").click(function() {
	if ($(this).text() != "") //Si case pas vide
		return;

	if (!monTour) //Si pas mon tour
		return;

	if (partieTerminee) //Si partie n'est pas terminée
		return;

	faireTour(monJoueur, $(this).data("x"), $(this).data("y"));

	$.ajax({
		type: "POST",
		url: "envoyer_tour.php",
		data: {
			x: $(this).data("x"),
			y: $(this).data("y"),
			partie: partie,
			joueur: monJoueur
		},
		success: function(id) {
			derniereMiseAJour = id;
		}
	});
});

//Récupérer tours au début et périodiquement
function recupererTours() {
	$.ajax({
		type: "GET",
		url: "recuperer_tours.php",
		data: {
			partie: partie,
			derniereMiseAJour: derniereMiseAJour
		},
		dataType: "json",
		success: function(tours) {
			tours.forEach(function(tour) {
				faireTour(tour.joueur, tour.x, tour.y);
			});

			if (!partieTerminee)
				setTimeout(recupererTours, 1000);
		}
	});
}

recupererTours();