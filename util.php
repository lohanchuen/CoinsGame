<?php
    function createPlayers($numberOfPlayers){
        //return an array with all the players created
        $players = array();
        for($i=0; $i<$numberOfPlayers; $i++){   // the quantity of created members depends of $numberOfPlayers
            $playerNumber = $i+1;
            $players[$i] = new player("player".$playerNumber);
        }
        return $players;
    }
    
    function printPlayersNames($players){
        // print all the players
        for($i=0; $i<count($players); $i++){    //loop to print all the players names
            echo $players[$i]->name."<br>";
        }
    }

    function createTeams($teamsNames,$victoriesTempArray){
        //return an array with all the teams created
        $teams = array();
        for($i=0; $i<count($teamsNames); $i++){
            $teams[$i] = new team($teamsNames[$i],$teamsNames[$i],$victoriesTempArray);
        }
        return $teams;
    }
    
    function printTeamsNames($teams){
        // print all the teams
        for($i=0; $i<count($teams); $i++){
            echo $teams[$i]->name . "<br>";
        }
    }
    
    function assignPlayearsToTeams($teams,$tempPlayersArray){
        $j=0;
        for($i=0;count($tempPlayersArray)>0;$i++){
            //to generate the random index to get a player
            $randomPlayerPosition = rand(0,count($tempPlayersArray)-1);
            $teams[$j]->addPlayer( $tempPlayersArray[$randomPlayerPosition] );
            //deleting the added player from the array to avoid duplicate the player in another team
            array_splice($tempPlayersArray,$randomPlayerPosition,1);
            $j++;
            if($j==count($teams)){  //moving to the next team
                $j=0;
            }
        }
    }
    
    function printTeamMembers($teams){
        // print all the teams and its members
        for($i=0;$i<count($teams);$i++){    // looping the teams
            echo "<b>".$teams[$i]->getName()."</b><br>";
            for($j=0;$j<count( $teams[$i]->getPlayers());$j++){ // looping the names
                echo  $teams[$i]->getPlayers()[$j]->getName()."<br>";
            }
        }	
    }

    function existPreviousMatch($existingMatches,$firstPlayer,$secondPlayer){
        // to verify if the couple has played before
        $result = false;        
        for($i=0;$i<count($existingMatches);$i++){  // looping in the previous matches couples          
            if( ($existingMatches[$i][0]==$firstPlayer && $existingMatches[$i][1]==$secondPlayer) 
                || ($existingMatches[$i][0]==$secondPlayer && $existingMatches[$i][1]==$firstPlayer) ){
                // in case both players has been played together before
                $result = true;
            }
        }        
        return $result;
    }
    
    function assignVictoryToWinnerTeam($teams,$nameWinnerTeam,$r){
        // to identify the proper team to assign the victory
        $notFound = true;
        for($i=0;$i<count($teams) && $notFound;$i++){
            if($teams[$i]->getName() == $nameWinnerTeam){
                $teams[$i]->addVictory($r-1);
                $notFound = false;
            }
        }
    }
    
    function printRoundSummary($teams,$r){
        // to print the summary round
        for($i=0;$i<count($teams); $i++){
            echo $teams[$i]->getName()." won ".$teams[$i]->getVictories($r-1)." times.<br>";
        }
    }

?>