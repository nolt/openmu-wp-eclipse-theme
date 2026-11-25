# OpenMU Eclipse - art assets

All artwork in this folder is original to the OpenMU Eclipse theme: hand-written SVG, no
raster images, no fonts, nothing taken from the MU client, Webzen, other themes or the internet.
License: GPL-2.0-or-later, (c) Nolt.

Every SVG starts with a short comment, uses a `viewBox` (no fixed size) and prefixes its internal
ids (`bk-`, `sm-`, `elf-`, `em-`, ...) so files can be inlined together without clashes.
Palette: obsidian `#07080d`-`#121521`, gold `#e8b75a`/`#f5d48a`, ember `#c2362f`-`#ff6a3d`, arcane cyan `#5fd4ff`.

## Files

| File | Purpose |
|---|---|
| `logo/emblem.svg` | Main emblem (eclipse, wings, sword); readable from 32 px to 256 px |
| `logo/favicon.svg` | Simplified emblem for the browser tab (16-32 px) |
| `characters/dark-knight.svg` | Dark Knight, full body, 800x1200, transparent (plate armour, greatsword, ember wings) |
| `characters/dark-wizard.svg` | Dark Wizard, full body, 800x1200 (hooded robes, orb staff, rune circle) |
| `characters/fairy-elf.svg` | Fairy Elf, full body, 800x1200 (light armour, bow, long hair, nature light) |
| `scene/eclipse.svg` | Black sun with golden corona, 800x800; `#ec-rays` (rotate) and `#ec-glow` (pulse) are animation hooks |
| `scene/mountains-far.svg`, `scene/mountains-near.svg` | Parallax mountain layers, 2400x600, seamless horizontally |
| `scene/castle.svg` | Ruined castle silhouette with lit windows, 2400x600, centred (not tiled) |
| `scene/fog.svg` | Soft fog bands, 2400x600, seamless horizontally |
| `ornaments/divider.svg` | Section divider with central jewel, 600x24 |
| `ornaments/corner.svg` | Panel corner (top-left; mirror with CSS), 96x96 |
| `ornaments/frame-top.svg` | Top edge for cards/panels, 800x48 |
| `ornaments/jewel.svg` | Ember jewel in gold bezel, 64x64 |
| `icons/*.svg` | 24x24 line icons, `stroke="currentColor"`, width 1.75, round caps: download, ranking, armory, events, commands, account, news, minigames, server, discord, play, user, crown, sword, shield, clock, check, close, menu, arrow-right |

Layer tips: scene layers share the same 2400x600 box and bottom edge; stack them
eclipse (behind) - mountains-far - mountains-near - castle - fog and scroll the tiling ones at
different speeds. The generator scripts (`gen_scene.py` rebuilds the scene files, `render.sh` makes PNG previews)
live in the development repository and are not part of the theme release.
