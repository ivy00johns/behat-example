Feature: Admin Login Page
  In order to access the Admin area
  As an Admin
  I need to be able to the Admin Login page

  @javascript
  Scenario Outline: You should NOT be able to access any Admin page directly when NOT logged in
    Given I am on the Admin Login page
    When I go to <target>
    Then I should be on the Admin Login page

    Examples:
      | target                             |
      | "/admin/admin/dashboard/"          |
      | "/admin/sales/order/"              |
      | "/admin/paypal/billing_agreement/" |
      | "/admin/catalog/product/"          |
      | "/admin/search/term/index/"        |

  @javascript
  Scenario: You should be able to Login
    Given I am on the Admin Login page
    And I login as an existing Admin
    Then I should be on the Admin Dashboard page

  @javascript
  Scenario: You should be able to Logout
    Given I am on the Admin Login page
    And I login as an existing Admin
    When I go to the Admin Logout page
    Then I should be on the Admin Login page

  @javascript
  Scenario: You should NOT be able to access an Admin page directly after Logging Out
    Given I am on the Admin Login page
    And I login as an existing Admin
    And I go to the Admin Logout page
    When I go to the Admin Dashboard page
    Then I should be on the Admin Login page