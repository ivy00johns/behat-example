Feature: Category Add/Edit Page
  In order to Add or Edit a Category
  As an Admin
  I need access to the Category Add/Edit page

  Scenario: You should be able to land on the Category Add page
    Given I go to "/admin/catalog/category/add/store/0/parent/1"
    Then I should be on "/admin/catalog/category/add/store/0/parent/1"

  Scenario: You should be able to fill in Category Detail fields
    Given I go to "/admin/catalog/category/add/store/0/parent/1"
    When I fill in "Category Name" with "RootCategory123"