$(function() {
    loadTimeLine();
    sendTweet();
});

function loadTimeLine()
{
    $.ajax({
        url: '/timeline',
        method: 'GET',
        dataType: 'json',
    })
        .done(function (data, status) {
            console.log(data);
            let timeLine = $('.timeline');
            for(let i in data.data.tweet)
            {
                let id = data.data.tweet[i].id;
                let message = data.data.tweet[i].message;
                let user_id = data.data.tweet[i].user_id;
                let username = data.data.users[i].username;
                let name = data.data.users[i].name;
                let avatar = data.data.users[i].avatar;
                let date_tweet = data.data.tweet[i].tweet_date;
                let personal_tweet =data.data.tweet[i].personal;

                timeLine.append("<div class='tweet' id='tweet_"+id+"'></div>");

                let tweet = $('#tweet_'+id);

                tweet.append("<span class='profile-picture'><img class='profile-picture-medium' src='/storage/avatars/"+avatar+"' ></span>");
                tweet.append("<span class='tweet-head'></span>");

                let tweetHead = $('#tweet_'+id+' > .tweet-head');

                let content = "Masquer";
                if(personal_tweet)
                {
                    content = "Supprimer";
                }

                tweetHead.append("<span class='full-name'>"+name+"</span>");
                tweetHead.append("<span class='username'><a href='/user/"+username+"'>@"+username+"</a></span>");
                tweetHead.append("<span class='dot'> &bull; </span>");
                tweetHead.append("<span class='date-tweet'>"+date_tweet+"</span>");
                tweetHead.append("<span class='icon caret-down' data-id='"+id+"' onclick='openDropDown($(this).data(\"id\"))'><img src='/images/caret-down.png' /></span>");
                tweetHead.append("<div class='custom-dropdown' id='dropdown_"+id+"'><div class='custom-dropdown-menu'><span class='action'>"+content+"</span></div></div>");
                tweet.append("<div class='tweet-content'>"+message+"</div>");

            }
        })
        .fail(function (data, status, error) {
            
        });
}

function openDropDown(tweetId)
{
    let dropdown = $('#dropdown_'+tweetId);


    if (dropdown.hasClass('toggle'))
    {
        dropdown.hide();
        dropdown.removeClass('toggle');
    }
    else
    {
        dropdown.show();
        dropdown.addClass('toggle');

    }

}

function sendTweet()
{
    $('#formSendTweet').submit(function(e) {
        e.preventDefault();

        let form = $('#formSendTweet');
        let action = form.attr('action');
        let method = form.attr('method');

        let data = form.serialize();

        $.ajax({
            'url':action,
            'method':method,
            'data':data,
        })
            .done(function(data, status) {
                form.trigger("reset");
                console.log(data);
                let timeLine = $('.timeline');

                let id = data.data.tweet.id;
                let message = data.data.tweet.message;
                let user_id = data.data.tweet.user_id;
                let username = data.data.user.username;
                let name = data.data.user.name;
                let avatar = data.data.user.avatar;
                let date_tweet = data.data.tweet.tweet_date;
                let personal_tweet =data.data.tweet.personal;

                timeLine.prepend("<div class='tweet' id='tweet_"+id+"'></div>");

                let tweet = $('#tweet_'+id);

                tweet.append("<span class='profile-picture'><img class='profile-picture-medium' src='/storage/avatars/"+avatar+"' ></span>");
                tweet.append("<span class='tweet-head'></span>");

                let tweetHead = $('#tweet_'+id+' > .tweet-head');

                let content = "Masquer";
                if(personal_tweet)
                {
                    content = "Supprimer";
                }

                tweetHead.append("<span class='full-name'>"+name+"</span>");
                tweetHead.append("<span class='username'><a href='/user/"+username+"'>@"+username+"</a></span>");
                tweetHead.append("<span class='dot'> &bull; </span>");
                tweetHead.append("<span class='date-tweet'>"+date_tweet+"</span>");
                tweetHead.append("<span class='icon caret-down' data-id='"+id+"' onclick='openDropDown($(this).data(\"id\"))'><img src='/images/caret-down.png' /></span>");
                tweetHead.append("<div class='custom-dropdown' id='dropdown_"+id+"'><div class='custom-dropdown-menu'><span class='action'>"+content+"</span></div></div>");
                tweet.append("<div class='tweet-content'>"+message+"</div>");
            });

    });
}