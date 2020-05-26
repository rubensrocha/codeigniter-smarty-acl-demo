<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_Demo extends CI_Migration
{
    /**
     * Config settings
     * @var array
     */
    private $settings;

    private function get_settings()
    {
        //Load configs
        $this->config->load('smarty_acl', TRUE);
        //Get tables array
        $tables = $this->config->item('tables', 'smarty_acl');
        //Tables prefix
        $this->settings['prefix'] = $tables['prefix'] ? $tables['prefix'].'_' : '';
        // Table names
        $this->settings['users'] = $tables['users'];
        $this->settings['admins'] = $tables['admins'];
        $this->settings['roles'] = $this->settings['prefix'].$tables['roles'];
        $this->settings['modules'] = $this->settings['prefix'].$tables['modules'];
        $this->settings['module_permissions'] = $this->settings['prefix'].$tables['module_permissions'];
        $this->settings['password_resets'] = $this->settings['prefix'].$tables['password_resets'];
        $this->settings['login_attempts'] = $this->settings['prefix'].$tables['login_attempts'];
    }

    public function up()
    {
        //Load settings
        $this->get_settings();
        
        /**************** Start Insert Data ****************/
        //Demo modules
        $this->db->insert($this->settings['modules'],['name' => 'Dashboard', 'controller' => 'admin', 'permissions' => '["index", "edit", "delete", "create"]']);
        $this->db->insert($this->settings['modules'],['name' => 'Manage Modules', 'controller' => 'modules', 'permissions' => '["index", "edit", "delete", "create"]']);
        $this->db->insert($this->settings['modules'],['name' => 'Manage Roles', 'controller' => 'roles', 'permissions' => '["index", "edit", "delete", "create"]']);
        $this->db->insert($this->settings['modules'],['name' => 'Manage Admins', 'controller' => 'admins', 'permissions' => '["index", "edit", "delete", "create"]']);
        $this->db->insert($this->settings['modules'],['name' => 'Manage Users', 'controller' => 'users', 'permissions' => '["index", "edit", "delete", "create"]']);
        /**************** End Insert Data ****************/
    }

    public function down()
    {
        //Load settings
        $this->get_settings();
    }
}