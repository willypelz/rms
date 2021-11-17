<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ClientCompaniesScope implements Scope {
	/**
	 * Apply the scope to a given Eloquent query builder.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $builder
	 * @param  \Illuminate\Database\Eloquent\Model  $model
	 * @return void
	 */
	public function apply(Builder $builder, Model $model) {
		$request = is_array(request()->companyIds) ? request()->companyIds->toArray() : collect(request()->companyIds)->toArray();
		$builder->whereIn('company_id', $request);
	}
}