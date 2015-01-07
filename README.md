PluginNinja
============
###### A better way to manage PocketMine plugins

**This project isn't yet in a working state.**

Ever thought to yourself how silly installing a plugin? Have you ever read the supposedly **simple** installation instructions and though to yourself, these aren't that simple at all. You have to like...drag and drop something, that's pretty hard in the world of today. There is good news! Once you install PluginNinja, you will never have to manage plugins in such a boring way.

### Installing PluginNinja
* Click on "Releases" and find the latest `.phar` file.
* Put the file into your plugins folder. Start your server.
* Restart your server. Do **not** reload.
* Step back, it's alive. PluginNinja will index your plugins and then it will continue with its standard startup.


#### That sounds scary, what is it doing when it's "alive"?
* PluginNinja starts by creating its environment. The happens in three simple stages
    * Install of the invisible loader, this file loads the PluginNinja core.
    * Restart of server to stabilize loader.
    * Creation of `.ninja` to cache old versions.
    * Creation the `ninja.json` for dependency management.
* PluginNinja wants all plugins to be tracking a remote source. It will scan through all existing plugins and try to find them in one of the builtin sources. If it can't find the plugin, updates and version control will not be available. 


### Source types
Developers may add new source types, but it is recommended to use an existing one. The following types are built in

* `NinjaAPI` **official repo type, includes ability to push updates**
* `PocketMineForums` (extends `WebJSON`)
* `GitHubDirectory` (extends WebDirectory)
* `WebDirectory` (extends `LocalDirectory`)
* `WebJSON` (extends `LocalJSON`)
* `LocalDirectory`
* `LocalJSON` **this one is highly impractical**

#### Builtin sources 
Several sources come built in, they can be modified in the `Ninja.json`.

* PocketMine Forums uses `PocketMineForums` with source at http://forums.pocketmine.net/api.php
* GitHub uses `GitHubDirectory` with source at https://github.com 
* Official repo uses `NinjaAPI` with source at ninja.mcpe.me (currently offline) 
