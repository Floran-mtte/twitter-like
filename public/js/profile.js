$(function() {
    laodTweet();

    $('#tweet').on('click', function (e) {
        $('.timeline').html('');

        $('#tweet').addClass('active');
        $('#following').removeClass('active');
        $('#followed').removeClass('active');
        laodTweet();
    });

    $('#following').on('click', function (e) {
       $('.timeline').html('');

       $('#tweet').removeClass('active');
       $('#followed').removeClass('active');
       $('#following').addClass('active');
       loadFollowing();
    });

    $('#followed').on('click', function (e) {
        $('.timeline').html('');

        $('#tweet').removeClass('active');
        $('#following').removeClass('active');
        $('#followed').addClass('active');
        loadFollowers();
    });

    $('.follow-btn').on('click',function (e) {
        let id_user = $('#id_user').val();

        if($(this).data('type') === "unfollow")
        {
            unfollow(id_user);
            let counterFollower = $('#followed > .value-menu');
            let countFollowers = parseInt(counterFollower.text());
            countFollowers--;
            counterFollower.html('');
            counterFollower.append(countFollowers);

            /*let counterFollowing = $('#following > .value-menu');
            let countFollowing = parseInt(counterFollowing.text());
            if(counterFollowing > 0)
            {
                countFollowing--;
                counterFollowing.html('');
                counterFollowing.append(countFollowing.toString());
            }*/

        }
        else if($(this).data('type') === "follow")
        {
            follow(id_user);
            let counterFollower = $('#followed > .value-menu');
            let countFollowers = parseInt(counterFollower.text());
            countFollowers++;
            counterFollower.html('');
            counterFollower.append(countFollowers);
        }
    });

    $('.follow-btn').hover(function(){

        if($(this).data('type') === "unfollow")
        {
            $(this).text("Se désabonner");
        }
    }, function(){
        if($(this).data('type') === "unfollow")
        {
            $(this).text("Abonné");
        }
        else
        {
            $(this).text("Suivre");
        }
    });



});

function laodTweet()
{
    let id = $('#id_user').val();
    $.ajax({
        url: '/personal',
        method: 'GET',
        data:'id='+id,
        dataType: 'json',
    })
        .done(function (data, status) {
            console.log(data);
            let timeLine = $('.timeline');
            for(let x in data.tweet)
            {
                for (let i in data.tweet[x])
                {
                    let id = data.tweet[x][i].id;
                    let message = data.tweet[x][i].message;
                    let user_id = data.tweet[x][i].user_id;
                    let username = data.users[x][i].username;
                    let name = data.users[x][i].name;
                    let avatar = data.users[x][i].avatar;
                    let date_tweet = data.tweet[x][i].tweet_date;
                    let personal_tweet =data.tweet[x][i].personal;

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

            }
        })
        .fail(function (data, status, error) {

        });
}

function loadFollowing()
{
    let id = $('#id_user').val();
    $.ajax({
        url:'/loadFollowing',
        method:'GET',
        data: 'id='+id,
        dataType:'json'
    })
        .done(function (data, status) {
            console.log(data);

            let timeLine = $('.timeline');

            for(let i in data.data.users)
            {

                let id = data.data.users[i].id;
                let name = data.data.users[i].name;
                let username = data.data.users[i].username;
                let avatar = data.data.users[i].avatar;

                timeLine.append('<div class="follow-row" id="user_'+id+'"></div>');

                let user_card = $('.timeline > #user_'+id);
                user_card.append('<div id="card_'+id+'" class="card" style="width: 18rem;"><div class="card-body"></div></div>');

                let card_content = $('.timeline > #user_'+id+' > #card_'+id);

                card_content.append('<div class="avatar-small"><img src="/storage/avatars/'+avatar+'"  class="profile-picture-medium"/></div>');
                card_content.append('<h5 class="card-title">'+name+'</h5>')
                card_content.append('<h6 class="card-subtitle mb-2 text-muted"><a href="/user/'+username+'">@'+username+'</a></h6>');






            }
        })
        .fail(function (data, status, error) {

        });
}

function loadFollowers()
{
    let id = $('#id_user').val();
    $.ajax({
        url:'/loadFollowers',
        method:'GET',
        data: 'id='+id,
        dataType:'json'
    })
        .done(function (data, status) {
            console.log(data);

            let timeLine = $('.timeline');

            for(let i in data.data.users)
            {

                let id = data.data.users[i].id;
                let name = data.data.users[i].name;
                let username = data.data.users[i].username;
                let avatar = data.data.users[i].avatar;

                timeLine.append('<div class="follow-row" id="user_'+id+'"></div>');

                let user_card = $('.timeline > #user_'+id);
                user_card.append('<div id="card_'+id+'" class="card" style="width: 18rem;"><div class="card-body"></div></div>');

                let card_content = $('.timeline > #user_'+id+' > #card_'+id);

                card_content.append('<div class="avatar-small"><img src="/storage/avatars/'+avatar+'"  class="profile-picture-medium"/></div>');
                card_content.append('<h5 class="card-title">'+name+'</h5>')
                card_content.append('<h6 class="card-subtitle mb-2 text-muted"><a href="/user/'+username+'">@'+username+'</a></h6>');






            }
        })
        .fail(function (data, status, error) {

        });
}

function unfollow(id_following)
{
    $.ajax({
        url:'/unfollow',
        method:'delete',
        data:'id_following='+id_following,
        dataType:'json'
    })
        .done(function (data, status) {
            console.log(data);

            if(data.status === "success")
            {
                let followBtn = $('.follow-btn');
                followBtn.data('type','follow');
                followBtn.text('Suivre');
            }
        })
        .fail(function (data, status, error) {

        });
}

function follow(id_following)
{
    $.ajax({
        url:'/follow',
        method:'post',
        data:'id_following='+id_following,
        dataType:'json'
    })
        .done(function (data, status) {
            console.log(data);

            if(data.status === "success")
            {
                let followBtn = $('.follow-btn');
                followBtn.data('type','unfollow');
                followBtn.text('Abonné');

            }
        })
        .fail(function (data, status, error) {

        });
}