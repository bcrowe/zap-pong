<div class="row-fluid row-board">
	<div class="span11 offset1 dash-box">
		<div class="span-padding">
			<h1>Leaderboard</h1>
			<table class="table table-hover table-condensed table-striped">
				<tr>
					<th>Rating</th>
					<th></th>
					<th>Player</th>
					<th>Wins</th>
					<th>Losses</th>
					<th>Total</th>
					<th>Win %</th>
					<th>Sinks</th>
					<th>Hits</th>
					<th>TKs</th>
					<th>Action %</th>
					<th>Streak</th>
				</tr>
				<?php
				foreach ($ratings as $rating) {
					echo '<tr>';
					echo '<td>' . $rating['User']['rating'] . '</td>';
					if ($rating['User']['avatar'] !== null) {
						echo '<td>' . "<img src=\"/files/user/avatar/{$rating['User']['id']}/thumb_{$rating['User']['avatar']}\" /></td>";
					} else {
						echo '<td>' . "<img src=\"/img/anon_thumb.gif\" /></td>";
					}
					echo '<td>' . $rating['User']['name'] . '</td>';
					echo '<td>' . $rating['User']['wins'] . '</td>';
					echo '<td>' . $rating['User']['losses'] . '</td>';
					echo '<td>' . $rating['User']['total_games'] . '</td>';
					$win_percentage = ($rating['User']['wins'] / $rating['User']['total_games']) * 100;
					echo '<td>' . $this->Number->toPercentage($win_percentage) . '</td>';
					echo '<td>' . $rating['User']['sinks'] . '</td>';
					echo '<td>' . $rating['User']['hits'] . '</td>';
					echo '<td>' . $rating['User']['tks'] . '</td>';
					$action_percentage = (($rating['User']['sinks'] + $rating['User']['hits']) / $rating['User']['total_games']) * 100;
					echo '<td>' . $this->Number->toPercentage($action_percentage) . '</td>';
					if ($rating['User']['streak'] > 0) {
						$streak = '+' . $rating['User']['streak'];
					} else {
						$streak = $rating['User']['streak'];
					}
					echo '<td>' . $streak . '</td>';
					echo '</tr>';
				}
				?>
			</table>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span11 offset1 dash-box">
		<div class="span-padding">
			<h1>Game History</h1>
			<table class="table table-hover table-condensed table-striped">
				<th>Winner</th>
				<th>Winner</th>
				<th>Loser</th>
				<th>Loser</th>
				<th>Actor</th>
				<th>Action</th>
				<th></th>
				<?php
				foreach ($games as $game) {
					echo '<tr>';
					$winners = array();
					$losers = array();
					$actor = array();
					foreach ($game['Player'] as $player) {
						if ($player['result'] === true) {
							$winners[]['User'] = $player['User'];
						}
						if ($player['result'] === false) {
							$losers[]['User'] = $player['User'];
						}
						if (!empty($player['action'])) {
							$actor['User'] = $player['User'];
							$actor['action'] = $player['action'];
						}
					}
					foreach ($winners as $winner) {
						echo '<td>' . $winner['User']['name'] . '</td>';
					}
					foreach ($losers as $loser) {
						echo '<td>' . $loser['User']['name'] . '</td>';
					}
					echo '<td>' . $actor['User']['name'] . '</td>';
					echo '<td>' . ucwords($actor['action']) . '</td>';
					echo '<td>' . $this->Time->timeAgoInWords($game['Game']['created']) . '</td>';
					echo '</tr>';
				}
				?>
			</table>
		</div>
	</div>
</div>