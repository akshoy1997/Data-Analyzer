# Data-Analyzer
A HTML+AJAX application using (PHP+MySQL) in backend to convert csv files to table and also perform SQL operations.

## Few Points to be Mentioned about the Application

DATA ANALYZER is an UI application which has the following features:

* Converts CSV file submitted into an MySQL Record.
* Displays the MySQL Record in an interactive slider.
* Can display all the databases and their records when logged in to the admin panel.
* Can perform simple JOIN and TRANSFORM queries on two records selected.
* Exports the resultant query into an output file 'output.csv'.
* Uses this exported file to store into a new record and also displays this record on the slider.

## Few Points About My Code

Entire Coding is done using:
 FrontEnd -> HTML, BootStrap, Jquery
 Backend -> PHP-MySQL

* Database used here is 'learn'.
* Records used are 'customers' and 'orders' although the user is free to import any record in the database and perform 
   MySQL operations on them supported by the application.
* No hard coding of Primary Keys or record names. 
* The output record is 'output.csv' and the record is stored in 'table' in PHPmyadmin.

## Few Points Regarding Files and Folders

* Screenshots of the application is stored in Screenshots Folder.
* Uploads is stored in uploads folder.
* An video showing the full working of the application is also there.
* Two main files- 'index.php'(PHP file for CSV file upload) and 'index2.php' (PHP file for database and record queries)
* Four PHP files for sending AJAX Request to fetch data clicked by user.
* One 'login.php' to check the login details entered by user.
* An uploads folder where 'output.csv' is downloaded and also the submitted CSV files.
* One Zipped File of the whole folder.
