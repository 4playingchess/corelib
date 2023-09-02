<?php

namespace FourPlayingChess\CoreLib;

class Team
{
    /** @var array $players Lists all the players. */
    private array $players = [];

    /**
     * Constuct a new team with ratings.
     *
     * @param float $ratingA The rating A.
     * @param float $ratingB The rating B.
     *
     * @return void Returns nothing.
     */
    public function __construct(float $ratingA, float $ratingB)
    {
        $this->players[] = $ratingA;
        $this->players[] = $ratingB;
    }

    /**
     * Get the average rating of both players.
     *
     * @return float Returns the average rating of both players.
     */
    public function averageRating()
    {
        return array_sum($this->players) / count($this->players);
    }

    /**
     * Update the players ratings.
     *
     * @param float                            $actualScore   The actual score.
     * @param flaot                            $expectedScore The expected score.
     * @param \FourPlayingChess\CoreLib\Rating $rating        The rating adjuster.
     *
     * @return void Returns nothing.
     */
    public function updatePlayers(float $actualScore, float $expectedScore, Rating $rating): void
    {
        foreach ($this->players as &$playerRating) {
            $playerRating = $rating->updateRating($playerRating, $actualScore, $expectedScore);
        }
    }

    /**
     * Get the current player ratings.
     *
     * @return array Returns a list of all players.
     */
    public function getPlayers()
    {
        return $this->players;
    }
}