<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Coin Game</title>
</head>
<body>

	<h2>Players</h2>
	
    <?php
        include ('parameters.php');
        include ('util.php');
    	include ('player.php');
    	include ('team.php');
    	include ('match.php');
    	
    	// to create players
    	$players = createPlayers($numberOfPlayers);
    	$tempPlayersArray =$players;
    	printPlayersNames($players);
    ?>
    
    <h2>Teams' names</h2>
       
    <?php
        $victoriesTempArray;
        for($i=0;$i<$rounds+1;$i++){
            $victoriesTempArray[$i]=0;
        }
        // to create teams;
        $teams = createTeams($teamsNames,$victoriesTempArray);
    	// to print the teams' names
    	printTeamsNames($teams);    	
    ?>
       
    <h2>Team members</h2>
     
	<?php
	   //to assign players to each team
	   assignPlayearsToTeams($teams,$tempPlayersArray);
	   // to print the team members names
	   printTeamMembers($teams);	
    ?>
    
    <h2>Rounds</h2>   
     
    <?php

         $totalPlayers = count($players);
         $existingMatches[0][0] = null;
        
         for($r=1; $r<$rounds+1; $r++){    // loop for each round
            
    	    echo "<h3>Round ".$r."</h3><br>";
    	    
    	    $indexTeam = 0;
    	    $fp = 0;
    	    
    	    for($indexAllPlayers=0; $indexAllPlayers<$totalPlayers; $indexAllPlayers++){ //loop to select the first player    	        
    	        $firstPlayerTemp =  $teams[$indexTeam]->getPlayers()[$fp]->getName();
    	        $nameWinnerTeam = $teams[$indexTeam]->getName();
    	        
    	        $teamsTemp = $teams;
    	        array_splice($teamsTemp,$indexTeam,1); // deleting the firstPlayer's team
    	            	        
    	        $fp++;
    	        if( $fp == count( $teams[$indexTeam]->getPlayers()) ){ // moving the index at the next team
    	            $indexTeam++;
                    $fp=0;
    	        }
                
    	        do{
                    $randomTeamPosition = rand(0,count($teamsTemp)-1); //getting a random team
    	            $randomPlayerPosition = rand(0,count($teamsTemp[$randomTeamPosition]->getPlayers())-1);   //getting a random player
    	            $secondPlayerTemp =  $teamsTemp[$randomTeamPosition]->getPlayers()[$randomPlayerPosition]->getName();     
                    $existPreviousMatch = existPreviousMatch($existingMatches,$firstPlayerTemp,$secondPlayerTemp);
    	        }while ($existPreviousMatch);
	        
    	        echo $firstPlayerTemp." Vs ".$secondPlayerTemp;
    	        
    	        $match = new match($firstPlayerTemp, $secondPlayerTemp);
    	        $resultMatch = $match->getResultMatch();
    	        echo ". Result : ".$resultMatch[0]." is the winner.";
    	        
    	        if( $resultMatch[1] == 2){
    	            $nameWinnerTeam = $teamsTemp[$randomTeamPosition]->getName();
    	        }
    	        echo " One victory for the ".$nameWinnerTeam." team.<br>";
    	        
    	        assignVictoryToWinnerTeam($teams,$nameWinnerTeam,$r);
    	              
    	        $existingMatches[$indexAllPlayers][0] = $firstPlayerTemp;
    	        $existingMatches[$indexAllPlayers][1] = $secondPlayerTemp;    	        
    	    }
    	    echo "<h3><n>Sumary results Round ".$r.":</n><br></h3>";
    	    printRoundSummary($teams,$r);
    	}
    	
    ?>	
</body>
</html>