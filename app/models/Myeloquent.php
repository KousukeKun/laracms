<?php

abstract class Myeloquent extends Eloquent {

    protected $softDelete = TRUE;

    protected static $rules = array();

    protected static $messages = array(
        'required' => 'กรุณากรอก :attribute ด้วยค่ะ',
        'email' => 'กรุณากรอก :attribute ให้ถูกต้องตามรูปแบบด้วยค่ะ',
        'unique' => ':attribute นี้ ได้เคยใช้สมัครสมาชิกแล้วค่ะ',
        'confirmed' => 'กรุณา ยืนยันรหัสผ่าน ให้ตรงกันด้วยค่ะ'
    );

    protected static $errors;

    public static function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, static::$rules, static::$messages);
        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            static::$errors = $v->messages();
            return false;
        }
        // validation pass
        return true;
    }

    public static function errors()
    {
        return static::$errors;
    }

    protected function setSlugAttribute($val)
    {
        if ( !empty($val) )
        {
            $slug = static::sanitizeSlug($val);
        }
        elseif (isset($this->attributes['title']))
        {
            $slug = static::sanitizeSlug($this->attributes['title']);
        }
        elseif (isset($this->attributes['name']))
        {
            $slug = static::sanitizeSlug($this->attributes['name']);
        }

        // Check Slug ถ้าซ้ำ ก็เติม suffix เพิ่มไป จนกว่าจะไม่ซ้ำ
        $original_slug = $slug;
        $suffix_num = 1;
        do
        {
            $slug = ($suffix_num > 1) ? $original_slug . "-{$suffix_num}" : $original_slug ;
            $suffix_num++;

            if ( isset($this->attributes['id']) )
            {
                $count = static::whereSlug($slug)->where('id', '!=', $this->attributes['id'])->count();
            }
            else
            {
                $count = static::whereSlug($slug)->count();
            }
        } while ($count > 0);

        $this->attributes['slug'] = $slug;
    }

    protected static function sanitizeSlug($string, $length=100, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                       "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                       "—", "–", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = preg_replace('/\-+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
        if (function_exists('mb_substr')) {
            $clean = mb_substr($clean, 0, $length, 'UTF-8');
        } else {
            $clean = substr($clean, 0, $length);
        }

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}