<?php

namespace App\models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Model;

class Login extends Model implements UserInterface, RemindableInterface
{
    protected $table = 'login';
    
}
