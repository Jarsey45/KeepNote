<?php 
namespace App;
?>
<script type="module" src="./public/scripts/navbar.js"></script>

<div id="navbar-burger"><i class="fa fa-bars"></i></div>
<div id="navbar-tint" class="hidden"></div>
<div id="navbar-container" class="hidden">
	<div id="navbar-title">Keep<span class="highlight">Note</span></div>
	<nav id="navbar" class="flex-row-center">
		<a class="option <?= $subpage === Subpages::NOTES ? 'selected' : '' ?>"
			href="/<?= Subpages::NOTES->value ?>">
			<i class="fa fa-sticky-note"></i>Notes
		</a>
		<a class="option <?= $subpage === Subpages::SHARED_NOTES ? 'selected' : '' ?>"
			href="/<?= Subpages::SHARED_NOTES->value ?>">
			<i class="fa fa-share-alt"></i>Shared
		</a>
		<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === Roles::ADMIN): ?>
			<a class="option <?= $subpage === Subpages::ACCOUNT_ADMIN ? 'selected' : '' ?>"
			href="/<?= Subpages::ACCOUNT_ADMIN->value ?>">
			<i class="fa fa-users"></i>Manage
			</a>
		<?php endif; ?>
		<a class="option <?= $subpage === Subpages::ACCOUNT_USER ? 'selected' : '' ?>"
			href="/<?= Subpages::ACCOUNT_USER->value ?>">
			<i class="fas fa-user"></i>Account
		</a>
	</nav>
</div>