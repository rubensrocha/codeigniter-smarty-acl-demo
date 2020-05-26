<?php $this->load->view('header'); ?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Admin Reset Password
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/reset_password/'.$code);?>" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Password Confirmation</label>
                                <input type="password" name="password_confirmation" placeholder="Password Confirmation" class="form-control"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>