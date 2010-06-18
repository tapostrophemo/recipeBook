#!/bin/sh

SCRIPTS_DIR=/home/djp/prog/recipeBook/sql
DB_OWNER=recipebook_owner
DB_PASS=bob
SQL_COMMAND="mysql -u $DB_OWNER -p$DB_PASS recipebook"

if [ $PWD != $SCRIPTS_DIR ]; then
  echo "Please cd to $SCRIPTS_DIR"
  exit 1
fi

for f in teardown setup delta testdata; do
  echo -n "Executing $f.sql..."
  $SQL_COMMAND < $f.sql
  echo "done."
done

