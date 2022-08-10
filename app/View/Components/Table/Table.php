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
        $this->headers = $this->formatHeaders($headers);
        $this->footers = $footers;
        $this->class = $class;
    }
    
    private function formatHeaders(array $headers) : array{
        return array_map(function( $header ) {
            $name = is_array($header) ? $header['name'] : $header;
            $class = is_array($header) ? $header['class'] : '';
            
            return ['name' => $name, 'class' => $class];
        }, $headers);
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
