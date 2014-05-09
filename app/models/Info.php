<?php

class Info extends \Eloquent {
	protected $table = 'info';
	protected $guarded = [];

	public static $genders = array
	(
		'Male'   =>	'Male', 
		'Female' =>	'Female'
	);
}