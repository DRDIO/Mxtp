<?php if ($selfMixes): ?>
    <?php if ($isUser): ?>
<h1>Your Playlists</h1>
    <?php else: ?>
<h1>Member's Playlists</h1>
    <?php endif; ?>

<ul id="mix_list_self" class="listcontainer">

<?php foreach ($selfMixes as $mix): ?>
    <li id="mix_<?php echo $mix->id; ?>" class="listmix">
    <a href="/listen/<?php echo $mix->hash; ?>"
        title="<?php echo html::specialchars($mix->title); ?>"
        style="text-decoration: none;"> <strong class="listtitle"><?php echo $mix->title; ?></strong></a>
        <?php if ($isUser): ?>
    <div class="ui-icon ui-icon-trash ui-state-default ui-corner-all"
        title="Delete Mix">Delete</div>
    <div class="ui-icon ui-icon-comment ui-state-default ui-corner-all"
        title="Edit Mix Title">Edit</div>
    <div
        class="ui-icon ui-icon-arrowthick-2-n-s ui-state-default ui-corner-all"
        title="ReOrder Mix in List">Reorder</div>
        <?php endif; ?></li>
<?php endforeach; ?>
</ul>
        <?php endif; ?>

        <?php if ($favMixes): ?>
    <?php if ($isUser): ?>
<h1>Your Favorites</h1>
    <?php else: ?>
<h1>Member's Favorites</h1>
    <?php endif; ?>
        <?php foreach ($favMixes as $mix): ?>
<a href="/listen/<?php echo $mix->hash; ?>" class="listmix"
    title="<?php echo html::specialchars($mix->title); ?>"> <strong><?php echo $mix->title; ?></strong>
by <span><?php echo $mix->username; ?></span> </a>
        <?php endforeach; ?>
        <?php endif; ?>

<div id="dialog" title="Delete This Mix?"><span
    class="ui-icon ui-icon-alert"
    style="float: left; width: 16px; margin: 1px 4px 0 0;"></span> <span>Are
you sure you want to delete <span class="message">this mix</span>? Once
it is deleted, you can no longer claim it, and it becomes a public mix!</span>
</div>
