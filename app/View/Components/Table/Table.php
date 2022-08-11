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
            $name = is_array($header) ? ($header['name'] ?? null) : $header;
            $class = is_array($header) ? ($header['class'] ?? null) : '';
            $link = is_array($header) ? ($header['link'] ?? null) : '';
            $sord = is_array($header) ? ($header['sord'] ?? null) : null;
            
            return ['name' => $name, 'class' => $class, 'link' => $link, 'sord' => $sord];
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
