# MSG Insider: Internal & Private Messaging System

#### Upload the package to your server and extract the package. This package includes 2 folders and  8 files
The files as follow:
1. README.txt 		[this file]
2. db.config.php 	  [to config your database connection and create database tables]
3. index.php 		[edit the session name in Line 17 to get username]
4. inbox.php 		[edit the session name in Line 13 to get username]
5. outbox.php 		[edit the session name in Line 13 to get username]
6. send.php  	[edit the session name in Line 13  to get the user username]
7. send_email.php  	[requires editing from Line 18 to Line 24  to get the user's email]
8. delete.php 
/images 			[Explain how to create tables using the SQL codes]
/ckeditor5-build-classic-20.0.0 [Ckeditor for rich textarea]


Please Follow these instructions to install the script. The script is easy integrated, only need to make edits to get the user username.

1. Edit your database connection in  "db.config.php"
2. Run SQL codes to create tables which are commented in "db.config.php", and do not forget to edit your database name in the the SQL codes.
3. Edit the sessions to put the user username in variable $user [index.php, inbox.php, outbox.php, send.php]
4. Edit the admin username in variable $admin [index.php Line 20]
5. Do not remove any existing variable
6. Follow the commented notes in the top of every file 
7. Point to index.php in your browser to run the script.
8. To notify user through email about receving a new message, edit [send_email.php]

Credits: Ckeditor open source
https://ckeditor.com

For more information and support please contact me: support@bitbytecodes.com
