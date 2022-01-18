# stephs_properties

## ABOUT THIS APP
 A basic application for syncing details from an external API.
 This application takes security into consideration by sanitizing and validating input into the DB to avoid sql injections.
 The database is also indexed to allow for easy search/filtering.

 # How to install
 - Clone the project 
 - Customize database details in '/system/core/Database.php'
 - To create your table and migrate : run  'php table.php' and 'php cli.php' from your CLI
 - Run your server and you should be good to go


 # If I had more time ...
 I would tidy up the UI,  but most of all focus on the filters on the index page.
 Currently the application has a single search bar that filters through all the parameters but what should be done is an 
 inline form with several input fields which include dropdowns to allow for a better filtering experience. 
