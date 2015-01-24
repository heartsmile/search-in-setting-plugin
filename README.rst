==============================
Search In Setting Plugin
==============================
-----------
Description
-----------
Plugin help admin to search settings from admin page of **Question2Answer**

--------
Features
--------
- Add search box into admin page
- Search and show result in another page
- Navigate to admin site that have correspond setting
------------
Installation
------------
#. Install Question2Answer_
#. Get the source code for this plugin from github_, either using git_, or downloading directly:

   - To download using git, install git and then type 
     ``git clone git@github.com:heartsmile/search-in-setting-plugin.git``
     at the command prompt (on Linux, Windows is a bit different)
   - To download directly, go to the `project page`_ and click **Download**

#. Go to **Admin -> Plugins** on your q2a install and select the '**Search In Setting**' option, then '**Save Changes**'.
#. Go to page admin/layout and find "Search In Setting Widget", click add widget, choose location and page then save all changes
#. Note: You must enter your home page url correctly at "Preferred site URL:", which is in admin/general page.
.. _Question2Answer: http://www.question2answer.org/install.php
.. _git: http://git-scm.com/
.. _github:
.. _project page: https://github.com/heartsmile/search-in-setting-plugin

-----------
Translation
-----------

.. _Translation:

The translation file is **qa-search-setting-lang-default.php**.  Copy this file and rename it to **qa-search-setting-lang-<your_language>.php**.  Edit the right-hand side strings in this file with notepad2, notepad++, etc. (don't ever use Window's Notepad. For anything. Ever.), for example, changing:

**'placeholder_text'=>'Search Setting',**

to

**'placeholder_text'=>'Tìm kiếm cài đặt',**

for Vietnamese.  Don't edit the string on the left-hand side or bad things will happen.

Once you've completed the translation, don't forget to set the site language in the admin control panel... to Vietnamese.
This plugin supported Vietnamese in **qa-search-setting-lang-vi.php** file.

-----------
Release
-----------
- This is the first version, and it run well on Q2A 1.6

-----------
About Question2Answer
-----------
- Question2Answer is a free and open source platform for Q&A sites. For more information, visit:

http://www.question2answer.org/
