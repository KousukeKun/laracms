<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> Posts ( <a href="<?php echo URL::to('admin/posts/add') ?>">+ Add new Post</a> )</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-datatable-fn mws-table">
            <thead>
                <tr>
                    <th style="width:30px;">ID</th>
                    <th>Title</th>
                    <th style="width:120px;">Categories</th>
                    <th style="width:60px;">Status</th>
                    <th style="width:120px;">Date</th>
                    <th style="width:120px;" class="no_sort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) { ?>
                <tr>
                    <td><?php echo $post->id ?></td>
                    <td class="title">
                        <a href="<?php echo $post->permalink ?>"><?php echo $post->title ?></a>
                    </td>
                    <td>
                        <?php $post->categories->each(function($cate){
                            echo $cate->name . ', ';
                        }) ?>
                    </td>
                    <td><?php echo $post->status ?></td>
                    <td><?php echo $post->created_at ?></td>
                    <td>
                        <a href="<?php echo URL::to('admin/posts/edit/'.$post->id) ?>" class="btn btn-primary">Edit</a>
                        <a href="<?php echo URL::to('admin/posts/delete') ?>" class="btn delete-post" postid="<?php echo $post->id ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>