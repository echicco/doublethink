var Doublethink = new function() {

    /// The makePost function expects _all_ its arguments to be valid.
    this.makePost = function (category, author, avatar, content, date) {
        // post = Outer frame
        var post = $('<div class="post-full"></div>');
        // Topics change the accent of each post
        post.addClass('topic-' + category);

        // post_heading = Upper part of the post, complete with avatar and name
        var post_heading = $('<div class="post-heading"><span class="post-topic">&nbsp;</span>' +
            '<div class="post-avatar"></div><div class="post-author"></div></div>');

        // Write the author's name and make it fit
        post_heading.find('div.post-author').text(author);
        // Set the avatar
        post_heading.find('div.post-avatar').css('background-image', 'url("' + avatar + '")');

        // post_body = Middle part of the post, contains its main content
        var post_body = $('<div class="post-body"></div>');
        post_body.text(content);

        // post_footer = Bottom part of the post, contains date of posting
        var post_footer = $('<div class="post-footer"></div>');
        post_footer.text(date);

        post.append(post_heading);
        post.append(post_body);
        post.append(post_footer);

        return post;
    }

};

