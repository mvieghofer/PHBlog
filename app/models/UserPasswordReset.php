<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
class UserPasswordReset extends Eloquent {
    protected $table = 'user_password_reset';
    
    protected $primaryKey = 'user_id';
    
    protected $fillable = ['user_id', 'token'];
}
?>