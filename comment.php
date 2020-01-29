<?php
require __DIR__ . '/views/header.php';
require __DIR__ . '/app/users/showuserinfo.php';
?>
<?php
$idFromGet = (int) $_GET['id'];
$post = getPostById($pdo, $idFromGet);
$postId = $post['id'];
// var_dump($post);
?>
<section class="comment-page">
    <h3>Comment post</h3>
    <div>
        <img src="/uploads/posts<?php echo $post["image"]; ?>">
        <p><?php echo $post["content"]; ?></p>
    </div>

    <?php $comments = getAllCommentsToAPost($pdo, $postId); ?>

    <div class="comments">
        <!-- If there are no comments, message below will be displayed.-->
        <?php if (!$comments) : ?>
            <div class="comments__none">
                <p>There are no comments on this post yet. Be the first to comment.</p>
            </div>
        <?php endif; ?>

        <?php foreach ($comments as $comment) : ?>
            <div class="comments__previous">
                <div class="comments__previous-content">
                    <h4><?php echo $comment['first_name']; ?></h4>
                    <p class="comments-text"><?php echo $comment['comment']; ?></p>
                </div>
                <?php if ($comment['user_id'] == $_SESSION['user']['id']) : ?>
                    <div class="comments__previous-edit">
                        <a href="/edit-comment.php?id=<?php echo $comment['id']; ?>"><img src="/assets/images/edit.svg" alt="Edit comment"></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <form class="comment__form" action="/app/posts/comment.php?id=<?php echo $idFromGet; ?>" method="post">
            <label for="comment"></label>
            <textarea class="comment__textarea" name="comment" placeholder="Write your comment here..." required></textarea>
            <button class="comment__button" type="submit">Submit</button>
        </form>
    </div>
</section>