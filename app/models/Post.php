<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent {
    
    protected $fillable = array('headline', 'content', 'ispage');
    
    protected $guarded = array('id');
    
    public function comments() {
        return $this->hasMany('Comment', 'post_id');
    }
}
    
    
?>