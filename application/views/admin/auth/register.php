<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Admin Register
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/register');?>" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>