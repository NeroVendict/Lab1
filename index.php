<!DOCTYPE html>
<html>
    <head>
        <title>Ramon Dhami A00761325 Set A</title>
    </head>
    <body>
        <?php
        // Determines whether the board is given or valid
        if (!isset($_GET['board'])) {
            echo "No board given. New game started. <br>";
            $squares = "---------";
        } else
            $squares = $_GET['board'];

        $game = new Game($squares);
        // Winner method
        if ($game->winner('x')) {
            echo 'You win. Lucky guesses!';
            
        } else if ($game->winner('o')) {
            echo 'I win. Muahahahaha';
            
        } else {
            $game->pick_move();
            echo 'No winner yet.';
        }
        // Calls display method so we can actually see the 3 by 3 squares
        $game->display();
        // Button to reset the game
        echo "<br> <a href='?'>Restart</a> <br>";

        class Game {

            // Board position property
            var $position;

            // Constructor to initialize position parameter
            function __construct($squares) {
                $this->position = str_split($squares);
            }

            // Method to determine winning conditions
            function winner($token) {
                $won = false;
                if (($this->position[0] == $token) &&
                        ($this->position[1] == $token) &&
                        ($this->position[2] == $token)) {
                    $won = true;
                } else if (($this->position[3] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[5] == $token)) {
                    $won = true;
                } else if (($this->position[6] == $token) &&
                        ($this->position[7] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[0] == $token) &&
                        ($this->position[3] == $token) &&
                        ($this->position[6] == $token)) {
                    $won = true;
                } else if (($this->position[1] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[7] == $token)) {
                    $won = true;
                } else if (($this->position[2] == $token) &&
                        ($this->position[5] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[0] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[2] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[6] == $token)) {
                    $won = true;
                }
                return $won;
            }

            //Generates an HTML table with three rows
            function display() {
                echo '<table cols="3" style="font-size:large; font-weight:bold">';
                echo '<tr>'; // open the first row
                for ($pos = 0; $pos < 9; $pos++) {
                    echo $this->show_cell($pos); // displays tokens according to positions
                    if ($pos % 3 == 2) {
                        echo '</tr><tr>'; //starts a new row for the next square
                    }
                }
                echo '</tr>'; // Close the last row
                echo '</table>'; 
            }

// method that shows a token in a spot or a hypen if there are none
            function show_cell($which) {

                // Retrieves the value to be displayed inside cell
                $token = $this->position[$which];

                //displays the value if it is not a dash
                if ($token <> '-') {
                    return '<td>' . $token . '</td>';
                }

                // When we click on the dash it will either display a 'X' or an 'O'

                $this->newposition = $this->position;
                $this->newposition[$which] = 'x';
                $move = implode($this->newposition); // transform the board array to string
                $link = '?board=' . $move; // Updates link after each move with the corresponding board           
                return '<td><a href=' . $link . '>-</a></td>'; // Return a cell containing an anchor and showing a hyphen
            }

            // this method represents a second player against you
            function pick_move() {
                // Picks square at random
                $fill = false;

                // sets value in square if the condition is empty 
                do {
                    $next = rand(0, 8);
                    if ($this->position[$next] == '-') {
                        $this->position[$next] = 'o';
                        $fill = true;
                    }
                } while (!$fill); // fill square once a legal move is found
            }

        }
        ?>

    </body>
</html>

