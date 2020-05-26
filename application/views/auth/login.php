<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form action="login" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo set_value('username'); ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1" <?php echo set_checkbox('remember',1);?>>

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            Don't have an account?&nbsp;<a href="/register"> Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="/forgot_password">Forgot your password?</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="/resend_activation">Didn't receive the activation email?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>