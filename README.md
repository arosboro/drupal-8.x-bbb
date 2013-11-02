# BigBlueButton for Drupal 7

## Source Code // Project Pages:
* BigBlueButton: http://code.google.com/p/bigbluebutton
* BigBlueButton for Drupal: http://drupal.org/project/bbb

## Installation and Setup:
1. Install a Working BigBlueButton Server: http://code.google.com/p/bigbluebutton/wiki/08InstallationUbuntu
2. Download and enable the current dev version of the Drupal BBB module
3. Enable BBB module
4. Configure BBB Settings at: admin/config/media/bigbluebutton by adding a Base URL and Security Salt value. You can get this value using the command "bbb-conf --salt" on your Big Blue Button server. (Note: It's important there is no trailing / on the URL you use.)
5. Create a new content type or edit an existing node type and check the options under "treat this node type as a meeting"
6. Create or edit a node of your new type and ensure the bigbluebutton settings are correct.