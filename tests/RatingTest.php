<?php

namespace Tests;

use FourPlayingChess\CoreLib\Rating;
use FourPlayingChess\CoreLib\Team;

class RatingsTest extends TestCase
{
    /** @test */
    public function ratings_do_update_correctly()
    {
        // expected constant k factor.
        int $k_factor = 32; // for testing.
        
        // initialize basic team ratings.
        $teamRY = new Team(1500, 1520);
        $teamBG = new Team(1580, 1600);
        
        
        // initialize basic team ratings.
        // attempt 2 with new data.
        $teamRY = new Team(1845, 2334);
        $teamBG = new Team(1700, 1978);
        
        // initialize basic team ratings.
        // attempt 3 with new data.
        $teamRY = new Team(1845, 2334);
        $teamBG = new Team(1700, 1978);
        
    }
}