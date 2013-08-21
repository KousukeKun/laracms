<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>Edit Category</span>
    </div>
    <div class="mws-panel-body no-padding">
        <?php if ( !$errors->isEmpty() ) { ?>
            <div class="mws-form-message error">
                <?php
                    foreach ($errors->all(':message<br>') as $error) {
                        echo $error;
                    }
                ?>
            </div>
        <?php } ?>
        <form action="" method="post" class="mws-form">
            <div class="mws-form-block">
                <div class="mws-form-row bordered">
                    <label class="mws-form-label" for="name">Category Name</label>
                    <div class="mws-form-item">
                        <input type="text" class="large" name="name" id="name" value="<?php echo Input::old('name', $form_data['name']) ?>">
                    </div>
                </div>
                <div class="mws-form-row bordered">
                    <label class="mws-form-label" for="slug">Category Slug</label>
                    <div class="mws-form-item">
                        <input type="text" class="" name="slug" id="slug" value="<?php echo Input::old('slug', $form_data['slug']) ?>">
                    </div>
                </div>
                <div class="mws-form-row bordered">
                    <label class="mws-form-label" for="detail">Detail</label>
                    <div class="mws-form-item">
                        <textarea class="large" rows="3" name="detail" id="detail"><?php echo Input::old('detail', $form_data['detail']) ?></textarea>
                    </div>
                </div>
                <div class="mws-form-row bordered">
                    <label class="mws-form-label">Parent Category</label>
                    <div class="mws-form-item">
                        <?php
                            $parentArray = array('0' => 'none');
                            foreach ($parent_categories as $val)
                            {
                                $parentArray[$val->id] = $val->name;
                            }
                        ?>
                        <?php echo Form::select('parent_id', $parentArray, Input::old('parent_id', $form_data['parent_id']), array('id' => 'parent_id')) ?>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</div>