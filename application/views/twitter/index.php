<style>
    .twitter tr > * { padding: 4px; border: 1px solid #999; }
    .twitter th { text-align: left; vertical-align: top; }
</style>

<?php if ($twitterLoggedIn): ?>

    <a href="/twitter/logout">Logout</a>

    <table class="twitter">
        <?php foreach ($twitterUser as $key => $value): ?>
        <tr>
            <th>
                <?php echo $key; ?>
            </th>
            <td>
                <?php if (is_object($value)): ?>
                <table>
                    <?php foreach ((array) $value as $key2 => $value2): ?>
                    <tr>
                        <th>
                            <?php echo $key2; ?>
                        </th>
                        <td>
                            <?php echo $value2; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php else: ?>
                    <?php echo $value; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php else: ?>

    <a href="/twitter/login">Login</a>

<?php endif; ?>