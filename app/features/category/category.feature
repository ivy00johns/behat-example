Feature: Category Add/Edit Page
  In order to Add or Edit a Category
  As an Admin
  I need access to the Category Add/Edit page

  @javascript @wip
  Scenario: You should land on the Category Add page
    Given I am logged in as an Admin
    When I go to the Add Category page
    Then I should be on the Add Category page

  @javascript @wip
  Scenario: You should be able to fill in Category Detail fields
    Given I am logged in as an Admin
    And I go to the Add Category page
    When I fill in the Category Name with "RootCategory123"
    And I click on the Save button
    Then the Category Title should be "RootCategory123"