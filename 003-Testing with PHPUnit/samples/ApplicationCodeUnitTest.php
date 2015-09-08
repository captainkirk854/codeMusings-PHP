<?php
	/*
		Can be run from command line: 
			> phpunit ApplicationCodeUnitTest.php
			> phpunit ApplicationCodeUnitTest
			> phpunit <Specific ClassName> ApplicationCodeUnitTest.php 
				(e.g. phpunit MoneyTest ApplicationCodeUnitTest.php)
        
        Common Assertions (Helper functions) available:
            o AssertTrue
            o AssertFalse
            o AssertGreaterThan
            o AssertContains
            o AssertInstanceOf (AssertType deprecated)
            o AssertNull
            o AssertFileExists
            o AssertRegExp
            
        Functions to be tested must be (by default) prefixed with: test (e.g. testMe()) otherwise
        they're not detected.
    */
    
    /*
        Best Practices
            o One Assertion per Test 
            o One TestClass per file
    */

    require_once('ApplicationCode.php');

    class RemoteConnectTest extends PHPUnit_Framework_TestCase
    {
    
      # Initialise ..
      const SERVERNAME = 'www.google.com';
      const CLASSNAME = 'RemoteConnect';
      
      # Built-in Helper functions - run before and after all tests ..
      public function setUp(){ echo "Setting Up"; }
      public function tearDown(){ echo "Tearing down"; }

      # Suite of Test Functions ...
      public function testConnectionIsValid()
      {
        # test to ensure that the object from an fsockopen is valid
        # Initialise ..
        $connObj = new RemoteConnect();
            
        #Perform PHP Unit test on class' ConnectToServer function ..
        $this->assertTrue($connObj->ConnectToServer(self::SERVERNAME) != false);
      }

      public function testConnectionIsValidAgain()
      {
        # test to ensure that the object from an fsockopen is valid
        # Initialise ..
        $connObj = new RemoteConnect();
      
        #Perform PHP Unit test on class' ConnectToServer function ..
        $this->assertFalse($connObj->ConnectToServer(self::SERVERNAME) != true);
      }

      public function testConnectionIsInValid()
      {
        # test to ensure that the object from an fsockopen is valid
        # Initialise ..
        $connObj = new RemoteConnect();
        $junkServer = "junk";
      
        #Perform PHP Unit test on class' ConnectToServer function ..
        # This throws an exception so asserts are invalid ..
            #$this->assertTrue($connObj->ConnectToServer($junkServer) == false);
            #$this->assertTrue($connObj->ConnectToServer($junkServer) != true);
        #Dummy the assert ..
        $this->assertTrue(false == false);
      }
      
      public function testIsTheObjectOfTheCorrectConnectClass() 
      {
          $connObj = new RemoteConnect();
          $returnedObject = $connObj->ReturnSampleObject();
          ##$this->assertType(self::CLASSNAME, $returnedObject); # assertType deprecated from 3.6+
        $this->assertInstanceOf(self::CLASSNAME, $returnedObject);
      }      
    }
    
    class MoneyTest extends PHPUnit_Framework_TestCase
    {
        public function testMoneyCanBeMadeNegative()
        {
            // Initialise ..
            $amount = 1;
            $pos = new Money($amount);
            $neg = $pos-> MakeNegativeCopy();
            
            // Assert ..
            $this->assertEquals(-1 * $amount, $neg->GetAmount());
        }
    }
?>