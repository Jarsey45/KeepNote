<?php 

enum PostActions : string {
	case INSERT = 'insert';
	case DELETE = 'delete';
	case UPDATE = 'update';
  case NONE = 'none';
}