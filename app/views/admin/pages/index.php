<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> Pages ( <a href="<?php echo URL::to('admin/pages/add') ?>">+ Add new Page</a> )</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-datatable-fn mws-table">
            <thead>
                <tr>
                    <th style="width:30px;">ID</th>
                    <th>Title</th>
                    <th style="width:60px;">Status</th>
                    <th style="width:120px;">Date</th>
                    <th style="width:120px;" class="no_sort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page) { ?>
                    <tr>
                        <td><?php echo $page->id ?></td>
                        <td class="title">
                            <a href="<?php echo $page->permalink ?>"><?php echo $page->title ?></a>
                        </td>
                        <td>
                            <?php if ($page->status == 'publish') { ?>
                                <span class="span-green">Publish</span>
                            <?php } else { ?>
                                <span class="span-grey">Draft</span>
                            <?php } ?>
                        </td>
                        <td><?php echo $page->created_at ?></td>
                        <td>
                            <a href="<?php echo URL::to('admin/pages/edit/'.$page->id) ?>" class="btn btn-primary">Edit</a>
                            <a href="<?php echo URL::to('admin/pages/delete') ?>" class="btn delete-page" pageid="<?php echo $page->id ?>">Delete</a>
                        </td>
                    </tr>
                    <?php if ($page->children->count() > 0) : ?>
                        <?php foreach ($page->children as $child) : ?>
                            <tr>
                                <td><?php echo $child->id ?></td>
                                <td class="title">
                                    <span class="span-grey">-----</span> <a href="<?php echo $child->permalink ?>"><?php echo $child->title ?></a>
                                </td>
                                <td>
                                    <?php if ($child->status == 'publish') { ?>
                                        <span class="span-green">Publish</span>
                                    <?php } else { ?>
                                        <span class="span-grey">Draft</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $child->created_at ?></td>
                                <td>
                                    <a href="<?php echo URL::to('admin/pages/edit/'.$child->id) ?>" class="btn btn-primary">Edit</a>
                                    <a href="<?php echo URL::to('admin/pages/delete') ?>" class="btn delete-page" pageid="<?php echo $child->id ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>