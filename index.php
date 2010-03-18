<?php
	$gpn_version = 9;
	$gpn_time = "3.-6. Juni 2010";
	$gpn_mail = "gpn9@entropia.de";
	$gpn_info_mail = "info@entropia.de";
	
	$ident = $_POST["ident"];
	$email = $_POST["email"];
	$help = ($_POST["help"] == "yes") ? true : false;
	$shirt = $_POST["shirt"];
	$posted = isset($_POST['submit']);
	$present = ($_POST["present"] == "yes") ? true : false;
	$present_desc = $_POST["present_desc"];
	
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
			$present_desc = htmlspecialchars($present_desc);
			
			// mail to user
			$header = "From: $gpn_mail <$gpn_mail>\n";
			$title = "Anmeldung zur GPN$gpn_version";
			$body = "Anmeldung fuer die GPN$gpn_version\n\n";
			$body .= "Danke fuer die Anmeldung bei der GPN. Wir freuen uns auf dich!\n\n";
		  if ($present)
				$body .= "Deinen Vortragsthema bearbeiten wir und melden uns dann spaeter...\n\n";
			$body .= "Bis zum $gpn_time.\n\n";
			$body .= "Dein GPN-Team";
			mail($email, $title, $body, $header);
	
			// mail to gpn team
			$header = "From: $email <$email>\n";
			$title = "$ident meldet sich zur GPN$gpn_version";
			$body = "$title\n\n";
			if ($help)
				$body .= "Ich wuerde gerne mithelfen...\n\n";
			if ($shirt != "")
				$body .= "Ich haette gerne ein T-Shirt in $shirt.\n\n";
			if ($present)
				$body .= "Mein Vortrag:\n$present_desc\n\n";
			$body .= "Viele Gruesse $ident";
			mail($gpn_mail, $title, $body, $header);
			mail($gpn_info_mail, $title, $body, $header);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>GPN<?php echo $gpn_version ?> Anmeldung</title>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<meta name="robots" content="index,follow" />
		<meta name="description" content="" />
		<meta name="author" content="ccc karlsruhe" />
		<meta name="keywords" content="ccc gpn<?php echo $gpn_version ?>" />
		<meta http-equiv="Content-language" content="de" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript">
			function toggle(checkbox, id) {
				if (checkbox.attr("checked")) {
					$(id).show("slow");
				} else {
					$(id).hide("slow");
				}
			}
		
			$(function() {
				$('#present').click(function() {
					toggle($(this), '#present_desc_p');
				});
				<?php if ($present) { ?>
				$('#present_desc_p').show();
				<?php } ?>
			});
		</script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1>GPN<?php echo $gpn_version ?> Anmeldung</h1>
				<p class="small">
					Am <?php echo $gpn_time ?>
				</p>
			</div>
			<div id="main">
			<?php if (isset($error) || !$posted) { ?>
				<form action="" method="post">
					<fieldset>
						<legend>Kontaktdaten</legend>
					<?php if (isset($error)) { ?>
						<p class="error"><?php echo $error ?><p>
					<?php } ?>
						<p>
							<label for="ident">Name/Nickname/Id:</label>
							<input type="text" id="ident" name="ident" class="ident" 
										 value="<?php echo $ident ?>"/>
						</p>
						<p>
							<label for="email">E-Mail:</label>
							<input type="text" id="email" name="email" class="email" 
										 value="<?php echo $email ?>">
						</p>
						<p>
							<input type="checkbox" id="help" name="help" value="yes" 
										 class="help" <?php if ($help) echo "checked" ?>>
							<label for="help">Mithelfen (als Troll/...)</label>
						</p>
					</fieldset>
					<fieldset>
						<legend>T-Shirt</legend>
						<p class="info">
							Wollt ihr ein T-Shirt in eurer Gr&ouml;&szlig;e mit reservieren?
							Einfach die Gr&ouml;&szlig;e ausw&auml;hlen und bei der GPN abholen.
						</p>
						<p>
							<label for="shirt">Gr&ouml;&szlig;e:</label>
							<select id="shirt" class="shirt" name="shirt">
								<option value="" <?php if ($shirt == "") echo "selected" ?>>
									- kein T-Shirt -
								</option>
								<optgroup label="for Boys">
									<option value="Boys-S" <?php if ($shirt == "Boys-S") echo "selected" ?>>
										S
									</option>
									<option value="Boys-M" <?php if ($shirt == "Boys-M") echo "selected" ?>>
										M
									</option>
									<option value="Boys-L" <?php if ($shirt == "Boys-L") echo "selected" ?>>
										L
									</option>
									<option value="Boys-XL" <?php if ($shirt == "Boys-XL") echo "selected" ?>>
										XL
									</option>
									<option value="Boys-XXL" <?php if ($shirt == "Boys-XXL") echo "selected" ?>>
										XXL
									</option>
								</optgroup>
								<optgroup label="for Girls">
									<option value="Girls-XS" <?php if ($shirt == "Girls-XS") echo "selected" ?>>
										XS
									</option>
									<option value="Girls-S" <?php if ($shirt == "Girls-S") echo "selected" ?>>
										S
									</option>
									<option value="Girls-M" <?php if ($shirt == "Girls-M") echo "selected" ?>>
										M
									</option>
									<option value="Girls-L" <?php if ($shirt == "Girls-L") echo "selected" ?>>
										L
									</option>
									<option value="Girls-XL" <?php if ($shirt == "Girls-XL") echo "selected" ?>>
										XL
									</option>
									<option value="Girls-XXL" <?php if ($shirt == "Girls-XXL") echo "selected" ?>>
										XXL
									</option>
								</optgroup>
							</select>
						</p>
					</fieldset>
					<fieldset>
						<legend>
							<input type="checkbox" id="present" name="present" 
										 value="yes" <?php if ($present) echo "checked" ?>>
							Ich m&ouml;chte vortragen
						</legend>
						<p id="present_desc_p">
							<label for="present_desc">Was willst du machen? Wann? Wie lange?</label>
							<textarea id="present_desc" name="present_desc" cols="40" 
												rows="10"><?php echo $present_desc ?></textarea>
						</p>
					</fieldset>
					<input id="submit" name="submit" type="submit" value="Anmelden">
				</form>
			<?php } else { ?>
				<p>
					Danke f&uuml;r deine Anmeldung. Als Best&auml;tigung haben wir dir
					eine E-Mail gesendet.
				</p>
			<?php } ?>
			</div>
			<div id="footer"></div>
		</div>
	</body>
</html>