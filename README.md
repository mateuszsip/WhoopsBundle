WhoopsBundle
============

Symfony integration for Whoops

INSTALLATION
-----------

1. Use [Composer](http://getcomposer.org) to install bundle into your project:

    ```bash
        composer require kejwmen/whoops-bundle
    ```

2. Add it to your AppKernel
    
    ```php
        // app/AppKernel.php
        public function registerBundles()
        {
            if (in_array($this->getEnvironment(), array('dev'))) {
                $bundles[] = new Kejwmen\WhoopsBundle\KejwmenWhoopsBundle();
            }
        }
    ```

3. Install [Remote Call](https://plugins.jetbrains.com/plugin/6027-remote-call) plugin in your Phpstorm.

4. Go to `Settings|Other Settings|Remote Call` and make sure that `Listening port` is `8091`.
