Feature: Testing Behat
  In order to build something
  As a Developer
  I need to test the tool out

  @javascript @google
  Scenario: Visit Google
  When I go to Google
  Then I should be on "https://www.google.com/"