<?php
/**
 * Class AAAuthHelper
 *
 * This helper helps us localise? login for discovering info about user Authentication, login_name, ID ect.
 * Support for additional Auth plugins should be made here. Knowledge about where those plugins store session data
 * about the user is required.
 *
 * This is probably not the best approach since it requires some knowledge of the inner workings of some other plugin.
 * If only there was some sort of standard for this stuff.
 *
 * Current Support:
 * Authake
 * ActiveAdmin [stock auth system]
 *
 * @author Jared B (jaredb7)
 */

App::uses('AppHelper', 'View/Helper');

class AAAuthHelper extends AppHelper
{
    public $helpers = array('Session');

    public $loaded_plugins = array(); //Array of plugins found to be loaded by Cake
    public $active_auth_plug = array(); //An array containing the location of the user_id and user_name for the currently active Auth plugin

    public $known_auth_plugs = array(
        'Authake' => array(
            "user_id" => "Authake.id",
            "user_name" => "Authake.login"),

        "default" => array(
            "user_id" => "Auth.User.id",
            "user_name" => "Auth.User.username")
    );

    public function __construct(View $view, $settings = array())
    {
        parent::__construct($view, $settings);
        $this->loaded_plugins = CakePlugin::loaded();
        $this->active_auth_plug = $this->findActiveAuthPlugin();
    }

    function getUserId()
    {
        $user_id_loc = $this->active_auth_plug['user_id'];
        return $this->Session->read($user_id_loc);
    }

    function isLogged()
    {
        return ($this->getUserId() !== null);
    }

    function getLogin()
    {
        $user_name_loc = $this->active_auth_plug['user_name'];
        return $this->Session->read($user_name_loc);
    }

    function findActiveAuthPlugin()
    {
        $found = false;
        //Some plugins are loaded...
        if (!empty($this->loaded_plugins)) {
            foreach ($this->loaded_plugins as $i => $plug_name) {
                if (in_array($plug_name, $this->known_auth_plugs) && $found == false) {
                    return $this->known_auth_plugs[$plug_name];
                    break;
                }
            }
        }

        //No plugins found, return array entry for the ActiveAdmin default
        if ($found == false) {
            return $this->known_auth_plugs['default'];
        }

        return false;
    }
}
