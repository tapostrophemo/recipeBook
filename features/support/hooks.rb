Before do
  run "mysql -u #{@@db_user} -p#{@@db_pass} #{@@db_name} < sql/truncate.sql"
end
