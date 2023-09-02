<?php

namespace FourPlayingChess\CoreLib;

class Rating
{
    /**
     * Get the expected outcome of the player.
     *
     * @param float $ratingA The rating A.
     * @param float $ratingA The rating B.
     *
     * @return float Returns the expected outcome.
     */
    public function expectedOutcome(float $ratingA, float $ratingB): float
    {
        return 1 / (1 + pow(10, ($ratingB - $ratingA) / 400));
    }

    /**
     * Update the users rating based on the outcome.
     *
     * @param float $currentRating The current rating.
     * @param float $actualScore   The actual score.
     * @param float $expectedScore The expected score.
     *
     * @return float Returns the new rating the player gets.
     */
    public function updateRating(float $currentRating, float $actualScore, float $expectedScore): float
    {
        return $currentRating + config('corelib.k_factor') * ($actualScore - $expectedScore);
    }
}