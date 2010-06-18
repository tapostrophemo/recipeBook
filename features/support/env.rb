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

# via http://blog.aizatto.com/2007/05/21/activerecord-without-rails/
# TODO: read/parse connection info from app/config/database.php
ActiveRecord::Base.establish_connection(
  :adapter => 'mysql',
  :database => 'recipebook',
  :username => 'recipebook_user',
  :password => 'bob',
  :host => 'localhost')

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

class Book < ActiveRecord::Base
end

class Editor < ActiveRecord::Base
end
