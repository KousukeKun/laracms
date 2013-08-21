<?php
class AdminCategoriesController extends AdminController {

    public function getIndex()
    {
        $this->data['parent_categories'] = Category::parentList()->get();
        $this->data['form_data'] = array(
            'name' => '',
            'slug' => '',
            'detail' => '',
            'parent_id' => 0
        );

        $this->theme->setTitle('Manage Categories');
        $this->theme->asset()->usePath()->add('admin-categories-js', 'js/cms/admin-categories.js', array('jquery'));

        return $this->theme->of('admin.categories.index', $this->data)->render();
    }

    public function postIndex()
    {
        return $this->saveCategory();
    }

    public function getEdit($category_id)
    {
        $this->data['form_data'] = Category::findOrFail($category_id);
        $this->data['parent_categories'] = Category::parentList()->where('id', '!=', $category_id)->get();

        $this->theme->setTitle('Edit Category');
        return $this->theme->of('admin.categories.edit', $this->data)->render();
    }

    public function postEdit($category_id)
    {
        return $this->saveCategory($category_id);
    }

    public function postDelete()
    {
        if (Request::ajax())
        {
            $category_id = Input::get('category_id');
            Category::findOrFail($category_id)->delete();

            return Response::json(array('status' => 'success'));
        }
    }

    private function saveCategory($category_id = 0)
    {
        $category_data = Input::only('name', 'detail', 'slug', 'parent_id');

        if ( !Category::validate($category_data) )
        {
            return Redirect::back()->withInput()->withErrors(Category::errors());
        }

        if ($category_id == 0)
        {
            // Add new Category
            $category = new Category;
        }
        else
        {
            // Update Category.
            $category = Category::find($category_id);
        }

        $category->name = Input::get('name');
        $category->detail = Input::get('detail');
        $category->parent_id = Input::get('parent_id');
        $category->slug = Input::get('slug');

        $category->save();

        return Redirect::to('admin/categories');
    }
}