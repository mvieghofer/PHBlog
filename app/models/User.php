<?php
use Illuminate\Database\Eloquent\Model as Eloquent;
class User extends Eloquent {
    protected $fillable = ['username', 'password', 'salt', 'is_active', 'token', 'remember', 'remember_until'];
}
?>