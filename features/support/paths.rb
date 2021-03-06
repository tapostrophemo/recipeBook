module NavigationHelpers
  BASE_URL = 'http://localhost/recipeBook'
  REWRITE_BASE = '/recipeBook'

  def path_to(page_name)
    case page_name

    when /the home\s?page/
      '/'

    when /the table of contents page/
      '/toc'

    when /the add recipe page/
      '/add'

    when /the "(recipe|edit|delete|suspend|reactivate)\/(.*)" page/
      '/' + $1 + '/' + $2

    when /the "Manage Your Account" page/
      # TODO: assert <title/> and <h1/>...
      '/settings'

    when /the add friends page/
      '/friends/add'

    when /accept an invitation with token "(.+)"/
      '/acceptinvitation/' + $1

    when /accept an invitation for user "(.+)"/
      user = User.find_by_username($1)
      '/acceptinvitation/' + user.perishable_token

    when /the admin page/
      '/admin'

    else
      begin
        page_name =~ /the (.*) page/
        path_components = $1.split(/\s+/)
        self.send(path_components.push('path').join('_').to_sym)
      rescue Object => e
        raise "Can't find mapping from \"#{page_name}\" to a path.\n" +
          "Now, go and add a mapping in #{__FILE__}"
      end
    end
  end
end

World(NavigationHelpers)
