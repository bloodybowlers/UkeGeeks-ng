# UkeGeeks-ng

![Ukegeeks-ng](./img/screenshot.png)
![Ukegeeks-ng song](./img/screenshot2b.png)

This is an attempt at an *enhanced/updated/modified/edited_to_fits_my_needs* version of UkeGeeks    
(since the original doesn't seems to accept pull request since early 2015).

UkeGeeks is a songbook editor for ukulele originally created by [Buz Carter](http://pizzabytheslice.com) (buz@ukegeeks.com) :)

### What's changed so far :

#### Major features / changes

- Public/Private site access :
  - Public mode : guest allowed (**view** song only, users needs to **login** to modify/add)
  - Private mode : **everyone** needs to login
- Chords now **stay on top** when **scrolling** a song
- Added a **DELETE SONG** button to the EDITOR
- Added **Auto-Scrolling** of song
- Added **display of chord** diagram on **mouse hovering**
- **Sorted the song list** by artist and song name + layout change for better search
- Added full **TRANSLATION support**. Currently :
  - ENGLISH
  - FRENCH
  - GERMAN (thanks to Louis-Coding)
  - (you can contribute :p)
- **Chord Finder** and **Reverse Chord Finder** (from UkeGeeks website 'tool' source code)
- Removed **legacy browser** support
- Added support for some more chordPro tags :
  - Key
  - Capo
- Added an option to open/view song in new tabs
- Custom chordPro tags :
  - x_UGNG_diagramPosition (possible values : left, top, none)
  - x_UGNG_lyricStyle (possible values : inline, above, minidiagrams)
  - x_UGNG_hideChordEnclosures (possible values : yes, no)

#### Improvements, small fixes, QoL changes

- Removed the **edit** button if **no write access** allowed
- Added a **SONGBOOK** button when viewing a song (to go back)
- Added some missing **chords**
- Proper **404 handling** (on **page** missing and on **song** missing)
- **Non-intrusive popup** on missing chords
- Various pseudo-security fixes (.gitignore, separate config file, preventing some things to READ only users, ...)
- Switched some calls to HTTPS
- Removed useless SOPRANO tuning references on each pages
- Login page cleanup + ability to hide email
- Made the advanced editor link more obvious + help displayed on startup
- Added a back to top button on the song list
- Removed the StaticsPrefix const from the config file. Now it's handled automagically
- Removed 'no detailed list' and 'no editable song' mode. We want full functionality, all the time
- Switched to jQuery 2
- Added a reindex button if an admin is logged in
- Display number of songs in the book

_______________________________________________________
# Installation

Nothing special here, you need Apache / Php.  
Mod_rewrite is really recommended too (for prettier url).

Just download the source and unzip-it (or use git clone) on your hosting space.

**Important : By default, the Songbook assumes that it's installed in your web server's root directory.**
If you want to change this, read below (installing in a different directory).

## Setup username, preferences

- **Step 1** : Rename the file **/ugsphp/conf/config.php_example** to **config.php** and edit-it to suits your needs (username, passwords, language, private/public mode, etc)
- **Step 2** : Rename the **/ugsphp/conf/settings.js_example** to **settings.js** and edit-it to suits your preferences (diagram size, position, default theme, ...).
- **Step 3** : Rename htaccess.txt to .htaccess

And that's it, you should be good to go. Start adding songs :)

### Optional

#### Optional : installing in a different directory
The Songbook assumes that it's installed in your web server's root directory, but you might want it in a subdirectory. Perhaps you want the URLs to be "mysite.com/hobbies/ukulele/music.php", for example. Excellent! To do this we just need to open config.php and change the subdirectory.

By default this is set to the root:

    const Subdirectory = '/';
    
You can just modify it to whatever you wish (include leading and trailing last forward slashes "/")

    const Subdirectory = '/hobbies/ukulele/';

If you installed UkeGeeks-ng to a subdirectory, you have to modify the .htaccess. Change the **ErrorDocument** to the correct path of your install.
 
#### Optional : enabling URL rewriting (apache mod_rewrite)

For nicer url you can enable mod_rewrite in the config.php file like this :

    const UseModRewrite = true;

If you installed UkeGeeks-ng to a subdirectory, you have to modify the .htaccess. Change the line **RewriteBase** to the correct path of your install.
