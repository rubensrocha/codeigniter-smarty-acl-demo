<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('smarty_acl');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->logged_in();
        $this->smarty_acl->authorized();
    }

    /**
     * Load views from admin views path
     * @param $view
     * @param null $data
     */
    protected function admin_views($view, $data = null)
    {
        $this->load->view('admin/'.$view, $data);
    }

    protected function logged_in()
    {
        if (!$this->smarty_acl->logged_in()) {
            return redirect('admin/login');
        }
    }

    /*
     * Index
     */
    public function index()
    {
        //print_r($this->session->userdata('login_admin_5dc3d3da95837cb55414978798a86fbee74dd54d'));
        echo '<br><br>';
        //var_dump($this->smarty_acl->authorized());
        $this->admin_views('index');
    }

    /******************************* ROLES ******************************/
    /*
     * Roles List
     */
    public function roles()
    {
        $URI = 'admin/roles';
        $data = ['URI' => $URI, 'items' => $this->smarty_acl->roles()];
        $this->admin_views('roles', $data);
    }

    /*
     * Create Role
     */
    public function role_create()
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        //Rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|alpha');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            //Create role
            $role = $this->smarty_acl->create_role([
                'name' => $this->input->post('name', true),
                'status' => $this->input->post('status', true),
                'permissions' => $this->input->post('modules', true)
            ]);
            //Created
            if ($role) {
                $this->session->set_flashdata('success_msg', 'Role created successfully!');
                return redirect('/admin/roles');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = [
            'form_action' => base_url('admin/roles/create'),
            'modules' => $this->smarty_acl->modules(),
        ];
        $this->admin_views('roles_form', $data);
    }

    /**
     * Edit Role
     * @param int $role_id
     */
    public function role_edit($role_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->role($role_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/roles');
        }
        //Rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|alpha');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            //Update role
            $role_update = $this->smarty_acl->update_role($item->id, [
                'name' => $this->input->post('name', true),
                'status' => $this->input->post('status', true),
                'permissions' => $this->input->post('modules', true)
            ]);
            //Updated
            if ($role_update) {
                $this->session->set_flashdata('success_msg', 'Role updated successfully!');
                return redirect('/admin/roles');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = [
            'form_action' => base_url("admin/roles/edit/$role_id"),
            'item' => $item,
            'modules' => $this->smarty_acl->modules(),
            'module_permissions' => $this->smarty_acl->module_permissions($role_id),
        ];
        $this->admin_views('roles_form', $data);
    }

    /**
     * Delete Role
     * @param int $role_id
     */
    public function role_delete($role_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->role($role_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/roles');
        }
        //Delete role
        $role_delete = $this->smarty_acl->delete_role($item->id);
        //Deleted
        if ($role_delete) {
            $this->session->set_flashdata('success_msg', 'Role deleted successfully!');
            return redirect('/admin/roles');
        }
        $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
        return redirect('/admin/roles');
    }

    /******************************* MODULES ******************************/
    /*
     * View Modules
     */
    public function modules()
    {
        $URI = 'admin/modules';
        $data = ['URI' => $URI, 'items' => $this->smarty_acl->modules()];
        $this->admin_views('modules', $data);
    }

    /*
     * Create Module
     */
    public function module_create()
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        //Rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('controller', 'Controller Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('permissions', 'Permissions', 'trim|required');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            //Create module
            $module = $this->smarty_acl->create_module([
                'name' => $this->input->post('name', true),
                'controller' => $this->input->post('controller', true),
                'permissions' => $this->input->post('permissions', true)
            ]);
            //Created
            if ($module) {
                $this->session->set_flashdata('success_msg', 'Module created successfully!');
                return redirect('/admin/modules');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = ['form_action' => base_url('admin/modules/create')];
        $this->admin_views('modules_form', $data);
    }

    /**
     * Edit Module
     * @param int $module_id
     */
    public function module_edit($module_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->module($module_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/modules');
        }
        //Rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('controller', 'Controller Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('permissions', 'Permissions', 'trim|required');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            //Update module
            $module_update = $this->smarty_acl->update_module($item->id, [
                'name' => $this->input->post('name', true),
                'controller' => $this->input->post('controller', true),
                'permissions' => $this->input->post('permissions', true)
            ]);
            //Updated
            if ($module_update) {
                $this->session->set_flashdata('success_msg', 'Module updated successfully!');
                return redirect('/admin/modules');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = ['form_action' => base_url("admin/modules/edit/$module_id"), 'item' => $item];
        $this->admin_views('modules_form', $data);
    }

    /**
     * Delete Module
     * @param int $module_id
     */
    public function module_delete($module_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->module($module_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/modules');
        }
        //Delete module
        $module_delete = $this->smarty_acl->delete_module($item->id);
        //Deleted
        if ($module_delete) {
            $this->session->set_flashdata('success_msg', 'Module deleted successfully!');
            return redirect('/admin/modules');
        }
        $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
        return redirect('/admin/modules');
    }

    /******************************* ADMINS ******************************/
    /*
     * List admins
     */
    public function admins()
    {
        $URI = 'admin/admins';
        $data = ['URI' => $URI, 'items' => $this->smarty_acl->admins()];
        $this->admin_views('admins', $data);
    }

    /*
     * Create Admin
     */
    public function admin_create()
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        //Rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[admins.username]|alpha_dash');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admins.email]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[' . $this->config->item('min_password_length', 'smarty_acl') . ']');
        $this->form_validation->set_rules('role_id', 'Role', 'trim|required|integer');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|alpha');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            //Create admin
            $admin = $this->smarty_acl->register($this->input->post('username', true),
                $this->input->post('password', true),
                $this->input->post('email', true),
                [
                    'name' => $this->input->post('name', true),
                    'status' => $this->input->post('status', true),
                ],
                $this->input->post('role_id', true));
            //Created
            if ($admin) {
                $this->session->set_flashdata('success_msg', 'Admin created successfully!');
                return redirect('/admin/admins');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = [
            'form_action' => base_url('admin/admins/create'),
            'roles' => $this->smarty_acl->roles()
        ];
        $this->admin_views('admins_form', $data);
    }

    /**
     * Edit Admin
     * @param int $admin_id
     */
    public function admin_edit($admin_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->get_admin($admin_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/admins');
        }
        //Rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[' . $this->config->item('min_password_length', 'smarty_acl') . ']');
        $this->form_validation->set_rules('role_id', 'Role', 'trim|required|integer');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|alpha');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            $data = [
                'name' => $this->input->post('name', true),
                'username' => $this->input->post('username', true),
                'email' => $this->input->post('email', true),
                'status' => $this->input->post('status', true),
                'role_id' => $this->input->post('role_id', true)
            ];
            if ($this->input->post('password', true)) {
                $data['password'] = $this->input->post('password', true);
            }
            //Update admin
            $admin_update = $this->smarty_acl->update_user($data, $item['id']);
            //Updated
            if ($admin_update) {
                $this->session->set_flashdata('success_msg', 'Admin updated successfully!');
                return redirect('/admin/admins');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = [
            'form_action' => base_url("admin/admins/edit/$admin_id"),
            'item' => (object)$item,
            'roles' => $this->smarty_acl->roles()
        ];
        $this->admin_views('admins_form', $data);
    }

    /**
     * Delete Admin
     * @param int $admin_id
     */
    public function admin_delete($admin_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->get_admin($admin_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/admins');
        }
        //Delete admin
        $admin_delete = $this->smarty_acl->delete_user($item['id']);
        //Deleted
        if ($admin_delete) {
            $this->session->set_flashdata('success_msg', 'Admin deleted successfully!');
            return redirect('/admin/admins');
        }
        $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
        return redirect('/admin/admins');
    }

    /******************************* USERS ******************************/
    /*
     * List users
     */
    public function users()
    {
        $URI = 'admin/users';
        $data = ['URI' => $URI, 'items' => $this->smarty_acl->users()];
        $this->admin_views('users', $data);
    }

    /*
     * Create User
     */
    public function user_create()
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        //Rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|alpha_dash');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[' . $this->config->item('min_password_length', 'smarty_acl') . ']');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|alpha');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            //Create user
            $user = $this->smarty_acl->register_user(
                $this->input->post('username', true),
                $this->input->post('password', true),
                $this->input->post('email', true),
                [
                    'name' => $this->input->post('name', true),
                    'status' => $this->input->post('status', true),
                ]);
            //Created
            if ($user) {
                $this->session->set_flashdata('success_msg', 'User created successfully!');
                return redirect('/admin/users');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = [
            'form_action' => base_url('admin/users/create')
        ];
        $this->admin_views('users_form', $data);
    }

    /**
     * Edit User
     * @param int $user_id
     */
    public function user_edit($user_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->get_user($user_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/users');
        }
        //Rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[' . $this->config->item('min_password_length', 'smarty_acl') . ']');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|alpha');
        //Validate
        if ($this->form_validation->run() === TRUE) {
            $data = [
                'name' => $this->input->post('name', true),
                'username' => $this->input->post('username', true),
                'email' => $this->input->post('email', true),
                'status' => $this->input->post('status', true)
            ];
            if ($this->input->post('password', true)) {
                $data['password'] = $this->input->post('password', true);
            }
            //Update user
            $user_update = $this->smarty_acl->update_user($data, $item['id'],FALSE);
            //Updated
            if ($user_update) {
                $this->session->set_flashdata('success_msg', 'Admin updated successfully!');
                return redirect('/admin/users');
            }
            $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
            return redirect(current_url());
        }
        $data = [
            'form_action' => base_url("admin/users/edit/$user_id"),
            'item' => (object)$item,
        ];
        $this->admin_views('users_form', $data);
    }

    /**
     * Delete User
     * @param int $user_id
     */
    public function user_delete($user_id)
    {
        //Check permission
        $this->smarty_acl->authorized_action();
        $item = $this->smarty_acl->get_user($user_id);
        if (!$item) {
            $this->session->set_flashdata('error_msg', 'Item not found!');
            return redirect('admin/users');
        }
        //Delete user
        $user_delete = $this->smarty_acl->delete_user($item['id'],FALSE);
        //Deleted
        if ($user_delete) {
            $this->session->set_flashdata('success_msg', 'Admin deleted successfully!');
            return redirect('/admin/users');
        }
        $this->session->set_flashdata('error_msg', $this->smarty_acl->errors());
        return redirect('/admin/users');
    }
}
