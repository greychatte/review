<div class="container">
    <div class="row">
        <div class="col s6 push-s3">
            <table>
                <thead>
                    <tr>
                        <th><?php echo $txt_num; ?></th>
                        <th><?php echo $txt_user; ?></th>
                        <th><?php echo $txt_userphone; ?></th>
                        <th><?php echo $txt_useremail; ?></th>
                        <th><?php echo $txt_userquestion; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $value) { ?>
                        <tr>
                            <td><?php echo $value['review_id']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['phone']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['question']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
