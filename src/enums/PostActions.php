<?php 

namespace App;

enum PostActions : string {
	case INSERT = 'insert';
	case DELETE = 'delete';
	case UPDATE = 'update';
	case SHARE = 'share';
	case LOG_OUT = 'log_out';
	case NONE = 'none';
}