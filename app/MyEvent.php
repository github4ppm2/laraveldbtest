<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MyEvent extends Model
{
    public $table = 'events';
    public $fillable = ['title','description','photo'];

}