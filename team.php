<?php
    class team{
        
        var $name;
        var $color;
        var $players;
        var $victories;
        
        function __construct($name, $color, $victories) {
            $this->name = $name;
            $this->color = $color;
            $this->players = array();
            $this->victories = $victories;
        }

        public function getPlayers(){
            return $this->players;
        }
        
        public function getName(){
            return $this->name;
        }

        public function addPlayer($playerToAdd){
            array_push($this->players, $playerToAdd);
        }

        public function getVictories($round){
            return $this->victories[$round];
        }
    
        public function addVictory($round){            
            $previousVictories = $this->victories[$round];            
            $this->victories[$round] = $previousVictories+1;
        }        
    }
?>