<?php

namespace App\Http\Controllers;

use App\Profession;
use App\Skill;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::query()
            ->withCount('profiles')
            ->applyFilters()
            ->orderBy('title')
            ->paginate(10);

        return view('professions.index')
            ->with([
                'professions' => $professions,
                'skills' => Skill::orderBy('name')->get(),
                'checkedSkills' => collect(request('skills')),
            ]);
    }

    public function destroy(Profession $profession)
    {
        abort_if($profession->profiles()->exists(), 400, 'Cannot delete a profession linked to a profile');

        $profession->delete();

        return redirect()->route('profession.index');
    }
}
