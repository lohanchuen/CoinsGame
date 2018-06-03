<?php
    class match{
        var $firstPlayer;
        var $secondPlayer;
        
        function __construct($firstPlayer,$secondPlayer){
            $this->firstPlayer = $firstPlayer;
            $this->secondPlayer = $secondPlayer;
        }
        
        public function getFirstPlayer(){
            return $this->firstPlayer;
        }
       
        public function getSecondPlayer(){
            return $this->secondPlayer;
        }    
        
        public function getResultMatch(){            
            $randomWinnerPlayer = rand(1,2);        
            if($randomWinnerPlayer== 1){
                $result[0] = $this->firstPlayer;
                $result[1] = 1;
            }else{
                $result[0] = $this->secondPlayer;
                $result[1] = 2;
            }        
            return $result;
        }
    }
?>