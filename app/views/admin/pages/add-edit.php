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
                    <label class="mws-form-label" for="slug">Slug</label>
                    <div class="mws-form-item">
                        <input type="text" class="" id="slug" name="slug" value="<?php echo Input::old('slug', $form_data['slug']) ?>">
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
                    <label class="mws-form-label" for="parent_id">Parent</label>
                    <div class="mws-form-item">
                        <?php
                            $parentArray = array('0' => 'none');
                            foreach ($parentList as $val)
                            {
                                $parentArray[$val->id] = $val->title;
                            }
                        ?>
                        <?php echo Form::select('parent_id', $parentArray, Input::old('parent_id', $form_data['parent_id']), array('id' => 'parent_id')) ?>
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label" for="status">Status</label>
                    <div class="mws-form-item">
                        <?php echo Form::select('status', array('publish' => 'Publish', 'draft' => 'Draft'), Input::old('status', $form_data['status']), array('id' => 'status')) ?>
                        <?php /*
                        <select class="large" id="status" name="status">
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                        */ ?>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
</div>