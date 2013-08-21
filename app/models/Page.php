<?php
class Page extends Myeloquent {

    protected static $rules = array(
        'title' => 'required',
    );

    // Children & Parent
    public function parent()
    {
        return $this->belongsTo('Page', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Page', 'parent_id');
    }

    // Query Scope 
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

    public function scopeParentList($query)
    {
        return $query->where('parent_id', '=', 0);
    }

    // Getter & Setter (Accessor & Mutator)
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

    /*
    public function getParentTitleAttribute($val)
    {
        return DB::table('pages a')
            ->join('pages b', 'a.parent_id', '=', 'b.id')
            ->select('b.title')->pluck('b.title');
    }
    */
}