# *KeepNote*

KeepNote is an app for keeping your notes and sharing them with others.
> Plain and simple ***with an eye-catching design***.

---
# Table of contents
1. [Database Schema](#database-schema)
1. [Design Patterns](#design-patterns)
1. [Features](#features)
1. [Admin Features](#admin-features)
1. [UML diagram](#uml-diagram)
1. [Credits](#credits)
1. [License](#license)
---
## Database Schema
- The [`init_schema.sql`](./docker/db/init/init_schema.sql) initialize PostgreSQL database with required tables

## Design Patterns
1. **MVC** - architecture pattern that separates an application into three main components: Model, View, and Controller.
1. **Factory** - uses factory methods to deal with the problem of creating objects without having to specify their exact class.
1. **Singleton** - ensure that a class has only one instance.
1. **Fluent Interface** - design relies extensively on method chaining e.g. [`Note.php`](/src/classes/Note.php).

## *Features*

#### Creating new **notes**
Desktop | Mobile
:---:|:---:
![create new note](/public/pics/new_note_form.png) | ![create new note mobile](/public/pics/new_note_form_mobile.png)
#### Editing existing **notes**
Desktop | Mobile
:---:|:---:
![note options](/public/pics/note_options.png)
![create new note](/public/pics/edit_note.png) | ![create new note mobile](/public/pics/edit_note_mobile.png)

#### Share existing **notes**
Desktop | Mobile
:---:|:---:
![create new note](/public/pics/shared_notes.png) | ![create new note mobile](/public/pics/shared_notes_mobile.png)
#### View account information and sharing statistics
Desktop | Mobile
:---:|:---:
![account information and statistics](/public/pics/account_info.png) | ![account information and statistics](/public/pics/account_info_mobile.png) 

### *Admin Features*

#### Manage existing accounts
![Admin account](/public/pics/admin_management.png)

## UML diagram

![UML diagram](/public/pics/UML_dot.png)

## *Credits*

- [Me 🙂](https://github.com/Jarsey45)
- [PHP documentation](https://www.php.net/manual/en/index.php)
- [Docker documentation](https://docs.docker.com)
- [phuml](https://github.com/MontealegreLuis/phuml)

## *License*
[MIT License](https://opensource.org/license/MIT)