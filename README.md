# PHP Technical Task
This simple application was written in `Yii2-Framework (Advanced)`. 

> *Note:* Application was destination for testing!!!

In the process of writing the application, the following technologies were used:
- PHP 7.2;
- PostgreSQL;
- Composer;
- Nginx
- Open Server

Instructions for started application:

1. Additional plugin has been installed:
    - PHP Db Seeder - https://github.com/tebazil/db-seeder
    - Yii2 DataTables - https://github.com/NullRefExcep/yii2-datatables
    - Guzzle HTTP Client - http://docs.guzzlephp.org/en/stable/
2. Initializing console migration using the command `php yii migrate/up`.
3. Run seed to generate data for the database from the console using the command `php yii seed/country-and-city`. 
Resource for seeds [https://simplemaps.com/data/world-cities](https://simplemaps.com/data/world-cities). File with data was saved on directory `resource/country_city`, 
name `worldcities.csv`.
4. Start job from console using the command `php yii forecast --city=<city> --start=<date start> --end=<date end>`.
