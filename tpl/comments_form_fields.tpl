            {if $user_logged_in}

                <p>{$comment_logged_in_message}</p>

            {else}

                <p><input class="author{if $req} required{/if}" type="text" name="author" id="author" value="{esc_attr $comment_author}" size="22" tabindex="1" {if $req}aria-required="true"{/if} />
                <label for="author">{translate 'Name'} {if $req}<span class="required-note">{translate '(ben&#246;tigt)'}</span>{/if}</label></p>

                <p><input class="email{if $req} required{/if}" type="text" name="email" id="email" value="{esc_attr $comment_author_email}" size="22" tabindex="2" {if $req}aria-required="true"{/if} />
                <label for="email">{translate 'Mail (wird nicht ver&#246;ffentlicht)'} {if $req}<span class="required-note">{translate '(ben&#246;tigt)'}</span>{/if}</label></p>

                <p><input type="text" name="url" id="url" value="{esc_attr $comment_author_url}" size="22" tabindex="3" />
                <label for="url">{translate 'Website'}</label></p>

            {/if}

            <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

            <p>
            <label for="comment">{translate 'Dein Kommentar:'}</label>
            <textarea name="comment" id="comment" class="commenttext{if $req} required{/if}" cols="58" rows="10" tabindex="4" {if $req}aria-required="true"{/if}></textarea>
            </p>