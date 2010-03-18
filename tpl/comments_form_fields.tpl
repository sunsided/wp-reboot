            {if $user_logged_in}

                <p>{$comment_logged_in_message}</p>

            {/if}

            <script language="javascript" type="text/javascript">
            <!--
                function rebootFocus(idElement){ document.getElementById(idElement).setAttribute("class", "focused"); }
                function rebootUnfocus(idElement){ document.getElementById(idElement).setAttribute("class", "unfocused"); }
            -->
            </script>

            <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

            <div class="comment-row commenttext">
            <label id="comment-label" for="comment">{translate 'Dein Kommentar:'}</label>
            <textarea
                onFocus="javascript:rebootFocus('comment-label');"
                onBlur="javascript:rebootUnfocus('comment-label');"
                tabindex="1" name="comment" id="comment" class="commenttext{if $req} required{/if}" cols="58" rows="10" tabindex="4" {if $req}aria-required="true"{/if}></textarea>
            </div>

            {if !$user_logged_in}

                <div class="author-row new-comment-author-info">
                <label id="author-label" for="author">{translate 'Name'} {if $req}<span class="required-note">{translate '(ben&#246;tigt)'}</span>{/if}</label>
                <input
                    onFocus="javascript:rebootFocus('author-label');"
                    onBlur="javascript:rebootUnfocus('author-label');"
                    tabindex="2" class="author{if $req} required{/if}" type="text" name="author" id="author" value="{esc_attr $comment_author}" size="22" tabindex="1" {if $req}aria-required="true"{/if} />
                </div>

                <div class="email-row new-comment-author-info">
                <label id="email-label" for="email">{translate 'Mail <span class="not-published-note">(geheim<!-- wird nicht ver&#246;ffentlicht -->)</span>'} {if $req}<span class="required-note">{translate '(ben&#246;tigt)'}</span>{/if}</label>
                <input
                    onFocus="javascript:rebootFocus('email-label');"
                    onBlur="javascript:rebootUnfocus('email-label');"
                    tabindex="3" class="email{if $req} required{/if}" type="text" name="email" id="email" value="{esc_attr $comment_author_email}" size="22" tabindex="2" {if $req}aria-required="true"{/if} />
                </div>

                <div class="url-row new-comment-author-info">
                <label id="url-label" for="url">{translate 'Website'}</label>
                <input
                    onFocus="javascript:rebootFocus('url-label');"
                    onBlur="javascript:rebootUnfocus('url-label');"
                    tabindex="4" class="url" type="text" name="url" id="url" value="{esc_attr $comment_author_url}" size="22" tabindex="3" />
                </div>

            {/if}