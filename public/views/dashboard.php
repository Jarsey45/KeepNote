<?php 
$subpage = isset($subpage) ? Subpages::from($subpage) : Subpages::NOTES;
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?=STYLES_PATH?>style.css">
		<link rel="stylesheet" href="<?=STYLES_PATH?>nav.css">
		<?php
			switch($subpage) {
				case Subpages::NOTES: 
					print('<link rel="stylesheet" href="' . STYLES_PATH . 'notes.css">');
					break;
				default: break;
			}
		?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
		<title>KeepNote - Dashboard</title>
	</head>

	<body>
		<?php include VIEWS_PATH . 'shared/navbar.php';?>
		<?php include VIEWS_PATH . "subpages/$subpage->value.php"; ?>

	</body>

</html>