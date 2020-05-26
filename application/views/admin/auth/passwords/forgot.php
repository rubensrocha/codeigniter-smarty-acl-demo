<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Admin Password Recovery
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/forgot_password');?>" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" class="form-control"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>