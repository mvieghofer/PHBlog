<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class PendingUsers extends Eloquent {
    protected $table = 'pending_users';
    
    protected $fillable = ['user_id', 'token'];
    
    protected $primaryKey = 'user_id';
}
?>