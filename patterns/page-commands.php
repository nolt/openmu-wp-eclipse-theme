<?php
/**
 * Title: Commands page
 * Slug: openmu-eclipse/page-commands
 * Categories: openmu-eclipse-pages
 * Description: Page head and a table of the chat commands players use on an OpenMU server. Remove the commands your server has switched off.
 * Keywords: commands, chat, help, table
 * Viewport Width: 1200
 *
 * @package OpenMU_Eclipse
 */

// Command => description. Commands themselves are never translated; only the <placeholders> are.
$openmu_commands = array(
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/move <map>', 'openmu-eclipse' ), __( 'Travels to a map, for example /move devias.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/post <text>', 'openmu-eclipse' ), __( 'Sends a message to all players on the server.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/world <text>', 'openmu-eclipse' ), __( 'Sends a message to the world chat, which players on all game servers can read.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/add <str|agi|vit|ene|cmd> <points>', 'openmu-eclipse' ), __( 'Adds level-up points to a stat, for example /add str 10. The last stat is command (Dark Lord).', 'openmu-eclipse' ) ),
	array( '/reset', __( 'Resets the character when it reaches the required level.', 'openmu-eclipse' ) ),
	array( '/resetinfo', __( 'Shows the cost and the points granted for your next reset.', 'openmu-eclipse' ) ),
	array( '/resetstats', __( 'Resets the stat points of your character.', 'openmu-eclipse' ) ),
	array( '/pkclear', __( 'Clears your player-killer status for a fee.', 'openmu-eclipse' ) ),
	array( '/offlevel', __( 'Keeps your character leveling in the world after you disconnect. The MU Helper must be running.', 'openmu-eclipse' ) ),
	array( '/waiting', __( 'Lists the items that are waiting for free space in your inventory.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/war <guild>', 'openmu-eclipse' ), __( 'Sends a guild war request to the guild master of the given guild.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/battlesoccer <guild>', 'openmu-eclipse' ), __( 'Sends a battle soccer request to the guild master of the given guild.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/language <code>', 'openmu-eclipse' ), __( 'Changes the language of your account, for example /language pl.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/discord <link|unlink|notify>', 'openmu-eclipse' ), __( 'Links your account to Discord. /discord link creates a code to enter in Discord, /discord unlink removes the link.', 'openmu-eclipse' ) ),
	array( '/list', __( 'Lists the commands available to you, with their usage.', 'openmu-eclipse' ) ),
	/* translators: chat command; translate only the placeholder in angle brackets, never the command itself. */
	array( __( '/help <command>', 'openmu-eclipse' ), __( 'Shows how to use one command, for example /help move.', 'openmu-eclipse' ) ),
);

$openmu_rows = '';
foreach ( $openmu_commands as $openmu_row ) {
	$openmu_rows .= '<tr><td><code>' . esc_html( $openmu_row[0] ) . '</code></td><td>' . esc_html( $openmu_row[1] ) . '</td></tr>';
}
?>
<?php echo openmu_eclipse_pagehead( 'commands', __( 'In-game chat', 'openmu-eclipse' ), __( 'Type these in the game chat. Values in angle brackets are yours to fill in. Some commands may be switched off on this server.', 'openmu-eclipse' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup. ?>
<!-- wp:group {"className":"oe-pagebody","layout":{"type":"constrained","wideSize":"76rem"}} -->
<div class="wp-block-group oe-pagebody">
	<!-- wp:table {"align":"wide","className":"is-style-stripes"} -->
	<figure class="wp-block-table alignwide is-style-stripes"><table class="has-fixed-layout"><thead><tr><th><?php esc_html_e( 'Command', 'openmu-eclipse' ); ?></th><th><?php esc_html_e( 'What it does', 'openmu-eclipse' ); ?></th></tr></thead><tbody><?php echo $openmu_rows; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped while built. ?></tbody></table></figure>
	<!-- /wp:table -->
</div>
<!-- /wp:group -->
