<div class="comments index">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Resource</th>
            <th>Author</th>
            <th>Comment</th>
        </tr>
        <?php foreach ($comments as $comment): $comment = $comment['AdminComment'] ?>
            <tr>
                <td>
                    <?php echo $this->Html->link(__($comment['resource_name']), array('controller' => $comment['class'], 'action' => 'view', $comment['foreign_id'], 'admin' => true,'plugin'=>false)); ?>
                </td>
                <td><?php echo h($comment['author']); ?> &nbsp;</td>
                <td><?php echo h($comment['body']); ?> &nbsp;</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>