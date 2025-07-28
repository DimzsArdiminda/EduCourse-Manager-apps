<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkPenugasan extends Model
{
    protected $table = 'link_penugasan';
    protected $fillable = ['nama_penugasan', 'link_penugasan'];
    public $timestamps = true;
}
