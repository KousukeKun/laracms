<?php
class Category extends Myeloquent {

    protected static $rules = array(
        'name' => 'required',
    );

    public function posts()
    {
        return $this->belongsToMany('Post', 'post_category');
    }

    // Children & Parent
    public function parent()
    {
        return $this->belongsTo('Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Category', 'parent_id');
    }

    /* Query Scope */
    public function scopeParentList($query)
    {
        return $query->where('parent_id', '=', 0);
    }

    /* Getter & Setter (Accessor & Mutator) */
    protected function getPermalinkAttribute($val)
    {
        if ($this->getAttribute('parent_id') > 0)
        {
            $parent_slug = self::whereId($this->getAttribute('parent_id'))->pluck('slug');
            $permalink = URL::to($parent_slug . '/' . $this->getAttribute('slug'));
        }
        else
        {
            $permalink = URL::to($this->getAttribute('slug'));
        }

        return $permalink;
    }

}