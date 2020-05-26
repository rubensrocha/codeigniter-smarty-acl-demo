<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5>User <?php echo isset($item) ? 'Edit' : 'Create' ;?></h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $form_action ;?>" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo $item->username ?? set_value('username'); ?>" placeholder="Username" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo $item->email ?? set_value('email'); ?>" placeholder="Email" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo $item->name ?? set_value('name'); ?>" placeholder="Name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="<?php echo isset($item) ? 'Leave blank to do not change': 'Password';?>" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">-- SELECT --</option>
                                    <option value="active" <?php if (isset($item) && $item->status === 'active') {
                                        echo 'selected';
                                    } ?>>Active</option>
                                    <option value="inactive" <?php if (isset($item) && $item->status === 'inactive') {
                                        echo 'selected';
                                    } ?>>Inactive</option>
                                    <option value="banned" <?php if (isset($item) && $item->status === 'banned') {
                                        echo 'selected';
                                    } ?>>Banned</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo isset($item) ? 'Update' : 'Create' ;?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>