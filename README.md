# OpenMU Eclipse

*[Wersja polska](README.pl.md)*

A dark high-fantasy WordPress block theme for [OpenMU](https://github.com/MUnique/OpenMU) (MU Online server
emulator) websites. Black sun, golden corona, ruined castle: an animated eclipse scene, a three-class showcase,
a glassy sticky header and ready-made pages.

It is made for the **[OpenMU WP Connect](https://github.com/nolt/openmu-wp-connect)** plugin, which brings the live
server data (status, rankings, armory, events, account). Without the plugin the theme works as a site with news,
and the server pages say that the plugin is needed.

![OpenMU Eclipse](screenshot.png)

## Features

- **Home page**: full-screen animated hero (parallax layers, canvas embers, pulsing corona), live server status,
  class showcase (Dark Knight, Dark Wizard, Fairy Elf), latest news, how to start, event schedule, top 5 ranking,
  download/Discord call to action, rich footer.
- **Calm animated background** on every other page. `prefers-reduced-motion` gives a static scene; the animation
  pauses in a hidden tab.
- **Header**: sticky, glass, compact on scroll; menu built from pages by address (Home, News, Download, *Server*
  submenu: Ranking, Mini games, Armory, Events, Commands; Account); works on touch; full-screen menu on phones;
  *Play now* button.
- **Templates**: front page, news, archive, single post, page, wide page, search, 404 and one template per server page
  (ranking, mini games, armory, events, commands, download, account).
- **Plugin styling** for [OpenMU WP Connect](https://github.com/nolt/openmu-wp-connect): status, ranking, mini game
  ranking, events, armory, account forms, tooltips, notices.
- Bundled fonts (Cinzel, Inter; SIL OFL) as woff2: no external requests at runtime. Small deferred vanilla JS.
- Translations: English, Polish.

## Requirements

- WordPress 6.6 or later (tested with 7.1), PHP 8.1 or later (tested with 8.4).
- Optional: the [OpenMU WP Connect](https://github.com/nolt/openmu-wp-connect) plugin, for live data from the game server.

## Installation

1. Download `openmu-eclipse-<version>.zip` from [Releases](../../releases) and upload it under
   **Appearance > Themes > Add New Theme > Upload Theme**, or copy this repository to
   `wp-content/themes/openmu-eclipse`. Activate **OpenMU Eclipse**.
2. Install the [OpenMU WP Connect](https://github.com/nolt/openmu-wp-connect) plugin and connect it to your server.
3. Set the real links: the buttons on the **Download** page and the Discord links (they point to `#` until you do).

## What activating does

Activating the theme creates the pages it needs by address (Home, News, Download, Ranking, Mini games, Armory,
Events, Commands, Account), makes Home the front page and News the posts page, and restores your previous
reading settings when you switch to another theme. Pages with other addresses are left alone.

## Game client files

The theme ships no files of the MU Online game client. The armory therefore shows the plugin's neutral class
emblem and the item names. To show class pictures and full item tooltips, put the files from your own game client
into the plugin's client folder, as its README describes.

## Pages

With the plugin in demo mode, desktop 1440 px wide. Click a picture for the full size.

| | | |
| --- | --- | --- |
| [<img src="docs/assets/pages/home.webp" width="260" alt="Front page">](docs/assets/pages/home.webp)<br>Front page | [<img src="docs/assets/pages/news.webp" width="260" alt="News">](docs/assets/pages/news.webp)<br>News | [<img src="docs/assets/pages/download.webp" width="260" alt="Download">](docs/assets/pages/download.webp)<br>Download |
| [<img src="docs/assets/pages/ranking.webp" width="260" alt="Ranking">](docs/assets/pages/ranking.webp)<br>Ranking | [<img src="docs/assets/pages/mini-games.webp" width="260" alt="Mini games">](docs/assets/pages/mini-games.webp)<br>Mini games | [<img src="docs/assets/pages/armory.webp" width="260" alt="Armory">](docs/assets/pages/armory.webp)<br>Armory |
| [<img src="docs/assets/pages/events.webp" width="260" alt="Events">](docs/assets/pages/events.webp)<br>Events | [<img src="docs/assets/pages/commands.webp" width="260" alt="Commands">](docs/assets/pages/commands.webp)<br>Commands | [<img src="docs/assets/pages/account.webp" width="260" alt="Account">](docs/assets/pages/account.webp)<br>Account |

| | | |
| --- | --- | --- |
| [<img src="docs/assets/pages/phone-home.webp" width="180" alt="Front page">](docs/assets/pages/phone-home.webp)<br>Front page | [<img src="docs/assets/pages/phone-menu.webp" width="180" alt="Menu">](docs/assets/pages/phone-menu.webp)<br>Menu | [<img src="docs/assets/pages/menu-desktop.webp" width="260" alt="Server menu (desktop)">](docs/assets/pages/menu-desktop.webp)<br>Server menu (desktop) |

## Artwork and credits

Every graphic is original hand-written SVG made for this theme (see [`assets/art/README.md`](assets/art/README.md)).
Fonts: Cinzel and Inter, SIL Open Font License 1.1 (`assets/fonts/`).

MU Online is a trademark of Webzen. This project is a fan work, not affiliated with or endorsed by Webzen.

## License

GPL-2.0-or-later. Copyright (c) 2026 Nolt.
