# Welcome to the example Behat based Test Suite!

## Prereqs
* Behat is a PHP based application installed via Composer so you will need to have Composer installed in order to run the following. Please visit the [Composer](https://getcomposer.org/) homepage for installation instructions.  

* The Test Suite needs to be configured in the `behat.yml` file and the `/app/features/bootstrap/FeatureContext.php` file before proceeding. In those files you can set the `base_url` for the Test Suite. Currently it points to the Docker instance of Magento Community if it is running locally.

### behat.yml

    ...
    
    base_url: "http://127.0.0.1:32769"
    
    ...


### FeatureContext.php
    ...
    
    $baseUrl = 'http://127.0.0.1:32769'
    
    ...




## Running the Tests
* Once you have Composer installed you will need to install the Project Dependencies. Open a Terminal Window. CD to the Project Directory and run the following command:
    ```
    cd [LOCATION_OF_GITHUB_REPO]
    composer install
    ```

* Next make sure Selenium WebDriver/ChromeDriver are up-to-date using the following command:
    ```
    webdriver-manager update
    ```

* Next you will need to start a WebDriver server so we can run the tests. Start the server using the following command:
    ```
    webdriver-manager start
    ```
    
* Open a New Terminal Window.

* Finally to kick off the entire E2E Test Suite run the following command:
    ```
    bin/behat
    ```

* To run a sub-set of Tests run one of the following commands (By Suite/Folder OR By Name OR By Tags):
    #### By Suite or Folder
    ```
     Setup:   bin/behat [PATH_TO_FOLDER]
     ```
     ```
     Example: bin/behat app/feature/samples
    ```
    
    #### By Name
    ```
    Setup:   bin/behat --name="[TEST_NAME_IS_CASE_SENSITIVE]"
    ```
    ```
    Example: bin/behat --name="Google"
    ```
    
    #### By Tag
    ```
    Setup:   bin/behat --tags="@[TAG_NAME_IS_CASE_SENSITIVE]"
    ```
    
    ```
    Example: bin/behat --tags="@google"
    ```