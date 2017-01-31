Feature: Admin Side Navigation Menu
  In order to access different Admin pages
  As an Admin
  I need to be able to navigate using the Side Navigation Menu

  @javascript
  Scenario: You should be able to access the Dashboard page
    Given I am logged in as an Admin
    When I click on "DASHBOARD" in the Side Nav Menu
    Then I should be on the Admin Dashboard page

  @javascript
  Scenario: You should be able to access the SALES pages
    Given I am logged in as an Admin
    When I click on "SALES" in the Side Nav Menu
    Then I should see the SALES nav menu

  @javascript
  Scenario: You should be able to access the PRODUCT pages
    Given I am logged in as an Admin
    When I click on "PRODUCTS" in the Side Nav Menu
    Then I should see the PRODUCTS nav menu

  @javascript
  Scenario: You should be able to access the CUSTOMER pages
    Given I am logged in as an Admin
    When I click on "CUSTOMERS" in the Side Nav Menu
    Then I should see the CUSTOMERS nav menu

  @javascript
  Scenario: You should be able to access the MARKETING pages
    Given I am logged in as an Admin
    When I click on "MARKETING" in the Side Nav Menu
    Then I should see the MARKETING nav menu

  @javascript
  Scenario: You should be able to access the CONTENT pages
    Given I am logged in as an Admin
    When I click on "CONTENT" in the Side Nav Menu
    Then I should see the CONTENT nav menu

  @javascript
  Scenario: You should be able to access the REPORTS pages
    Given I am logged in as an Admin
    When I click on "REPORTS" in the Side Nav Menu
    Then I should see the REPORTS nav menu

  @javascript
  Scenario: You should be able to access the STORES pages
    Given I am logged in as an Admin
    When I click on "STORES" in the Side Nav Menu
    Then I should see the STORES nav menu

  @javascript
  Scenario: You should be able to access the SYSTEM pages
    Given I am logged in as an Admin
    When I click on "SYSTEM" in the Side Nav Menu
    Then I should see the SYSTEM nav menu

  @javascript
  Scenario: You should be able to access the FIND PARTNERS & EXTENSIONS
    Given I am logged in as an Admin
    When I click on "FIND PARTNERS & EXTENSIONS" in the Side Nav Menu
    Then I should be on the Admin Marketplace page