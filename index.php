<?
	$gpn_version = 9;
	$gpn_time = "3.-6. Juni 2010";
	$gpn_mail = "anmeldung@entropia.de";
	$content_type = "Content-Type: text/html";
	
	$ident = $_POST["ident"];
	$email = $_POST["email"];
	$help = ($_POST["help"] == "yes") ? true : false;
	$shirt = $_POST["shirt"];
	$posted = isset($_POST['submit']);
	
	if ($posted) {
		if ($ident == "") {
			$error = "Wir wissen nicht wie wir dich nennen sollen?!";
		} else if (!eregi("^[a-z0-9]+([-_\.]?[a-z0-9])+@[a-z0-9]+([-_\.]?[a-z0-9])+\.[a-z]{2,4}$", $email)) {
			$error = "Was ist das den f&uuml;r eine E-Mail Adresse?";
		} else {
			// escape strings
			$ident = htmlspecialchars($ident);
			$email = htmlspecialchars($email);
			$shirt = htmlspecialchars($shirt);
			
			// mail to user
			$header = "From: $gpn_mail <$gpn_mail>\n$content_type\n";
			$title = "Anmeldung zur GPN$gpn_version";
			$body = "<h1>Anmeldung f&uuml;r die GPN$gpn_version</h1>
			 <p>Danke f&uuml;r die Anmeldung bei der GPN. Wir freuen uns auf dich!</p>
			 <p>Bis zum $gpn_time.</p>
			 <p>Dein GPN-Team</p>";
			echo $email, $title, $body, $header;
	
			// mail to gpn team
			$header = "From: $email <$email>\n$content_type\n";
			$title = "$ident meldet sich zur GPN$gpn_version";
			$body = "<h1>$title</h1>";
			if ($help)
				$body .= "<p>Ich w&uuml;rde gerne mithelfen...</p>";
			if ($shirt != "")
				$body .= "<p>Ich h&auml;tte gerne ein T-Shirt in $shirt.</p>";
			$body .= "<p>Ciao, $ident</p>";
			echo $gpn_mail, $title, $body, $header;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>GPN9 Anmeldung</title>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<meta name="robots" content="index,follow" />
		<meta name="description" content="" />
		<meta name="author" content="ccc karlsruhe" />
		<meta name="keywords" content="ccc gpn<? echo $gpn_version ?>" />
		<meta http-equiv="Content-language" content="de" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1>GPN<? echo $gpn_version ?> Anmeldung</h1>
				<p class="small">
					Am <? echo $gpn_time ?>
				</p>
			</div>
			<div id="main">
			<? if (isset($error) || !$posted) { ?>
				<form action="" method="post">
					<fieldset>
						<legend>Kontaktdaten</legend>
					<? if (isset($error)) { ?>
						<p class="error"><? echo $error ?><p>
					<? } ?>
						<p>
							<label for="ident">Name/Nickname/Id:</label>
							<input type="text" id="ident" name="ident" class="ident" value="<? echo $ident ?>"/>
						</p>
						<p>
							<label for="email">E-Mail:</label>
							<input type="text" id="email" name="email" class="email" value="<? echo $email ?>">
						</p>
						<p>
							<input type="checkbox" id="help" name="help" value="yes" class="help" <? if ($help) echo "checked" ?>>
							<label for="help">Mithelfen (als Troll/...)</label>
						</p>
					</fieldset>
					<fieldset>
						<legend>T-Shirt</legend>
						<p class="info">
							Wollt ihr ein T-Shirt in eurer Gr&ouml;&szlig;e mit reservieren?
							Einfach die Gr&ouml;&szlig;e, ausw&auml;hlen und bei der GPN abholen.
						</p>
						<p>
							<label for="shirt">Gr&ouml;&szlig;e:</label>
							<select id="shirt" class="shirt" name="shirt">
								<option value="" <? if ($shirt == "") echo "selected" ?>>
									- kein T-Shirt -
								</option>
								<option value="S" <? if ($shirt == "S") echo "selected" ?>>
									S
								</option>
								<option value="M" <? if ($shirt == "M") echo "selected" ?>>
									M
								</option>
								<option value="XL" <? if ($shirt == "XL") echo "selected" ?>>
									XL
								</option>
								<option value="XXL" <? if ($shirt == "XXL") echo "selected" ?>>
									XXL
								</option>
							</select>
						</p>
					</fieldset>
					<input id="submit" name="submit" type="submit" value="Anmelden">
				</form>
			<? } else { ?>
				<p>
					Danke f&uuml;r deine Anmeldung. Als Best&auml;tigung haben wir dir
					eine E-Mail gesendet.
				</p>
			<? } ?>
			</div>
			<div id="footer"></div>
		</div>
	</body>
</html>