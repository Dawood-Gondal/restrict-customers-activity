# M2Commerce Commerce: Magento 2 Restrict Customers Activity

## Description
This extension allows you to restrict spam customers from your store.
You can blacklist customer by there phone number, emails or emails domains (like @xyz.xom) from placing order on your store, creating a new account or logging in to their account.

## Configuration

There are several configuration options for this extension, which can be found at **STORES > Configuration > Commerce Enterprise > Customers Restriction**.

## Installation
### Magento® Marketplace

This extension will also be available on the Magento® Marketplace when approved.

1. Go to Magento® 2 root folder
2. Require/Download this extension:

   Enter following commands to install extension.

   ```
   composer require m2commerce/restrict-customers-activity
   ```

   Wait while composer is updated.

   #### OR

   You can also download code from this repo under Magento® 2 following directory:

    ```
    app/code/M2Commerce/RestrictCustomersActivity
    ```    

3. Enter following commands to enable the module:

   ```
   php bin/magento module:enable M2Commerce_RestrictCustomersActivity
   php bin/magento setup:upgrade
   php bin/magento setup:di:compile
   php bin/magento cache:clean
   php bin/magento cache:flush
   ```

4. If Magento® is running in production mode, deploy static content:

   ```
   php bin/magento setup:static-content:deploy
   ```
