<?php
class AdminPagesController extends AdminController {

    public function getIndex()
    {
        $this->data['pages'] = Page::parentList()->with('children')->get();

        $this->theme->setTitle('Manage Pages');
        $this->theme->asset()->usePath()->add('jquery-datatables', 'plugins/datatables/jquery.dataTables.min.js', 'jquery');
        $this->theme->asset()->usePath()->add('admin-pages-js', 'js/cms/admin-pages.js', 'jquery-datatables');

        return $this->theme->of('admin.pages.index', $this->data)->render();
    }

    public function getAdd()
    {
        $this->data['parentList'] = Page::parentList()->get();
        $this->data['form_data'] = array(
            'title' => '',
            'content' => '',
            'excerpt' => '',
            'slug' => '',
            'parent_id' => '0',
            'status' => 'publish'
        );

        $this->theme->setTitle('Add new Pages');
        $this->theme->asset()->usePath()->add('ckeditor', 'js/ckeditor/ckeditor.js');

        return $this->theme->of('admin.pages.add-edit', $this->data)->render();
    }

    public function postAdd()
    {
        return $this->savePage();
    }

    public function getEdit($page_id)
    {
        $this->data['form_data'] = Page::findOrFail($page_id)->toArray();
        $this->data['parentList'] = Page::parentList()->where('id', '!=', $page_id)->get();

        $this->theme->setTitle('Edit Pages');
        $this->theme->asset()->usePath()->add('ckeditor', 'js/ckeditor/ckeditor.js');

        return $this->theme->of('admin.pages.add-edit', $this->data)->render();
    }

    public function postEdit($page_id)
    {
        return $this->savePage($page_id);
    }

    public function postDelete()
    {
        if (Request::ajax())
        {
            $page_id = Input::get('page_id');
            Page::findOrFail($page_id)->delete();

            return Response::json(array('status' => 'success'));
        }
    }

    private function savePage($page_id = 0)
    {
        $page_data = Input::only('title', 'content', 'excerpt', 'status', 'parent_id', 'slug');

        if ( !Page::validate($page_data) )
        {
            return Redirect::back()->withInput()->withErrors(Page::errors());
        }

        if ( $page_id == 0 )
        {
            // Add new Page.
            $page = new Page;
        }
        else
        {
            // Update Page.
            $page = Page::find($page_id);
        }

        $page->title = Input::get('title');
        $page->content = Input::get('content');
        $page->excerpt = Input::get('excerpt');
        $page->status = Input::get('status');
        $page->parent_id = Input::get('parent_id');
        $page->slug = Input::get('slug');

        $page->save();

        return Redirect::to('admin/pages');
    }
}