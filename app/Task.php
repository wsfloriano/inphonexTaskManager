<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'type',
		'content',
		'sort_order',
		'done',
    ];

    public function type() {
		return $this->hasMany('App\Type');
	}
}
