<div id="navbar-container">
	<nav id="navbar" class="flex-row-center">
		<a class="option <?= $subpage === Subpages::NOTES ? 'selected' : ''?>" href="#"><i class="fa fa-sticky-note"></i> Notes</a>
		<a class="option <?= $subpage === Subpages::SHARED_NOTES ? 'selected' : ''?>" href="#"><i class="fa fa-share-alt"></i> Shared</a>
		<a class="option <?= $subpage === Subpages::ACCOUNT_USER ? 'selected' : ''?>" href="#"><i class="fas fa-user"></i> Account</a>
	</nav>
</div>