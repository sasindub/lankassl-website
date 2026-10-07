<?php
page_start(['title' => 'Board of Directors', 'body' => 'no-hero']);
page_hero('Governance', 'Board of <span class="gold">Directors</span>', 'Experienced leadership drawn from across the E.B. Creasy Group and The Colombo Fort Land & Building Group.', '', ['Company' => null, 'Board of Directors' => null]);

function initials(string $name): string
{
	$parts = preg_split('/[\s.]+/', preg_replace('/^(Mr|Ms|Mrs|Dr)\.?\s+/', '', $name), -1, PREG_SPLIT_NO_EMPTY);
	$last = end($parts);
	return strtoupper(substr($parts[0], 0, 1) . ($last !== $parts[0] ? substr($last, 0, 1) : ''));
}
?>

<section class="section">
	<div class="container">
		<div class="board-list" data-stagger>
			<?php foreach ($BOARD as $i => $b): ?>
				<details class="board-item" <?= $i === 0 ? 'open' : '' ?>>
					<summary>
						<span class="mono"><?= e(initials($b['name'])) ?></span>
						<span>
							<span class="role"><?= e($b['role']) ?></span>
							<h3><?= e($b['name']) ?></h3>
							<?php if ($b['cred']): ?><span class="cred"><?= e($b['cred']) ?></span><?php endif; ?>
						</span>
						<?php if ($b['bio']): ?><span class="plus"><?= icon('chev') ?></span><?php endif; ?>
					</summary>
					<?php if ($b['bio']): ?><p class="bio"><?= e($b['bio']) ?></p><?php endif; ?>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php cta_band(); ?>
<?php page_end(); ?>
