<div class="comment-section">
    <h2 style="margin-bottom: 25px;">Comments</h2>
    <ul class="comments">
        <li id="comment1">
            <p>this is cool!</p>
            <p><i style="font-size:13px;">Huy Nguyen - 15 minutes ago | <a href="#" onclick="return show_reply_form(1)">Reply</a></i></p>
            <ul class="comment_reply">
                <li>
                    <p>this is cool!</p>
                    <p><i style="font-size:13px;">Huy Nguyen - 15 minutes ago | <a href="#" onclick="return show_reply_form(1)">Reply</a></i></p>
                </li>
            </ul>
        </li>
    </ul>

    <form method="post" action="<?php echo base_url("lessons/comment/{$lesson->id}");?>" class="form-comment">
        <h4>Leave a comment</h4>
        <textarea class="form-input" placeholder="Your comment" rows="8" cols="111" style="resize:none;"></textarea>
        <input type="submit" name="submit_comment">
    </form>
</div>