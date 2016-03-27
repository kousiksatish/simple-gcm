###Stupid Simple GCM Server

A simple GCM server that can be used for all fests

####Setup:

* Depends on vlucas/Dotenv, so run `composer install`
* Create a `.env` file according to the format specified in `.env.example` and populate the data
* run the `/create_tables.php` route to add the tables into an existing database

####Routes:
* `/register.php`
  * Used to register the phone's `gcm_id` with the server and saves to database
  * Accepts a POST request with the `gcm_id` sent as form-data
* `/send_gcm.php`
  * Used to send the message to **all** GCM ids
  * Accepts a POST request with the `message` sent as form-data
