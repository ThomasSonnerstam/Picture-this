<?php
require __DIR__ . '/views/header.php';
require __DIR__ . '/app/users/showuserinfo.php';
?>
<?php
$commentId = (int) $_GET['id'];
// $post = getPostById($pdo, $idFromGet);
// $postId = $post['id'];
// var_dump($post);

$comment = getCommentById($pdo, $commentId);

// var_dump($comment);

?>
<section class="edit-comment-page">
    <h3>Edit comment</h3>

    <form action="/app/posts/edit-comment.php?id=<?php echo $commentId; ?>" method="post">
        <label for="edit-comment"></label>
        <textarea class="comment__textarea" name="edit-comment" required><?php echo $comment['comment']; ?></textarea>
        <button class="comment__button" type="submit">Update comment</button>
    </form>

    <form action="/app/posts/delete-comment.php?id=<?php echo $commentId; ?>" method="post">
        <label for="delete-comment"></label>
        <input type="hidden" name="delete-comment">
        <button class="delete-comment-button" type="submit">Delete comment</button>
    </form>
</section>