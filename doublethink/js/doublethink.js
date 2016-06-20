var Doublethink = new function() {

    /// The makePost function expects _all_ its arguments to be valid.
    this.makePost = function (category, author, avatar, content, date) {
        // post = Outer frame
        var post = $('<div class="post-full"></div>');
        // Topics change the accent of each post
        post.addClass('topic-' + category);

        // post_heading = Upper part of the post, complete with avatar and name
        var post_heading = $('<div class="post-heading"><span class="post-topic"></span>' +
            '<div class="post-avatar"></div><div class="post-author">' + author + '</div></div>');

        // Set the avatar
        post_heading.find('div.post-avatar').css('background-image', 'url("' + avatar + '")');

        // post_body = Middle part of the post, contains its main content
        var post_body = $('<div class="post-body">' + content + '</div>');

        // post_footer = Bottom part of the post, contains date of posting
        var post_footer = $('<div class="post-footer">' + date + '</div>');

        post.append(post_heading);
        post.append(post_body);
        post.append(post_footer);

        return post;
    };

    this.addPost = function(post) {
        $('#left-col').append(post);
    };

};

