<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Encoie de mail avec Java scripts</title>

	<!--Ficher Css-->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="contact_form">
		
		<!-- Nom -->
		<input type="text" name="nom" id="nom" class="your_name" value="" placeholder="Nom">
		<!-- Mail -->
		<input type="email" name="mail" id="mail" class="your_mail" value="" placeholder="Mail">
		<!-- Message-->
		<textarea class="your_message" id="message" name="message" placeholder="Message" cols="40" rows="7"></textarea>
		<!--Boutton envoyer-->
		<input type="submit" id="submit" name="submit" value="Envoyer" class="form_submit">
		<!--Affichage des notifications-->
		<h6 class="notifMail" id="notifMail"></h6>

	</div>

</body>

<script type="text/javascript" src="jquery-3.6.3.js"></script>

<script type="text/javascript">
	let notifMail = document.getElementById("notifMail");
	let nom = document.getElementById("nom");
	let mail = document.getElementById("mail");
	let message = document.getElementById("message");

	/*Fonction pour verifier le mail */
	function validMail(email) {
		let res = /\S+@\S+\.\S+/;
		return res.test(email);
	}


	$(document).ready(function (){

		$(document).on('click', '.form_submit', function(){

			/*Verifier si les champs sont vides*/
			if(nom.value != "" && mail.value != "" && message.value !=""){

				notifMail.style.display = "none";

				if(validMail(mail.value)){

					/* Transfert des donnés avec ajax*/
					$.ajax({
						url: "mail.php",
						method: "POST",
						data: {
							name: nom.value,
							mail: mail.value,
							message: message.value
						},
						success: function(data){

							if(data == "true"){

								/* Vider les champs après l'envoie du mail*/
								nom.value = "";
								mail.value = "";
								message.value = "";

								notifMail.style.display = "block";
								notifMail.style.background = "green";
								notifMail.textContent = "Mail envoyé avec succès";

								/* La notifications disparait après 4secondes */
								window.setTimeout(function (){
									notifMail.style.display = "none";
									notifMail.textContent = "";
								}, 4000);

							}else{
								console.log(data);
								notifMail.style.display = "block";
								notifMail.textContent = "Echec de l'envoie du mail";
							}
						}
					});

				}else{

					notifMail.style.display = "block";
					notifMail.textContent = "Mail invalide";
				}

			}else{

				notifMail.style.display = "block";
				notifMail.textContent = "Veuillez remplir tous les champs ";
			}

		});
	});
</script>

</html>