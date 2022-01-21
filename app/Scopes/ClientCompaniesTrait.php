<?php

namespace App\Scopes;

trait ClientCompaniesTrait {

	protected static function boot() {
		parent::boot();
		static::addGlobalScope(new ClientCompaniesScope);
	}
}
