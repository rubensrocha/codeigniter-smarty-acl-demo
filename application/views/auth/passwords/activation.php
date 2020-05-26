<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Request New Activation Link
                    </div>
                    <div class="card-body">
                        <form action="resend_activation" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" class="form-control"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Resend Activation Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>