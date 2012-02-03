osCommerce Website
==================

This repository contains the development of the new osCommerce website powered
by the osCommerce Online Merchant v3.0 framework.

The initial code is to propose template engine functionality to add to
osCommerce Online Merchant v3.0.

Installation
------------

An installation of osCommerce Online Merchant v3.0 is required:

https://github.com/osCommerce/oscommerce

The following directory structure is used as an example:

* oscommerce - osCommerce Online Merchant v3.0
* oscommerce_website - osCommerce Website

Once the files have been cloned from the "oscommerce_website" repository, the
following directories must be symlinked to the "oscommerce" installation:

    mkdir oscommerce/osCommerce/OM/Custom/Site
    cd oscommerce/osCommerce/OM/Custom/Site
    ln -s ../../../../../oscommerce_website/osCommerce/OM/Custom/Site/Website Website
    cd ..
    ln -s ../../../../oscommerce_website/osCommerce/OM/Custom/Template Template
    cd ../../../public/sites
    ln -s ../../../oscommerce_website/public/sites/Website Website
    cd ../external
    ln -s ../../../oscommerce_website/public/external/flexslider flexslider
    ln -s ../../../oscommerce_website/public/external/less less
    cd jquery/ui/themes
    ln -s ../../../../../../oscommerce_website/public/external/jquery/ui/themes/Aristo Aristo

The website is accessed with the following URL:

    http://your-server/oscommerce/index.php?Website

Feedback
---------

Please review the following forum topic for discussions on the template engine
functionality.

#link pending#

Note
----

Although the source code to new osCommerce website will be available, it will
not be packaged together with osCommerce Online Merchant v3.0.

Making the source code available serves to showcase the capabilities of the
framework and to kickstart the initiative of a general purpose CMS Site that
can be packaged with osCommerce Online Merchant v3.0.
