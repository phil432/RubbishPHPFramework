echo "Input password"
read PASSWORD
mysql -uroot -p$PASSWORD < CreateDatabase.sql
