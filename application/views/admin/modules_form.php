<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Module <?php echo isset($item) ? 'Edit' : 'Create' ;?></h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $form_action ;?>" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $item->name ?? set_value('name'); ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Controller Name</label>
                                <input type="text" name="controller" placeholder="Controller Name" class="form-control" value="<?php echo $item->controller ?? set_value('controller'); ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Permissions(methods) List</label>
                                <input type="text" name="permissions" placeholder="Permissions" class="form-control" value="<?php echo isset($item) ? implode(',',json_decode($item->permissions,0)) : set_value('permissions'); ?>"/>
                                <small class="form-text">Comma separated</small>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo isset($item) ? 'Update' : 'Create' ;?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>