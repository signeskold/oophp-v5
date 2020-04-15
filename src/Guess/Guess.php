<?php

namespace Sisl\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */

class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var int $found    1 if secret number is found, else 0.
     */

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     * @param int $found  1 if secret number is found, else 0,
     *                    default 0.
     */

    public function __construct(int $number = -1, int $tries = 6, int $found = 0)
    {
        if ($number === -1) {
            $number = rand(1, 100);
        }
        $this->number = $number;
        $this->tries  = $tries;
        $this->found  = $found;
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }

    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }

    /**
     * Get information whether number is found.
     *
     * @return int 1 if found, else 0.
     */

    public function found()
    {
        return $this->found;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess(int $number)
    {
         $this->tries--;

        try {
            if (!(is_int($number) && $number >= 1 && $number <= 100)) {
                 throw new GuessException("Guessed number is out of bounds (1-100).");
            } elseif ($this->tries == 0) {
                 return "No guesses remain; you have lost the game! The secret number was $this->number.";
            } elseif ($number < $this->number) {
                 return "Guessed number $number is too low.";
            } elseif ($number > $this->number) {
                 return "Guessed number $number is too high.";
            } else {
                 $this->found = 1;
                 return "Guessed number $number is correct; congratulations!";
            }
        } catch (GuessException $e) {
             return "GuessException: " . $e->getMessage();
        }
    }
}
