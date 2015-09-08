<?php

	/*
		Run: 
			o Ensure Java Selenium Server is running in background (java -jar selenium-server-standalone-2.37.0.jar)
			o phpunit seleniumGitHubTest.php
	*/
	require 'D:\Program Files\PHPUNIT\selenium\vendor\facebook\webdriver\lib\__init__.php';

	class GitHubTest extends PHPUnit_Framework_TestCase 
	{  
		## @var \RemoteWebDriver'	
		protected $webDriver;

		public function setUp()
		{
			$capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
			$this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
		}
		
		# Shutdown browser after test ..
		public function tearDown()
		{
	## fatal error when calling this		$this->webDriver->close();
		}

		protected $url = 'https://github.com';

		public function testGitHubHome()
		{
			$this->webDriver->get($this->url);
	 
			// checking that page title contains word 'GitHub'
			$this->assertContains('GitHub', $this->webDriver->getTitle());
		}
		
		public function testSearch()
		{
			$this->webDriver->get($this->url);
			
			// find search field by its id
			$search = $this->webDriver->findElement(WebDriverBy::id('js-command-bar-field'));
			$search->click();
			
			// typing into field
			$this->webDriver->getKeyboard()->sendKeys('php-webdriver');
			
			// pressing "Enter"
			$this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
			
			$firstResult = $this->webDriver->findElement(
				// some CSS selectors can be very long:
				WebDriverBy::cssSelector('li.public:nth-child(1) > h3:nth-child(3) > a:nth-child(1) > em:nth-child(2)')
			);
			
			$firstResult->click();
			
			// we expect that facebook/php-webdriver was the first result
			$this->assertContains("php-webdriver",$this->webDriver->getTitle());
			
			// checking current url
			$this->assertEquals(
				'http://github.org/facebook/php-webdriver', 
				$this->webDriver->getCurrentURL()
			);
		}


		protected function waitForUserInput()
		{
			if(trim(fgets(fopen("php://stdin","r"))) != chr(13)) return;
		}
		
	}
?>