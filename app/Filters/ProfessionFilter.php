<?php

namespace App\Filters;

use App\Filters\QueryFilter;
use Illuminate\Support\Facades\DB;

class ProfessionFilter extends QueryFilter
{

    public function filterRules(): array
    {
        return [
            'search' => 'filled',
            'skills' => 'array|exists:skills,id',
        ];
    }

    public function search($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like',"%{$search}%")
                ->orWhere('sector', 'like', "%{$search}%");
        });
    }
    public function skills($query, $skills)
    {
        $subquery = DB::table('skill_profession AS s')
            ->selectRaw('COUNT(s.id)')
            ->whereColumn('s.profession_id', 'professions.id')
            ->whereIn('skill_id', $skills);

        $query->whereQuery($subquery, count($skills));
    }

}