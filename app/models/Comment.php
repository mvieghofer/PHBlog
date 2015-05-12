<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Comment extends Eloquent {
    
    protected $fillable = ['commentator', 'comment', 'date', 'articleid'];
}
?>