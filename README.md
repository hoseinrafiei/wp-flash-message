# WordPress Flash Message
See [WordPress Notice API](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices)

It's a single file PHP library to show notices in the WordPress admin area. It uses WordPress notices API.

To use this library just put it in your plugin / theme files and then use it like below.

    include_once '/path/to/flash.php';
    
    PREFIX_Flash::success(__("Your data is saved completely.", 'text-domain'));
    PREFIX_Flash::info(__("There is an update for your theme.", 'text-domain'));
    PREFIX_Flash::warning(__("A valid category is required.", 'text-domain'));
    PREFIX_Flash::error(__("Something went wrong!", 'text-domain'));

If you're using composer, you can autoload the class as well. You just need to modify the class name or add namespace if needed.