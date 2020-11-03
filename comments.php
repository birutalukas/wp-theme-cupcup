<div>
    <?php if ( have_comments() ) : ?>
        <div class="comments">
            <h3>Komentarai</h3>
            <ul class="comment-list">
                <?php wp_list_comments(); ?>
            </ul><!-- .comment-list -->
        </div>
    <?php endif; // Check for comment navigation ?>
</div>
<div class="comment-form">
    <?php comment_form(
        array(
            'title_reply_to' => 'Atsakyti į %s komentarą',
            'cancel_reply_link' => 'Atsisakyti komentaro'
        )
    ); ?>
</div>
