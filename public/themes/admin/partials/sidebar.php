<?php
    $menu_active = array('dashboard' => '', 'posts' => '', 'pages' => '');

    if (Request::segment(2) == 'pages')
    {
        $menu_active['pages'] = 'active';
    }
    elseif (Request::segment(2) == 'posts')
    {
        $menu_active['posts'] = 'active';
    }
    else
    {
        $menu_active['dashboard'] = 'active';
    }
?>
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>

        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">

            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li class="<?php echo $menu_active['dashboard'] ?>"><a href="<?php echo URL::to('admin') ?>"><i class="icon-home"></i> Dashboard</a></li>
                    <li class="<?php echo $menu_active['posts'] ?>">
                        <a href="#"><i class="icon-pencil"></i> Posts</a>
                        <ul>
                            <li><a href="<?php echo URL::to('admin/posts') ?>">All Posts</a></li>
                            <li><a href="<?php echo URL::to('admin/posts/add') ?>">Add New</a></li>
                            <li><a href="<?php echo URL::to('admin/categories') ?>">Categories</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo $menu_active['pages'] ?>">
                        <a href="#"><i class="icon-file"></i> Pages</a>
                        <ul>
                            <li><a href="<?php echo URL::to('admin/pages') ?>">All Pages</a></li>
                            <li><a href="<?php echo URL::to('admin/pages/add') ?>">Add New</a></li>
                        </ul>
                    </li>
<?php /*
                    <li><a href="dashboard.html"><i class="icon-home"></i> Dashboard</a></li>
                    <li><a href="charts.html"><i class="icon-graph"></i> Charts</a></li>
                    <li><a href="calendar.html"><i class="icon-calendar"></i> Calendar</a></li>
                    <li><a href="files.html"><i class="icon-folder-closed"></i> File Manager</a></li>
                    <li class="active"><a href="table.html"><i class="icon-table"></i> Table</a></li>
                    <li>
                        <a href="#"><i class="icon-list"></i> Forms</a>
                        <ul>
                            <li><a href="form_layouts.html">Layouts</a></li>
                            <li><a href="form_elements.html">Elements</a></li>
                            <li><a href="form_wizard.html">Wizard</a></li>
                        </ul>
                    </li>
                    <li><a href="widgets.html"><i class="icon-cogs"></i> Widgets</a></li>
                    <li><a href="typography.html"><i class="icon-font"></i> Typography</a></li>
                    <li><a href="grids.html"><i class="icon-th"></i> Grids &amp; Panels</a></li>
                    <li><a href="gallery.html"><i class="icon-pictures"></i> Gallery</a></li>
                    <li><a href="error.html"><i class="icon-warning-sign"></i> Error Page</a></li>
                    <li>
                        <a href="icons.html">
                            <i class="icon-pacman"></i> Icons <span class="mws-nav-tooltip">2000+</span>
                        </a>
                    </li>
*/ ?>
                </ul>
            </div>

        </div>