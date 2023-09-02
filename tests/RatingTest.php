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
        // assuming a constant of 32.
        
        // initialize basic team ratings.
        $teamRY = new Team(1500, 1520);
        $teamBG = new Team(1580, 1600);
        
        $expectedA = $rating->expectedOutcome($teamRY->averageRating(), $teamBG->averageRating());
        $expectedB = $rating->expectedOutcome($teamBG->averageRating(), $teamRY->averageRating());
        
        $expectedWinRYCol1 = 1519.6203782449;
        $expectedWinRYCol2 = 1539.6203782449;
        
        $expectedLossBGCol1 = 1560.3796217551;
        $expectedLossBGCol2 = 1580.3796217551;
        
        $actualScoreA = 1;
        $actualScoreB = 0;

        $teamRY->updatePlayers($actualScoreA, $expectedA, $rating);
        $teamBG->updatePlayers($actualScoreB, $expectedB, $rating);
        
        $this->assertEquals($expectedWinRYCol1, $teamRY[0]);
        $this->assertEquals($expectedWinRYCol2, $teamRY[1]);
        
        $this->assertEquals($expectedLossBGCol1, $teamBG[0]);
        $this->assertEquals($expectedLossBGCol2, $teamBG[1]);
        
        // now calculate team RY loss.
        $teamRY = new Team(1500, 1520);
        $teamBG = new Team(1580, 1600);
        
        $actualScoreA = 0;
        $actualScoreB = 1;
        
        $expectedWinBGCol1 = 1487.6203782449;
        $expectedWinBGCol2 = 1507.6203782449;
        
        $expectedLossRYCol1 = 1592.3796217551;
        $expectedLossRYCol2 = 1612.3796217551;

        $teamRY->updatePlayers($actualScoreA, $expectedA, $rating);
        $teamBG->updatePlayers($actualScoreB, $expectedB, $rating);

        $this->assertEquals($expectedLossRYCol1, $teamRY[0]);
        $this->assertEquals($expectedLossRYCol2, $teamRY[1]);
        
        $this->assertEquals($expectedWinBGCol1, $teamBG[0]);
        $this->assertEquals($expectedWinBGCol2, $teamBG[1]);

        // now calculate draws.
        $teamRY = new Team(1500, 1520);
        $teamBG = new Team(1580, 1600);
        
        $actualScoreA = 0.5;
        $actualScoreB = 0.5;
        
        $expectedDrawBGCol1 = 1503.6203782449;
        $expectedDrawBGCol2 = 1523.6203782449;
        
        $expectedDrawRYCol1 = 1576.3796217551;
        $expectedDrawRYCol2 = 1596.3796217551;

        $teamRY->updatePlayers($actualScoreA, $expectedA, $rating);
        $teamBG->updatePlayers($actualScoreB, $expectedB, $rating);

        $this->assertEquals($expectedDrawRYCol1, $teamRY[0]);
        $this->assertEquals($expectedDrawRYCol2, $teamRY[1]);
        
        $this->assertEquals($expectedDrawBGCol1, $teamBG[0]);
        $this->assertEquals($expectedDrawBGCol2, $teamBG[1]);
        
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