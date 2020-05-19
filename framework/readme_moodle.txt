Description of WET-BOEW framework import into Moodle

WET-BOEW framework
------------------

This theme uses the version 4.0.30 of the WET-BOEW framework including the GCWeb template files. Specifically, it uses the CDTS Application templates for GCWeb
You will find a working example of this at:

https://ssl-templates.services.gc.ca/app/cls/wet/gcweb/v4_0_30/cdts/appTop/apptop_all-en.shtml

Updating it to the latest release is not trivial. There is no download available for this template so you need to reverse engineer it from the "Inspect" and "View source code" features ofyour web browser.

You will need to:

* Extract the source code from the page and fix it up so that it no longer uses ajax to retrieve the content of the page.
* Integrate the Moodle features into the template.
* Resolve conflicts. Moodle is based on YUI and Bootstrap 4. WET-BOEW is based on Bootstrap 3. They don't always play when you overlay one over the other.
* JavaScript is tricky. Moodle uses RequireJS/AMD while WET does not. This can make it challenging to get WET javascript to run in Moodle without converting all of WET's JavaScript to AMD.
* Customize the .mustache template files.
* update ./thirdpartylibs.xml

WET-BOEW is already pre-compiled and compressed. Do not grunt on it.