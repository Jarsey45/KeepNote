<?php

namespace App;

enum Roles : int {
	case ADMIN = 1;
	case USER = 2;
	case TEST_UNIT = -100;
}