Feature: Admin Login Page
  In order to access the Admin area
  As an Admin
  I need to be able to the Admin Login page

  @javascript @example
  Scenario Outline: You should NOT be able to access any Admin page directly when NOT logged in
    Given I go to the local Admin Login page
    When I go to <target>
    Then I should be on "/admin/admin/"

    Examples:
      | target                     |
      | "/admin/admin/dashboard/"  |
      | "/admin/sales/order/"      |
      | "/admin/sales/invoice/"    |
      | "/admin/sales/shipment/"   |
      | "/admin/sales/creditmemo/" |

  @javascript
  Scenario: You should be able to Login
    Given I go to the local Admin Login page
    When I fill in "Username" with "admin"
    And I fill in "Password" with "admin123"
    And I press "Sign in"
    Then I should be on "/admin/admin/dashboard/"

  @javascript
  Scenario: You should be able to Logout
    Given I go to the local Admin Login page
    When I fill in "Username" with "admin"
    And I fill in "Password" with "admin123"
    And I press "Sign in"
    And I go to "/admin/admin/auth/logout"
    Then I should be on "/admin/admin/"

  @javascript
  Scenario: You should NOT be able to access an Admin page directly after Logging Out
    Given I go to the local Admin Login page
    When I fill in "Username" with "admin"
    And I fill in "Password" with "admin123"
    And I press "Sign in"
    And I go to "/admin/admin/auth/logout"
    And I go to "/admin/admin/dashboard/"
    Then I should be on "/admin/admin/"