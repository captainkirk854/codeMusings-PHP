
Pre-requisites:
    o A pre-configured PHP Package/environment (e.g. Aprelium PHP 5.6.11)
    o Latest Java Runtime 8.6.0 (http://www.oracle.com/technetwork/java/javase/downloads/jre8-downloads-2133155.html)
    o Browser such as Firefox

Installation:
    o Composer
        -> set up composer.json
        -> get composer.phar (https://getcomposer.org/composer.phar)
        -> download to project $root
        -> Initialise PHP environment
        -> php composer.phar install
            -> this will create a vendor subdirectory full of goodies
            -> may get a "failed to download facebook/webdriver" failed to clone git repository error

    o Selenium Server Executable
        -> download from https://selenium.googlecode.com/files/selenium-server-standalone-2.37.0.jar
    
    o Facebook Webdriver
        -> Ensure this exists in (for firefox): ..vendor\facebook\webdriver\lib\firefox
 
 Getting going:
    > Set up your PHP environment
    > PHPUnit is path'd to . vendor/bin/phpunit
    > Launch Selenium Server executable: java -jar selenium-server-standalone-2.37.0.jar
        This provides the interface at localhost:4444/wd/hub
    
 Writing Tests:
    <?php

        require '/path/to/php-webdriver/__init__.php'; # this line is crucial

        $webdriver = new WebDriver();

        $session = $webdriver->session('opera', array());
        $session->open("http://mysite.com");
        $button = $session->element('id', 'my_button_id');
        $button->click();
        $session->close();
    ?>
    
 Guides:
    http://codeception.com/11-12-2013/working-with-phpunit-and-selenium-webdriver.html
    http://stackoverflow.com/questions/4206547/selenium-2-webdriver-and-phpunit