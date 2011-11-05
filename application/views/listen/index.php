<div style="width: 30%; float: left; padding-right: 12px; -webkit-box-sizing: border-box; box-sizing: border-box; -moz-box-sizing: border-box;">
<?php foreach ($users as $user): ?>
    <div class="listmix">
        (<?php echo $user->mixes; ?>)
        <a href="/u/<?php echo $user->username; ?>" title="<?php echo html::specialchars($user->username); ?>">
            <?php echo html::specialchars($user->username); ?>
        </a>
    </div>
<?php endforeach; ?>
</div>

<div style="float: right; width: 70%;">
<?php foreach ($mixes as $mix): ?>
    <div class="listmix">
        <a href="/listen/<?php echo $mix['hash']; ?>" title="<?php echo html::specialchars($mix['title']); ?>">
            <strong><?php echo html::specialchars($mix['title']); ?></strong>
        </a> by

        <a href="/u/<?php echo html::specialchars($mix['username']); ?>" title="View <?php echo html::specialchars($mix['username']); ?> Mixes">
            <?php echo html::specialchars($mix['username']); ?>
        </a>
    </div>
<?php endforeach; ?>
</div>