==============================
Search In Setting Plugin
==============================

-----------
Description
-----------
This plugin helps administrators to search for setting items from Admin page of a question2answer_ page - the search box works similarly to Chrome browser preference search feature.

.. _question2answer: http://question2answer.org

--------
Features
--------
- Add search box to admin page
- Search and show results in another page
- Navigate to admin site/sub-page that contains the corresponding setting

-----------------------
Installation - In brief
-----------------------

#. Install question2answer site
#. Add **search-in-setting** plugin to the site by copying to **qa-plugin** folder
#. Turn it on via **Plugins** and **Layout** site under **Admin** page
#. Done

-----------------------
Installation - Full steps
-----------------------

*Install question2answer site*

#. Install your q2a site by following question2answer.org guide_

*Add **search-in-setting** plugin*

#. Get the source code for this plugin from github_
#. Copy it to **%q2aHOME%\qa-plugin** folder

*Turn it on 1 of 2 - via Plugins*

#. Go to **Admin -> Plugins** page of your installed question2answer site, we will see all plugins are listed here
#. Locate **Search In Setting**, select **options**, make sure **Enable this plugin** is checked, and hit **Save Changes**

*Turn it on 2 of 2 - via Layout*

#. Go to **Admin -> Layout**, the widget **Search In Setting** should be listed there under **Available widgets**
#. Hit **Add widget** to add our search box to the content layout
#. Select where to display it in **Position** e.g. 'Main area - Top'
#. Check the following page checkboxes to select pages to display e.g. 'Show widget in this position on all available pages' for all pages
#. Hit **Save options**

----
Note
----
In **Admin - General** page, at **Preferred site URL**, the URL of your q2a home page should be copied there correctly.

E.g. If your published page is at http://demo.question2answer.org/, then this exact URL should be used in **Preferred site URL** box.

This helps to display the search result page properly.

.. _guide: http://www.question2answer.org/install.php
.. _github: https://github.com/heartsmile/search-in-setting-plugin
.. _project page: https://github.com/heartsmile/search-in-setting-plugin

-----------
Translation
-----------

The translation file is **qa-search-setting-lang-default.php**.

Copy this file and rename it to **qa-search-setting-lang-<your_language_code>.php** e.g. **qa-search-setting-lang-vi.php** for Vietnamese.

One translation sample as below.

**'placeholder_text'=>'Search Setting',** in English to be translated to Vietnamese by **'placeholder_text'=>'Tìm kiếm cài đặt',**

See here_ for more details on q2a translation

.. _here: http://www.question2answer.org/translate.php

-------
Release
-------
This is the first version, and it run well on question2answer version 1.7

-----------
About Question2Answer
-----------
Question2Answer is a free and open source platform for Q&A sites. For more information, visit http://www.question2answer.org/
