var Doublethink = new function() {

    this._sendFetchRequest = function(data, success) {
        // Makes a POST request to get_posts.php with the necessary data and calls "success" with the parsed response
        var _this = this;
        $.post('get_posts.php', data, function(response) {
            obj = JSON.parse(response);
            if(obj.hasOwnProperty('error')) {
                _this.notifyUser('error', obj.error)
            }
            else {
                success(obj);
            }
        });
    };

    /// The fetchPosts() function expects a number and a callback function
    /// postIDs: The IDs of the posts to fetch data for
    /// success: The callback function which will be called with a key-value object representing a post as only parameter
    /// returns: nothing
    this.fetchPosts = function(postIDs, success) {
        this._sendFetchRequest( { action: 'fetch-post-data', ids: postIDs }, success );
    };

    /// The fetchLatestPostIDs() function expects a number and a callback function.
    /// num: The number of post IDs to fetch
    /// success: The callback function which will be called with an array of IDs as only parameter
    /// returns: nothing
    this.fetchLatestPostIDs = function(num, success) {
        this._sendFetchRequest( { action: 'fetch-id-list', limit: num }, success );
    };

    /// The createPost() function expects _all_ its arguments to be valid.
    /// returns: A constructed "Post" DOM element
    this.createPost = function (data) {
        // post = Outer frame
        var post = $('<div class="post-full id-' + data.id + '"></div>');
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
        $('#post-wrapper').append(dom_element);
    };

    this.notifyUser = function(notification_type, message) {
        switch(notification_type) {
            case 'error':
            case 'success':
            case 'info':
                var notice = $('<div class="notice ' + notification_type + '">' + message + '</div>');
                $('#left-col').append(notice);
                break;
            default:
                throw "Invalid notification type!";
                break;
        }
    };

};

