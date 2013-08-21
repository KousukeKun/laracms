<?php
class AdminPostsController extends AdminController {

    public function getIndex()
    {
        $this->data['posts'] = Post::with('categories')->get();

        $this->theme->setTitle('Manage Posts');
        $this->theme->asset()->usePath()->add('jquery-datatables', 'plugins/datatables/jquery.dataTables.min.js', 'jquery');
        $this->theme->asset()->usePath()->add('admin-posts-js', 'js/cms/admin-posts.js', 'jquery-datatables');

        return $this->theme->of('admin.posts.index', $this->data)->render();
    }

    public function getAdd()
    {
        $this->data['parent_categories'] = Category::parentList()->get();
        $this->data['form_data'] = array(
            'title' => '',
            'content' => '',
            'excerpt' => '',
            'tags' => '',
            'categories' => array(),
            'status' => 'publish'
        );

        $this->theme->setTitle('Add new Post');
        $this->theme->asset()->usePath()->add('ckeditor', 'js/ckeditor/ckeditor.js');

        return $this->theme->of('admin.posts.add-edit', $this->data)->render();
    }

    public function postAdd()
    {
        return $this->savePost();
    }

    public function getEdit($post_id)
    {
        $this->data['parent_categories'] = Category::parentList()->get();
        $post = Post::findOrFail($post_id);
        $this->data['form_data'] = $post->toArray();
        $this->data['form_data']['categories'] = array();


        foreach ($post->categories as $key=>$val)
        {
            $this->data['form_data']['categories'][] = $val->id;
        }

        $tags = array();
        foreach ($post->tags as $key=>$val)
        {
            $tags[] = $val->name;
        }

        $this->data['form_data']['tags'] = (empty($tags)) ? '' : implode(', ', $tags);

        $this->theme->setTitle('Edit Post');
        $this->theme->asset()->usePath()->add('ckeditor', 'js/ckeditor/ckeditor.js');

        return $this->theme->of('admin.posts.add-edit', $this->data)->render();
    }

    public function postEdit($post_id)
    {
        return $this->savePost($post_id);
    }

    private function savePost($post_id = 0)
    {
        $post_data = Input::only('title', 'content', 'excerpt', 'status', 'categories');

        if ( !Post::validate($post_data) )
        {
            return Redirect::back()->withInput()->withErrors(Post::errors());
        }

        if ( $post_id == 0 )
        {
            // Add new Post.
            $post = new Post;
        }
        else
        {
            // Update Post.
            $post = Post::find($post_id);
        }

        $post->title = Input::get('title');
        $post->slug = Input::get('title');
        $post->content = Input::get('content');
        $post->excerpt = Input::get('excerpt');
        $post->status = Input::get('status');
        $post->save();

        // Add (Or Update) Category
        // $post_data['categories'] validated already (It will be not NULL)
        $post->categories()->sync($post_data['categories']);

        // Add (Or Update) Tags
        $input_tags = Input::get('tags');
        $arr_tags = explode(',', $input_tags);

        $arr_tags_id = array();
        foreach ($arr_tags as $key=>$tag)
        {
            $tag = trim($tag);
            if (empty($tag)) continue;

            $tag_id = Tag::whereName($tag)->pluck('id');

            if (!$tag_id)
            {
                $tag_obj = new Tag;
                $tag_obj->name = $tag;
                $tag_obj->slug = $tag;
                $tag_obj->save();

                $tag_id = $tag_obj->id;
            }

            $arr_tags_id[] = $tag_id;
        }

        if (!empty($arr_tags_id))
        {
            $post->tags()->sync($arr_tags_id);
        }
        else
        {
            $post->tags()->detach();
        }

        return Redirect::to('admin/posts');
    }

    public function postDelete()
    {
        if (Request::ajax())
        {
            $post_id = Input::get('post_id');
            Post::findOrFail($post_id)->delete();

            return Response::json(array('status' => 'success'));
        }
    }

}