<?php

// Sample WebDriver code - search Google for "Selenium is awesome" and take
// a screenshot.

// You need three things to run this code:
// 1. A copy of chromedriver (from the Selenium downloads.)
// 2. The standalone Selenium server v2.0 running with
//    -Dwebdriver.chrome.driver=${PATH_TO_CHROMEDRIVER}
// 3. A copy of http://code.google.com/p/php-webdriver-bindings/ checked out.

require_once "..phpwebdriver/WebDriver.php";

$timestamp = time();

$browsers = array("chrome", "firefox");

foreach($browsers as $browser) {
  $webdriver = new WebDriver("localhost", "4444");
  $webdriver->connect($browser);
  $webdriver->get("http://google.com");
  $element = $webdriver->findElementBy(LocatorStrategy::name, "q");
  $element->sendKeys(array("selenium is awesome"));
  $element->submit();

  sleep(2);

  $webdriver->getScreenshotAndSaveToFile("the_google_${browser}_${timestamp}.png");
  $webdriver->close();
}

