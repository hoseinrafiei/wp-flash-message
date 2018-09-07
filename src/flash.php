<?php
// no direct access
defined('ABSPATH') or die();

/**
 * Flash Message Class.
 *
 * @class PREFIX_Flash
 * @version	1.0.0
 */
class PREFIX_Flash
{
    /**
	 * Constructor method
	 */
	public function __construct()
    {
	}

	public static function success($text, $dismissible = true)
	{
		return self::add($text, 'success', $dismissible);
	}

	public static function info($text, $dismissible = true)
	{
		return self::add($text, 'info', $dismissible);
	}

	public static function warning($text, $dismissible = true)
	{
		return self::add($text, 'warning', $dismissible);
	}

	public static function error($text, $dismissible = true)
	{
		return self::add($text, 'error', $dismissible);
	}

    private static function add($text, $type = 'info', $dismissible = true)
    {
    	// Text is Mandatory
    	if(trim($text) == '') return false;

        $types = array('error', 'info', 'success', 'warning');
        if(!in_array($type, $types)) $type = 'info';

        $messages = maybe_unserialize(get_option('prefix_flash_messages', array()));
        $messages[] = array(
        	'type' => $type,
        	'text' => $text,
        	'dismissible' => $dismissible
        );

        // Update the Flash Messages
        update_option('prefix_flash_messages', $messages);

        return true;
	}

    public static function show($print = true)
    {
        $messages = maybe_unserialize(get_option('prefix_flash_messages', ''));
        if(!is_array($messages)) return;

        $output = '';
        foreach($messages as $message)
        {
            $output .= '<div class="notice notice-'.$message['type'].($message['dismissible'] ? ' is-dismissible' : '').'"><p>'.$message['text'].'</p></div>';
        }

        // Clear flash messages
        delete_option('prefix_flash_messages');

        // Print
        if($print) echo $output;
        else return $output;
	}

	public static function init()
	{
		add_action('admin_notices', array('PREFIX_Flash', 'show'));
	}
}

// Initialize the Class
PREFIX_Flash::init();