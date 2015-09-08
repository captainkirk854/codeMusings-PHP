<?php
	class RemoteConnect
	{
	  public function ConnectToServer($serverName = null)
	  {
	    if($serverName==null)
		{
	      throw new Exception("That is not a server name!");
        }
        
        # Open socket to server ..
        $fp = fsockopen($serverName, 80);
        
        # Return true/false depending on connection success ...
        return ($fp) ? true : false;
      }

      public function ReturnSampleObject()
      {
        return $this;
      }
    }
    
    class Money
    {
        private $amount;
        
        public function __construct($amount)
        {
            $this->amount = $amount;
        }
        
        public function GetAmount()
        {
            return $this->amount;
        }
        
        public function MakeNegativeCopy()
        {
            return new Money (-1 * $this->amount);
        }
    }
?>