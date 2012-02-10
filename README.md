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
    ln -s ../../../../../oscommerce_website/osCommerce/OM/Custom/Site/Admin Admin
    ln -s ../../../../../oscommerce_website/osCommerce/OM/Custom/Site/_skel _skel
    cd ..
    ln -s ../../../../oscommerce_website/osCommerce/OM/Custom/Template Template
    ln -s ../../../../oscommerce_website/osCommerce/OM/Custom/Exception Exception
    cd ../../../public/sites
    ln -s ../../../oscommerce_website/public/sites/Website Website
    cd ../external
    ln -s ../../../oscommerce_website/public/external/bootstrap bootstrap
    ln -s ../../../oscommerce_website/public/external/less less

A configuration block is also required in osCommerce/OM/Config/settings.ini,
which can be copied from an existing block:

    [Website]
    enable_ssl = "false"
    http_server = "http://your-server"
    https_server = "http://your-server"
    http_cookie_domain = ""
    https_cookie_domain = ""
    http_cookie_path = "/oscommerce/"
    https_cookie_path = "/oscommerce/"
    dir_ws_http_server = "/oscommerce/"
    dir_ws_https_server = "/oscommerce/"
    db_server = "localhost"
    db_server_username = "nobody"
    db_server_password = ""
    db_server_port = ""
    db_database = "oscommerce"
    db_driver = "MySQL\V5"
    db_table_prefix = "osc_"
    db_server_persistent_connections = "false"
    store_sessions = "Database"

The website is accessed with the following URL:

    http://your-server/oscommerce/index.php?Website

Feedback
---------

Please review the following forum topic for discussions on the template engine
functionality.

http://forums.oscommerce.com/topic/383392-template-engine-functionality-proposal/

Note
----

Although the source code to new osCommerce website will be available, it will
not be packaged together with osCommerce Online Merchant v3.0.

Making the source code available serves to showcase the capabilities of the
framework and to kickstart the initiative of a general purpose CMS Site that
can be packaged with osCommerce Online Merchant v3.0.
