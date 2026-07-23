<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        $disciplines = Discipline::where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return view('disciplines.index', compact('disciplines'));
    }

    public function show(string $slug)
    {
        $discipline = Discipline::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Query all published disciplines to find prev/next circularly
        $all = Discipline::where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        $currentIndex = $all->search(fn($d) => $d->id === $discipline->id);

        if ($currentIndex === false) {
            abort(404);
        }

        $count = $all->count();

        $prevIndex = $currentIndex - 1;
        if ($prevIndex < 0) {
            $prevIndex = $count - 1;
        }

        $nextIndex = $currentIndex + 1;
        if ($nextIndex >= $count) {
            $nextIndex = 0;
        }

        $prevDiscipline = $all->get($prevIndex);
        $nextDiscipline = $all->get($nextIndex);

        return view('disciplines.show', compact('discipline', 'prevDiscipline', 'nextDiscipline'));
    }
}
