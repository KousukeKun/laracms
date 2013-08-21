<?php
class Post extends Myeloquent {

    protected static $rules = array(
        'title' => 'required',
        'categories' => 'required'
    );

    /* Query Scope */
    public function scopeDraft($query)
    {
        return $query->whereStatus('draft');
    }

    public function scopePublish($query)
    {
        return $query->whereStatus('publish');
    }

    public function scopeOrderById($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function categories()
    {
        return $this->belongsToMany('Category', 'post_category');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag', 'post_tag');
    }

    /* Getter & Setter (Accessor & Mutator) */
    protected function getPermalinkAttribute($val)
    {
        $permalink = URL::to($this->categories->first()->slug . '/' . $this->getAttribute('id') . '.html');

        return $permalink;
    }
}