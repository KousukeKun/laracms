<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><?php echo Theme::place('title') ?></span>
    </div>

    <div class="mws-panel-body no-padding">
        <form method="post" action="" class="mws-form">
            <div class="mws-form-block">

                <?php if ( !$errors->isEmpty() ) { ?>
                    <div class="mws-form-message error">
                        <?php
                            foreach ($errors->all(':message<br>') as $error) {
                                echo $error;
                            }
                        ?>
                    </div>
                <?php } ?>

                <div class="mws-form-row">
                    <label class="mws-form-label" for="title">Title</label>
                    <div class="mws-form-item">
                        <input type="text" class="large" id="title" name="title" value="<?php echo Input::old('title', $form_data['title']) ?>">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label" for="content">Content</label>
                    <div class="mws-form-item ckeditor-container">
                        <textarea class="large ckeditor" rows="6" id="content" name="content"><?php echo Input::old('content', $form_data['content']) ?></textarea>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label" for="excerpt">Excerpt</label>
                    <div class="mws-form-item">
                        <textarea class="large" rows="3" id="excerpt" name="excerpt"><?php echo Input::old('excerpt', $form_data['excerpt']) ?></textarea>
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">Categories</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list">
                            <?php foreach ($parent_categories as $key=>$cate) { ?>
                            <li>
                                <?php if ( in_array($cate->id, Input::old('categories', $form_data['categories'])) ) { ?>
                                    <?php echo Form::checkbox('categories[]', $cate->id, TRUE) ?> <label><?php echo $cate->name ?></label>
                                <?php } else { ?>
                                    <?php echo Form::checkbox('categories[]', $cate->id, FALSE) ?> <label><?php echo $cate->name ?></label>
                                <?php } ?>

                                <?php if ($cate->children->count() > 0) : ?>
                                    <ul>
                                    <?php foreach ($cate->children as $child) : ?>
                                        <?php if ( in_array($child->id, Input::old('categories', $form_data['categories'])) ) { ?>
                                            <li><?php echo Form::checkbox('categories[]', $child->id, TRUE) ?> <label><?php echo $child->name ?></label></li>
                                        <?php } else { ?>
                                            <li><?php echo Form::checkbox('categories[]', $child->id, FALSE) ?> <label><?php echo $child->name ?></label></li>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label" for="tags">Tags</label>
                    <div class="mws-form-item">
                        <input type="text" class="medium" id="tags" name="tags" value="<?php echo Input::old('tags', $form_data['tags']) ?>">
                    </div>

                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label" for="status">Status</label>
                    <div class="mws-form-item">
                        <?php echo Form::select('status', array('publish' => 'Publish', 'draft' => 'Draft'), Input::old('status', $form_data['status']), array('id' => 'status')) ?>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
</div>