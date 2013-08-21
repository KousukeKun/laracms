<?php
class Tag extends Myeloquent {

    protected static $rules = array(
        'name' => 'required',
    );

    /* Getter & Setter (Accessor & Mutator) */
    protected function getPermalinkAttribute($val)
    {
        return URL::to('tag/' . $this->getAttribute('slug'));
    }

}