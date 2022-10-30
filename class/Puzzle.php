<?php

class Puzzle{

    // Props
    protected $clue;
    protected $solution;
    protected $options;

    function __construct( $clue, $solution, $options = array() )
    {
        $this->clue = $clue;
        $this->solution = $solution;
        $this->options = $options;

    }

    public function check_solution( $proposed )
    {
        // TODO scrub $proposed
        return $proposed == $this->solution;
    }

    public function print_clue()
    {
        echo $this->clue;
    }
}