<div class="mws-panel grid_3">
    <div class="mws-panel-header">
        <span>Add New Category</span>
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

<div class="mws-panel grid_5">
    <div class="mws-panel-header">
        <span>Categories</span>
    </div>

    <div class="mws-panel-body no-padding">
        <table class="mws-datatable-fn mws-table">
            <thead>
                <tr>
                    <th style="width:30px;">ID</th>
                    <th>Category Name</th>
                    <th style="width:120px;">Slug</th>
                    <th style="width:30px;">Count</th>
                    <th style="width:100px;" class="no_sort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parent_categories as $key=>$cate) { ?>
                    <tr>
                        <td><?php echo $cate->id ?></td>
                        <td class="title"><a href="<?php echo $cate->permalink ?>"><?php echo $cate->name ?></a></td>
                        <td><?php echo $cate->slug ?></td>
                        <td>0</td>
                        <td>
                            <a href="<?php echo URL::to('admin/categories/edit/' . $cate->id) ?>" class="btn btn-small btn-primary">Edit</a>
                            <a href="<?php echo URL::to('admin/categories/delete') ?>" class="btn btn-small delete-category" categoryid="<?php echo $cate->id ?>">Delete</a>
                        </td>
                    </tr>
                    <?php if ($cate->children->count() > 0) : ?>
                        <?php foreach ($cate->children as $child) : ?>
                            <tr>
                            <td><?php echo $child->id ?></td>
                            <td class="title"><span class="span-grey">-----</span> <a href="<?php echo $child->permalink ?>"><?php echo $child->name ?></a></td>
                            <td><?php echo $child->slug ?></td>
                            <td>0</td>
                            <td>
                                <a href="<?php echo URL::to('admin/categories/edit/' . $child->id) ?>" class="btn btn-small btn-primary">Edit</a>
                                <a href="<?php echo URL::to('admin/categories/delete') ?>" class="btn btn-small delete-category" categoryid="<?php echo $child->id ?>">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>