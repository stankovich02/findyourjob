<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Job extends Component
{
    public Model $job;
    /**
     * Create a new component instance.
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job');
    }
}
