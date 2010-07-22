require 'spec/expectations'

require 'ruby-debug'

require 'webrat'

require 'test/unit/assertions'
World(Test::Unit::Assertions)

Webrat.configure do |config|
  config.mode = :mechanize
end

World do
  session = Webrat::Session.new
  session.extend(Webrat::Methods)
  session.extend(Webrat::Matchers)
  session
end

# Helper method for running shell commands, via http://gist.github.com/188166
def run(command, verbose = false, message = nil)
  if verbose then
    puts "#{message}"
    puts command
    result = `#{command}`
    puts result
    return result
  else
    `#{command}`
  end
end

###

# make the DB-stuff available to tests with minimal ActiveRecord classes

require 'active_record'

@db_config_path = File.dirname(__FILE__)+"/../../app/config/database.php"
@db_config = File.read(@db_config_path).split("\n")
@db_config.split("\n") do |line|
  if line =~ /username.*'([^']+)'/ then @@db_user = $1 end
  if line =~ /password.*'([^']+)'/ then @@db_pass = $1 end
  if line =~ /database.*'([^']+)'/ then @@db_name = $1 end
  if line =~ /hostname.*'([^']+)'/ then @@db_host = $1 end
  if line =~ /dbdriver.*'([^']+)'/ then @@db_driver = $1 end
end

# via http://blog.aizatto.com/2007/05/21/activerecord-without-rails/
ActiveRecord::Base.establish_connection(
  :adapter => "#{@@db_driver}",
  :database => "#{@@db_name}",
  :username => "#{@@db_user}",
  :password => "#{@@db_pass}",
  :host => "#{@@db_host}")

class Recipe < ActiveRecord::Base
end

require 'authlogic'
class User < ActiveRecord::Base
  acts_as_authentic do |authconfig|
    authconfig.require_password_confirmation = false

    authconfig.crypto_provider = Authlogic::CryptoProviders::Sha1
    Authlogic::CryptoProviders::Sha1.join_token = ""
    Authlogic::CryptoProviders::Sha1.stretches = 1
  end
end

class AdminUser < ActiveRecord::Base
  acts_as_authentic do |authconfig|
    authconfig.require_password_confirmation = false

    authconfig.crypto_provider = Authlogic::CryptoProviders::Sha1
    Authlogic::CryptoProviders::Sha1.join_token = ""
    Authlogic::CryptoProviders::Sha1.stretches = 1
  end
end

class Book < ActiveRecord::Base
  has_many :recipes
end

class Editor < ActiveRecord::Base
end

class MarketingMetric < ActiveRecord::Base
  set_table_name "marketing"
end
