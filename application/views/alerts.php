<?php if (validation_errors()): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul class="list-unstyled mb-0">
            <?php echo validation_errors('<li>','</li>'); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_msg')): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php if(is_array($this->session->flashdata('error_msg'))){
            echo '<ul class="list-unstyled">';
            foreach ($this->session->flashdata('error_msg') as $error_msg){
                echo '<li>'.$error_msg.'</li>';
            }
            echo '</ul>';
        }else{ echo $this->session->flashdata('error_msg'); } ?>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('success_msg')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata('success_msg'); ?>
    </div>
<?php endif; ?>