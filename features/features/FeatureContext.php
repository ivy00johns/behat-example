<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\MinkExtension\Context\RawMinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    //
    // Place your definition and hook methods here:
    //
    //    /**
    //     * @Given /^I have done something with "([^"]*)"$/
    //     */
    //    public function iHaveDoneSomethingWith($argument)
    //    {
    //        doSomethingWith($argument);
    //    }
    //

    /**
     * @BeforeStep
     */
    public function beforeStep()
    {
        $this->getSession()->resizeWindow(1440, 900, 'current');
    }

    /**
     * @When /^I go to Google$/
     */
    public function iGoToGoogle()
    {
        $session = $this->getSession();
        $session->visit('https://www.google.com/');
    }

    /**
     * @Given /^I go to the local Admin Login page$/
     */
    public function iGoToTheLocalAdminLoginPage()
    {
        $session = $this->getSession();
        $session->visit('http://127.0.0.1:32769/admin/admin/');
    }

}
