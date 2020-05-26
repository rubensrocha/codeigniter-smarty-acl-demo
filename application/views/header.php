<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>SmartyACL</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        body {
            padding-top: 5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">DEMO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if ($this->smarty_acl->logged_in(FALSE)): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/account">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            <?php endif; ?>
            <span class="navbar-text">|</span>
            <li class="nav-item">
                <a class="nav-link" href="/admin">Admin</a>
            </li>
            <?php if ($this->smarty_acl->logged_in()): ?>
                <?php if ($this->smarty_acl->module_authorized('roles')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/roles">Roles</a>
                    </li>
                <?php endif; ?>
                <?php if ($this->smarty_acl->module_authorized('modules')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/modules">Modules</a>
                    </li>
                <?php endif; ?>
                <?php if ($this->smarty_acl->module_authorized('admins')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/admins">Admins</a>
                    </li>
                <?php endif; ?>
                <?php if ($this->smarty_acl->module_authorized('users')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">Users</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/logout">Logout</a>
                </li>
            <?php endif; ?>
        </ul>
        <?php if ($this->smarty_acl->logged_in()): ?>
        <ul class="navbar-nav">
            <li class="text-white"><?php echo $this->smarty_acl->get_admin()['name']; ?> <small>(<?php echo $this->smarty_acl->get_admin()['group_name']; ?>)</small></li>
        </ul>
        <?php endif; ?>
        <?php if ($this->smarty_acl->logged_in(FALSE)): ?>
        <ul class="navbar-nav">
            <li class="text-white"><?php echo $this->smarty_acl->get_user()['name']; ?></li>
        </ul>
        <?php endif; ?>
    </div>
</nav>

<main role="main" class="container">
    <?php $this->load->view('alerts'); ?>
    <div class="starter-template">