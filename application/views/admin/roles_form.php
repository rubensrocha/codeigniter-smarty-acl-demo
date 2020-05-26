<?php $this->load->view('header'); ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Role <?php echo isset($item) ? 'Edit' : 'Create'; ?></h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $form_action; ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Name" class="form-control"
                                               value="<?php echo $item->name ?? set_value('name'); ?>"/>
                                    </div>
                                </div>
                                <div class="col-6">
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
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h4>Permissions</h4>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input toggle-checkbox" data-toggle-checkbox="permissions" id="checkbox-all">
                                <label for="checkbox-all">Check All</label>
                            </div>
                            <?php foreach ($modules as $module): $m_permissions = json_decode($module->permissions); ?>
                                <dl class="row">
                                    <dt class="col-3"><?php echo $module->name; ?></dt>
                                    <dd class="col-9">
                                        <?php foreach ($m_permissions as $pk => $pname):
                                            if(isset($module_permissions[$module->id]) && in_array($pname,$module_permissions[$module->id])){
                                                $checked = 'checked';
                                            }else{ $checked = ''; }
                                            ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input permissions" type="checkbox" name="modules[<?php echo $module->id; ?>][]"
                                                       value="<?php echo $pname; ?>" <?php echo $checked; ?> id="<?php echo $module->id.$pk; ?>">
                                                <label class="form-check-label"
                                                       for="<?php echo $module->id.$pk; ?>"><?php echo $pname; ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </dd>
                                </dl>
                            <?php endforeach;; ?>
                            <button type="submit"
                                    class="btn btn-primary"><?php echo isset($item) ? 'Update' : 'Create'; ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('footer'); ?>