var Doublethink = new function() {

    /// The fetchPostData() function expects a number and a callback function
    /// postID: The ID of the post to fetch data for
    /// success: The callback function which will be called with a key-value object representing a post as only parameter
    /// returns: nothing
    this.fetchPostData = function(postID, success) {
        // Ask the server to fetch the required data of a post the id of which is postID
        $.post('get_posts.php', { action: 'fetch-post-data', id: postID }, function(response) {
            success(JSON.parse(response));
        });
    };

    /// The fetchLatestPostIDs() function expects a number and a callback function.
    /// num: The number of post IDs to fetch
    /// success: The callback function which will be called with an array of IDs as only parameter
    /// returns: nothing
    this.fetchLatestPostIDs = function(num, success) {
        // Ask the server to return a list of size num containing the latest post IDs
        $.post('get_posts.php', { action: 'fetch-id-list', num: num }, function(response) {
            success(JSON.parse(response));
        });
    };

    /// The createPost() function expects _all_ its arguments to be valid.
    /// returns: A constructed "Post" DOM element
    this.createPost = function (data) {
        // post = Outer frame
        var post = $('<div class="post-full"></div>');
        // Topics change the accent of each post
        post.addClass('topic-' + data.topic);

        // post_heading = Upper part of the post, complete with avatar and name
        var post_heading = $('<div class="post-heading"><span class="post-topic"></span>' +
            '<div class="post-avatar"></div><div class="post-author">' + data.author + '</div></div>');

        // Set the avatar
        post_heading.find('div.post-avatar').css('background-image', 'url("' + data.avatar_url + '")');

        // post_body = Middle part of the post, contains its main content
        var post_body = $('<div class="post-body">' + data.content + '</div>');

        // post_footer = Bottom part of the post, contains date of posting
        var post_footer = $('<div class="post-footer">' + data.date + '</div>');

        post.append(post_heading);
        post.append(post_body);
        post.append(post_footer);

        return post;
    };

    /// The appendPost() function expects an element created via createPost() and appends it to the feed
    /// returns: nothing
    this.appendPost = function(dom_element) {
        $('#left-col').append(dom_element);
    };

};

