Twig User Helper for Bolt
=========================

This [bolt.cm](https://bolt.cm/) extension adds some twig helper functions to work with Bolt users in your templates.

### Installation
1. Login to your Bolt installation
2. Go to "Extend" or "Extras > Extend"
3. Type `twig-user-helper` into the input field
4. Click on the extension name
5. Click on "Browse Versions"
6. Click on "Install This Version" on the latest stable version

---

### Get All Users

The `users()` function returns all registered users. They are sort by ID and contain even disabled users.

```
{% for user in users() if user.enabled %}
    {{ user.displayname }} <br>
{% endfor %}
```

You can also order them by username or any other key on the user object.

```
{% for user in users()|order('username') if user.enabled %}
    {{ user.displayname }} <br>
{% endfor %}
```

### Get a Single User

The `user()` function returns a single user array, or `null` if no user was found. 
It accepts an ID, an username or an email address as parameter.

```
{% set user = user(7) %}
```

```
{% set user = user('phillipp') %}
```

```
{% set user = user('user@email.com') %}
```

---

### License

This Bolt extension is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
