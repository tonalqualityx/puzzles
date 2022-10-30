<?php
/**
 * Ottendorf Cypher
 * 
 * Description: takes a chunk of text and a solution,
 * then creates an encoded puzzle based on the text
 * 
 * }
 */
class Ottendorf extends Puzzle 
{

    public array $map;
    public array $cypher = array();
    private array $ignore = array(',', '.', "'", '?' );

    
    // TODO document this function
    function map_document()
    {

        // TODO add cache check here if you so desire

        // Take care of it if we done messed up
        if( !is_array( $this->clue ) || !is_string($this->solution) ){
            error_log('Ottendorf clue should be an array and solution should be a string' );

            return false;
        }

        $clue = $this->clue;

        // Check if this is case sensitive
        if( !$this->isCaseSensitive() ){
            $clue = array_map( 'strtolower', $clue );
        }

        // People aren't zero based, so we've got to start the line at 1
        $li = 1;

        //Loop through each line
        foreach( $clue as $line ){
            $w = 1;

            //Split each line into words
            $words = explode(' ', $line );

            foreach( $words as $word ){

                $l = 1;
                $word = str_split( $word );

                foreach( $word as $letter ) {
                    if( !in_array( $letter, $this->ignore )) {

                        $this->map[$letter][] = "$li-$w-$l";
                    }
                    $l++;
                }

                $w++;
            }

            $li++;
        }

        // TODO save to cache here if you so desire
        return true;

    }

    // TODO document this function
    public function create_cypher( $cache_name = null ){

        if( $cache_name){
            
            // TODO check for cached version

        }

        $map = $this->map;
        $solution = $this->solution;

        if( !$this->isCaseSensitive() ){
            $solution = strtolower( $solution );
        }

        // Break out solution into words
        $solution = explode( " ", $solution );

        $i = 0;
        
        foreach( $solution as $word ){

            
            $word = str_split($word);
            
            foreach( $word as $letter ){

                // check letter exists in array
                if( !isset( $map[$letter] )){
    
                    error_log("OTTENDORF letter " . $letter . " doesn't exist in map. Add more lines or change the solution" );
    
                    return false;
    
                }
    
                // get randomized location from array & add to cypher
                $c = count( $map[$letter]);
                $this->cypher[$i][] = $map[$letter][rand( 0, $c - 1)];
    
            }

            $i++; //increment the word
        }

    }

    public function print_cypher(){
        
        $cypher = $this->cypher;

        ob_start();

        foreach( $cypher as $line ) { ?>

            <div style="display: flex; justify-content: flex-start; max-width: 500px; margin: 8px auto;">
                <?php 
                    foreach( $line as $code ) { ?>

                        <div style="display: flex; flex-direction: column; margin-right: 8px;">
                            <input type="text" style="width: 44px;">
                            <span><?php echo $code; ?></span>
                        </div>

                    <?php }
                ?>
            </div>

        <?php }
    }

    // TODO document this function (just a helper... should it go in puzzle?)
    private function isCaseSensitive()
    {
        if( !isset($this->options['case-sensitive']) || !$this->options['case-sensitive'] ){
            return false;
        } else {
            return true;
        }
    }


}