<?php

	class player{

		var $name;
		var $team;
		
		function __construct($name) {
		    $this->name = $name;
		}

        public function getName(){
            return $this->name;
        }

        public function getTeam(){
            return $this->team;
        }

        public function setTeam($team){
            $this->team = $team;
        }    	
	}
?>