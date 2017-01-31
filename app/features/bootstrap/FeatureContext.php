<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use PHPUnit\Framework;

/**
 * Defines application features from the specific context.
 */

class FeatureContext extends RawMinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($baseUrl = 'http://127.0.0.1:32769')
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @BeforeStep
     */
    public function beforeStep()
    {
        $this->getSession()->resizeWindow(1440, 900, 'current');
    }

    public function __call($method, $parameters)
    {
        // we try to call the method on the Page first
        $page = $this->getSession()->getPage();
        if (method_exists($page, $method)) {
            return call_user_func_array(array($page, $method), $parameters);
        }

        // we try to call the method on the Session
        $session = $this->getSession();
        if (method_exists($session, $method)) {
            return call_user_func_array(array($session, $method), $parameters);
        }

        // could not find the method at all
        throw new \RuntimeException(sprintf(
            'The "%s()" method does not exist.', $method
        ));
    }

    /**
     * @Given /^I am on the Admin Login page$/
     */
    public function iAmOnTheAdminLoginPage()
    {
        $this->getSession()->visit($this->baseUrl . '/admin/admin/');
    }

    /**
     * @Given /^I go to the Admin Logout page$/
     */
    public function iGoToTheAdminLogoutPage()
    {
        $this->getSession()->visit($this->baseUrl . '/admin/admin/auth/logout/');
    }

    /**
     * @Given /^I go to the Admin Dashboard page$/
     */
    public function iGoToTheAdminDashboardPage()
    {
        $this->getSession()->visit($this->baseUrl . '/admin/admin/dashboard/');
    }

    /**
     * @Given I am logged in as an Admin
     */
    public function iAmLoggedInAsAnAdmin()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $session->visit($this->baseUrl . '/admin/admin/');

        $userName = $page->find('css', '#username');
        $password = $page->find('css', '#login');
        $signIn = $page->find('css', '.action-login');

        $userName->setValue('admin');
        $password->setValue('admin123');
        $signIn->click();
    }


    /**
     * @When /^I go to Google$/
     */
    public function iGoToGoogle()
    {
         $this->getSession()->visit('https://www.google.com/');
    }

    /**
     * @When /^I login as an existing Admin$/
     */
    public function iLoginAsAnExistingAdmin()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $userName = $page->find('css', '#username');
        $password = $page->find('css', '#login');
        $signIn = $page->find('css', '.action-login');

        $userName->setValue('admin');
        $password->setValue('admin123');
        $signIn->click();
    }

    /**
     * @When I go to the Add Category page
     */
    public function iGoToTheAddCategoryPage()
    {
        $this->getSession()->visit($this->baseUrl . '/admin/catalog/category/add/store/0/parent/1');
    }



    /**
     * @Then /^I should be on the Admin Login page$/
     */
    public function iShouldBeOnTheAdminLoginPage()
    {
        $this->assertSession()->addressEquals($this->baseUrl . '/admin/admin/');
    }

    /**
     * @Then /^I should be on the Admin Dashboard page$/
     */
    public function iShouldBeOnTheAdminDashboardPage()
    {
        $this->assertSession()->addressEquals($this->baseUrl . '/admin/admin/dashboard/');
    }

    /**
     * @Then I should be on the Add Category page
     */
    public function iShouldBeOnTheAddCategoryPage()
    {
        $this->assertSession()->addressEquals($this->baseUrl . '/admin/catalog/category/add/store/0/parent/1');
    }


    /**
     * @When I click on the Save button
     */
    public function iClickOnTheSaveButton()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $saveButton = $page->find('css', '#save');
        $saveButton->click();
    }

    /**
     * @Then the Category Title should be :arg1
     */
    public function theCategoryTitleShouldBe($arg1)
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $title = $page->find('css', '.page-title')->getValue();
    }

    /**
     * @When I fill in the Category Name with :arg1
     */
    public function iFillInTheCategoryNameWith($arg1)
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $categoryNameField = $page->find('css', '.admin__field[data-index="name"] input');
    }

    /**
     * @When I click on :arg1 in the Side Nav Menu
     */
    public function iClickOnInTheSideNavMenu($arg1)
    {
        $session = $this->getSession();
        $page = $session->getPage();

        if (strpos($arg1, 'DASHBOARD') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-backend-dashboard')->click();
        } else if (strpos($arg1, 'SALES') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-sales-sales')->click();
        } else if (strpos($arg1, 'PRODUCTS') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-catalog-catalog')->click();
        } else if (strpos($arg1, 'CUSTOMERS') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-customer-customer');
            $mainNavButton->mouseOver();
            $mainNavButton->click();
        } else if (strpos($arg1, 'MARKETING') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-backend-marketing')->click();
        } else if (strpos($arg1, 'CONTENT') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-backend-content')->click();
        } else if (strpos($arg1, 'REPORTS') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-reports-report')->click();
        } else if (strpos($arg1, 'STORES') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-backend-stores')->click();
        } else if (strpos($arg1, 'SYSTEM') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-backend-system')->click();
        } else if (strpos($arg1, 'FIND PARTNERS & EXTENSIONS') > -1) {
            $mainNavButton = $page->find('css', '#menu-magento-marketplace-partners')->click();
        }
    }

    /**
     * @Then I should see the SALES nav menu
     */
    public function iShouldSeeTheSalesNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $salesNavMainArea          = $page->find('css', '.item-sales-operation.parent');
        $salesNavTitle             = $page->find('css', '.item-sales-operation .submenu-group-title');

        $salesNavOrders            = $page->find('css', '.item-sales-order');
        $salesNavInvoices          = $page->find('css', '.item-sales-invoice');
        $salesNavShipments         = $page->find('css', '.item-sales-shipment');
        $salesNavCreditMemos       = $page->find('css', '.item-sales-creditmemo');
        $salesNavBillingAgreements = $page->find('css', '.item-paypal-billing-agreement');
        $salesNavTransactions      = $page->find('css', '.item-sales-transactions');

        PHPUnit\Framework\Assert::assertTrue($salesNavMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($salesNavTitle->isVisible());

        PHPUnit\Framework\Assert::assertTrue($salesNavOrders->isVisible());
        PHPUnit\Framework\Assert::assertTrue($salesNavInvoices->isVisible());
        PHPUnit\Framework\Assert::assertTrue($salesNavShipments->isVisible());
        PHPUnit\Framework\Assert::assertTrue($salesNavCreditMemos->isVisible());
        PHPUnit\Framework\Assert::assertTrue($salesNavBillingAgreements->isVisible());
        PHPUnit\Framework\Assert::assertTrue($salesNavTransactions->isVisible());
    }

    /**
     * @Then I should see the PRODUCTS nav menu
     */
    public function iShouldSeeTheProductsNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $productsNavMainArea   = $page->find('css', '.item-inventory.parent');
        $productsNavTitle      = $page->find('css', '.item-inventory .submenu-group-title');

        $productsNavCatalog    = $page->find('css', '.item-catalog-products');
        $productsNavCategories = $page->find('css', '.item-catalog-categories');

        PHPUnit\Framework\Assert::assertTrue($productsNavMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($productsNavTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($productsNavCatalog->isVisible());
        PHPUnit\Framework\Assert::assertTrue($productsNavCategories->isVisible());
    }

    /**
     * @Then I should see the CUSTOMERS nav menu
     */
    public function iShouldSeeTheCustomersNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $allCustomers = $page->find('css', '.item-customer-manage');
        $nowOnline    = $page->find('css', '.item-customer-online');

        PHPUnit\Framework\Assert::assertTrue($allCustomers->isVisible());
        PHPUnit\Framework\Assert::assertTrue($nowOnline->isVisible());
    }

    /**
     * @Then I should see the MARKETING nav menu
     */
    public function iShouldSeeTheMarketingNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $marketingNavPromotionsMainArea                  = $page->find('css', '.item-promo.parent');
        $marketingNavPromotionsTitle                     = $page->find('css', '.item-promo .submenu-group-title');
        $marketingNavPromotionsCatalogPriceRule          = $page->find('css', '.item-promo-catalog');
        $marketingNavPromotionsCartPriceRules            = $page->find('css', '.item-promo-quote');

        $marketingNavCommunicationsMainArea              = $page->find('css', '.item-marketing-communications.parent');
        $marketingNavCommunicationsTitle                 = $page->find('css', '.item-marketing-communications .submenu-group-title');
        $marketingNavCommunicationsEmailTemplates        = $page->find('css', '.item-template');
        $marketingNavCommunicationsNewsletterTemplate    = $page->find('css', '.item-newsletter-template');
        $marketingNavCommunicationsNewsletterQueue       = $page->find('css', '.item-newsletter-queue');
        $marketingNavCommunicationsNewsletterSubscribers = $page->find('css', '.item-newsletter-subscriber');

        $marketingNavSEOSearchMainArea                   = $page->find('css', '.item-marketing-seo.parent');
        $marketingNavSEOSearchTitle                      = $page->find('css', '.item-marketing-seo .submenu-group-title');
        $marketingNavSEOSearchURLRewrites                = $page->find('css', '.item-urlrewrite');
        $marketingNavSEOSearchTerms                      = $page->find('css', '.item-search-terms');
        $marketingNavSEOSearchSynonyms                   = $page->find('css', '.item-search-synonyms');
        $marketingNavSEOSearchSiteMap                    = $page->find('css', '.item-catalog-sitemap');

        $marketingNavUserContentMainArea                 = $page->find('css', '.item-marketing-user-content.parent');
        $marketingNavUserContentTitle                    = $page->find('css', '.item-marketing-user-content .submenu-group-title');
        $marketingNavUserContentReviews                  = $page->find('css', '.item-catalog-reviews-ratings-reviews-all');

        PHPUnit\Framework\Assert::assertTrue($marketingNavPromotionsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavPromotionsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavPromotionsCatalogPriceRule->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavPromotionsCartPriceRules->isVisible());

        PHPUnit\Framework\Assert::assertTrue($marketingNavCommunicationsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavCommunicationsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavCommunicationsEmailTemplates->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavCommunicationsNewsletterTemplate->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavCommunicationsNewsletterQueue->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavCommunicationsNewsletterSubscribers->isVisible());

        PHPUnit\Framework\Assert::assertTrue($marketingNavSEOSearchMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavSEOSearchTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavSEOSearchURLRewrites->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavSEOSearchTerms->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavSEOSearchSynonyms->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavSEOSearchSiteMap->isVisible());

        PHPUnit\Framework\Assert::assertTrue($marketingNavUserContentMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavUserContentTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($marketingNavUserContentReviews->isVisible());
    }

    /**
     * @Then I should see the CONTENT nav menu
     */
    public function iShouldSeeTheContentNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $contentNavElementsMainArea    = $page->find('css', '.item-content-elements.parent');
        $contentNavElementsTitle       = $page->find('css', '.item-content-elements .submenu-group-title');
        $contentNavElementsPages       = $page->find('css', '.item-cms-page');
        $contentNavElementsBlocks      = $page->find('css', '.item-cms-block');
        $contentNavElementsWidgets     = $page->find('css', '.item-cms-widget-instance');

        $contentNavDesignMainArea      = $page->find('css', '.item-system-design.parent');
        $contentNavDesignTitle         = $page->find('css', '.item-system-design .submenu-group-title');
        $contentNavDesignConfiguration = $page->find('css', '.item-design-config');
        $contentNavDesignThemes        = $page->find('css', '.item-system-design-theme');
        $contentNavDesignSchedule      = $page->find('css', '.item-system-design-schedule');

        PHPUnit\Framework\Assert::assertTrue($contentNavElementsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavElementsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavElementsPages->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavElementsBlocks->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavElementsWidgets->isVisible());

        PHPUnit\Framework\Assert::assertTrue($contentNavDesignMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavDesignTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavDesignConfiguration->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavDesignThemes->isVisible());
        PHPUnit\Framework\Assert::assertTrue($contentNavDesignSchedule->isVisible());
    }

    /**
     * @Then I should see the REPORTS nav menu
     */
    public function iShouldSeeTheReportsNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $reportsNavMarketingMainArea                 = $page->find('css', '.item-report-marketing.parent');
        $reportsNavMarketingTitle                    = $page->find('css', '.item-report-marketing .submenu-group-title');
        $reportsNavMarketingProductsInCart           = $page->find('css', '.item-report-shopcart-product');
        $reportsNavMarketingSearchTerms              = $page->find('css', '.item-report-search-term');
        $reportsNavMarketingAbandonedCarts           = $page->find('css', '.item-report-shopcart-abandoned');
        $reportsNavMarketingNewsletterProblemReports = $page->find('css', '.item-newsletter-problem');

        $reportsNavReviewsMainArea                   = $page->find('css', '.item-report-review.parent');
        $reportsNavReviewsTitle                      = $page->find('css', '.item-report-review .submenu-group-title');
        $reportsNavReviewsByCustomers                = $page->find('css', '.item-report-review-customer');
        $reportsNavReviewsByProducts                 = $page->find('css', '.item-report-review-product');

        $reportsNavSalesMainArea                     = $page->find('css', '.item-report-salesroot.parent');
        $reportsNavSalesTitle                        = $page->find('css', '.item-report-salesroot .submenu-group-title');
        $reportsNavSalesOrders                       = $page->find('css', '.item-report-salesroot-sales');
        $reportsNavSalesTax                          = $page->find('css', '.item-report-salesroot-tax');
        $reportsNavSalesInvoiced                     = $page->find('css', '.item-report-salesroot-invoiced');
        $reportsNavSalesShipping                     = $page->find('css', '.item-report-salesroot-shipping');
        $reportsNavSalesRefunds                      = $page->find('css', '.item-report-salesroot-refunded');
        $reportsNavSalesCoupons                      = $page->find('css', '.item-report-salesroot-coupons');
        $reportsNavSalesPayPalSettlement             = $page->find('css', '.item-report-salesroot-paypal-settlement-reports');
        $reportsNavSalesBraintreeSettlement          = $page->find('css', '.item-settlement-report');

        $reportsNavCustomersMainArea                 = $page->find('css', '.item-report-customers.parent');
        $reportsNavCustomersTitle                    = $page->find('css', '.item-report-customers .submenu-group-title');
        $reportsNavCustomersOrderTotal               = $page->find('css', '.item-report-customers-totals');
        $reportsNavCustomersOrderCount               = $page->find('css', '.item-report-customers-orders');
        $reportsNavCustomersNew                      = $page->find('css', '.item-report-customers-accounts');

        $reportsNavProductsMainArea                  = $page->find('css', '.item-report-products.parent');
        $reportsNavProductsTitle                     = $page->find('css', '.item-report-products .submenu-group-title');
        $reportsNavProductsViews                     = $page->find('css', '.item-report-products-viewed');
        $reportsNavProductsBestsellers               = $page->find('css', '.item-report-products-bestsellers');
        $reportsNavProductsLowStock                  = $page->find('css', '.item-report-products-lowstock');
        $reportsNavProductsOrdered                   = $page->find('css', '.item-report-products-sold');
        $reportsNavProductsDownloads                 = $page->find('css', '.item-report-products-downloads');

        $reportsNavStatisticsMainArea                = $page->find('css', '.item-report-statistics.parent');
        $reportsNavStatisticsTitle                   = $page->find('css', '.item-report-statistics .submenu-group-title');
        $reportsNavStatisticsRefreshStatistics       = $page->find('css', '.item-report-statistics-refresh');

        PHPUnit\Framework\Assert::assertTrue($reportsNavMarketingMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavMarketingTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavMarketingProductsInCart->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavMarketingSearchTerms->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavMarketingAbandonedCarts->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavMarketingNewsletterProblemReports->isVisible());

        PHPUnit\Framework\Assert::assertTrue($reportsNavReviewsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavReviewsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavReviewsByCustomers->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavReviewsByProducts->isVisible());

        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesOrders->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesTax->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesInvoiced->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesShipping->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesRefunds->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesCoupons->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesPayPalSettlement->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavSalesBraintreeSettlement->isVisible());

        PHPUnit\Framework\Assert::assertTrue($reportsNavCustomersMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavCustomersTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavCustomersOrderTotal->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavCustomersOrderCount->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavCustomersNew->isVisible());

        PHPUnit\Framework\Assert::assertTrue($reportsNavProductsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavProductsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavProductsViews->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavProductsBestsellers->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavProductsLowStock->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavProductsOrdered->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavProductsDownloads->isVisible());

        PHPUnit\Framework\Assert::assertTrue($reportsNavStatisticsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavStatisticsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($reportsNavStatisticsRefreshStatistics->isVisible());
    }

    /**
     * @Then I should see the STORES nav menu
     */
    public function iShouldSeeTheStoresNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $storesNavSettingsMainArea            = $page->find('css', '.item-stores-settings.parent');
        $storesNavSettingsTitle               = $page->find('css', '.item-stores-settings .submenu-group-title');
        $storesNavSettingsAllStores           = $page->find('css', '.item-system-store');
        $storesNavSettingsConfiguration       = $page->find('css', '.item-system-config');
        $storesNavSettingsTermsAndConditions  = $page->find('css', '.item-sales-checkoutagreement');
        $storesNavSettingsOrderStatus         = $page->find('css', '.item-system-order-statuses');

        $storesNavTaxesMainArea               = $page->find('css', '.item-sales-tax.parent');
        $storesNavTaxesTitle                  = $page->find('css', '.item-sales-tax .submenu-group-title');
        $storesNavTaxesTaxRules               = $page->find('css', '.item-sales-tax-rules');
        $storesNavTaxesTaxZonesAndRates       = $page->find('css', '.item-sales-tax-rates');

        $storesNavCurrencyMainArea            = $page->find('css', '.item-system-currency.parent');
        $storesNavCurrencyTitle               = $page->find('css', '.item-system-currency .submenu-group-title');
        $storesNavCurrencyRates               = $page->find('css', '.item-system-currency-rates');
        $storesNavCurrencySymbols             = $page->find('css', '.item-system-currency-symbols');

        $storesNavAttributesMainArea          = $page->find('css', '.item-stores-attributes.parent');
        $storesNavAttributesTitle             = $page->find('css', '.item-stores-attributes .submenu-group-title');
        $storesNavAttributesProduct           = $page->find('css', '.item-catalog-attributes-attributes');
        $storesNavAttributesSet               = $page->find('css', '.item-catalog-attributes-sets');
        $storesNavAttributesRating            = $page->find('css', '.item-catalog-reviews-ratings-ratings');

        $storesNavOtherSettingsMainArea       = $page->find('css', '.item-other-settings.parent');
        $storesNavOtherSettingsTitle          = $page->find('css', '.item-other-settings .submenu-group-title');
        $storesNavOtherSettingsCustomerGroups = $page->find('css', '.item-customer-group');

        PHPUnit\Framework\Assert::assertTrue($storesNavSettingsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavSettingsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavSettingsAllStores->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavSettingsConfiguration->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavSettingsTermsAndConditions->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavSettingsOrderStatus->isVisible());

        PHPUnit\Framework\Assert::assertTrue($storesNavTaxesMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavTaxesTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavTaxesTaxRules->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavTaxesTaxZonesAndRates->isVisible());

        PHPUnit\Framework\Assert::assertTrue($storesNavCurrencyMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavCurrencyTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavCurrencyRates->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavCurrencySymbols->isVisible());

        PHPUnit\Framework\Assert::assertTrue($storesNavAttributesMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavAttributesTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavAttributesProduct->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavAttributesSet->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavAttributesRating->isVisible());

        PHPUnit\Framework\Assert::assertTrue($storesNavOtherSettingsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavOtherSettingsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($storesNavOtherSettingsCustomerGroups->isVisible());
    }

    /**
     * @Then I should see the SYSTEM nav menu
     */
    public function iShouldSeeTheSystemNavMenu()
    {
        $session = $this->getSession();
        $page = $session->getPage();

        $systemNavDataTransferMainArea             = $page->find('css', '.item-system-convert.parent');
        $systemNavDataTransferTitle                = $page->find('css', '.item-system-convert .submenu-group-title');
        $systemNavDataTransferImport               = $page->find('css', '.item-system-convert-import');
        $systemNavDataTransferExport               = $page->find('css', '.item-system-convert-export');
        $systemNavDataTransferImportExportTaxRates = $page->find('css', '.item-system-convert-tax');
        $systemNavDataTransferImportHistory        = $page->find('css', '.item-system-convert-history');

        $systemNavExtensionsMainArea               = $page->find('css', '.item-system-extensions');
        $systemNavExtensionsTitle                  = $page->find('css', '.item-system-extensions .submenu-group-title');
        $systemNavExtensionsIntegrations           = $page->find('css', '.item-system-integrations');

        $systemNavToolsMainArea                    = $page->find('css', '.item-system-tools.parent');
        $systemNavToolsTitle                       = $page->find('css', '.item-system-tools .submenu-group-title');
        $systemNavToolsCacheManagement             = $page->find('css', '.item-system-cache');
        $systemNavToolsBackups                     = $page->find('css', '.item-system-tools-backup');
        $systemNavToolsIndexManagement             = $page->find('css', '.item-system-index');
        $systemNavToolsWebSetupWizard              = $page->find('css', '.item-setup-wizard');

        $systemNavPermissionsMainArea              = $page->find('css', '.item-system-acl.parent');
        $systemNavPermissionsTitle                 = $page->find('css', '.item-system-acl .submenu-group-title');
        $systemNavPermissionsAllUsers              = $page->find('css', '.item-system-acl-users');
        $systemNavPermissionsLockedUsers           = $page->find('css', '.item-system-acl-locks');
        $systemNavPermissionsUserRoles             = $page->find('css', '.item-system-acl-roles');

        $systemNavOtherSettingsMainArea            = $page->find('css', '.item-system-other-settings.parent');
        $systemNavOtherSettingsTitle               = $page->find('css', '.item-system-other-settings .submenu-group-title');
        $systemNavOtherSettingsNotifications       = $page->find('css', '.item-system-adminnotification');
        $systemNavOtherSettingsCustomVariables     = $page->find('css', '.item-system-variable');
        $systemNavOtherSettingsManageEncryptionKey = $page->find('css', '.item-system-crypt-key');

        PHPUnit\Framework\Assert::assertTrue($systemNavDataTransferMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavDataTransferTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavDataTransferImport->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavDataTransferExport->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavDataTransferImportExportTaxRates->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavDataTransferImportHistory->isVisible());

        PHPUnit\Framework\Assert::assertTrue($systemNavExtensionsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavExtensionsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavExtensionsIntegrations->isVisible());

        PHPUnit\Framework\Assert::assertTrue($systemNavToolsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavToolsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavToolsCacheManagement->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavToolsBackups->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavToolsIndexManagement->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavToolsWebSetupWizard->isVisible());

        PHPUnit\Framework\Assert::assertTrue($systemNavPermissionsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavPermissionsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavPermissionsAllUsers->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavPermissionsLockedUsers->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavPermissionsUserRoles->isVisible());

        PHPUnit\Framework\Assert::assertTrue($systemNavOtherSettingsMainArea->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavOtherSettingsTitle->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavOtherSettingsNotifications->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavOtherSettingsCustomVariables->isVisible());
        PHPUnit\Framework\Assert::assertTrue($systemNavOtherSettingsManageEncryptionKey->isVisible());
    }

    /**
     * @Then I should be on the Admin Marketplace page
     */
    public function iShouldBeOnTheAdminMarketplacePage()
    {
        $this->assertSession()->addressEquals($this->baseUrl . '/admin/marketplace/index/');
    }
}
