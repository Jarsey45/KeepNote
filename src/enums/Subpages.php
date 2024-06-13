<?php

namespace App;

enum Subpages : string {
	case NOTES = 'notes';
	case SHARED_NOTES = 'shared';
	case ACCOUNT_USER = 'account_user';
	case ACCOUNT_ADMIN = 'account_admin';
	case ADMIN_MANAGE_NOTES = 'admin_manage_notes';
	case ADMIN_MANAGE_USERS = 'admin_manage_users';
}