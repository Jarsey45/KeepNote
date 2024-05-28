<script type="module" src="./public/scripts/navbar.js"></script>

<div id="navbar-burger"><i class="fa fa-bars"></i></div>
<div id="navbar-tint"></div>
<div id="navbar-container">
	<div id="navbar-title">Keep<span class="highlight">Note</span></div>
	<nav id="navbar" class="flex-row-center">
		<a class="option <?= $subpage === Subpages::NOTES ? 'selected' : '' ?>" href="?subpage=<?=Subpages::NOTES->value?>"><i class="fa fa-sticky-note"></i> Notes</a>
		<a class="option <?= $subpage === Subpages::SHARED_NOTES ? 'selected' : '' ?>" href="?subpage=<?=Subpages::SHARED_NOTES->value?>"><i class="fa fa-share-alt"></i> Shared</a>
		<a class="option <?= $subpage === Subpages::ACCOUNT_USER ? 'selected' : '' ?>" href="?subpage=<?=Subpages::ACCOUNT_USER->value?>"><i class="fas fa-user"></i> Account</a>
	</nav>
</div>