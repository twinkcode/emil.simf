# emil.simf

composer install

create data.db (SQLite) in /var/

php bin/console doctrine:migrations:migrate 

php bin/console doctrine:fixtures:load  
