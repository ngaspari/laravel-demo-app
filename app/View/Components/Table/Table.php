<?php
namespace App\View\Components\Table;

use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;
    public array $footers;
    public string $class;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( array $headers = [], array $footers = [], string $class = '' )
    {
        $this->headers = $headers;
        $this->footers = $footers;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.table');
    }
}
