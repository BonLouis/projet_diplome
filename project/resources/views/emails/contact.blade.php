<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Prise de contact</h2>
		<p>Réception d'un mail avec les éléments suivants :</p>
		<ul>
			<li><strong>Nom</strong> : {{ $contact['name'] }}</li>
			<li><strong>Email</strong> : {{ $contact['email'] }}</li>
			<li><strong>Message</strong> : {{ $contact['body'] }}</li>
		</ul>
	</body>
</html>