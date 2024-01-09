
$('.like').on('click', function () {

    var like_s = $(this).attr('data-like');
    var movie_id = $(this).attr('data-movieid');
    movie_id = movie_id.slice(0, -2);

    $.ajax({
        type: 'POST',
        url: url,
        data: { like_s: like_s, movie_id: movie_id, _token: token },

        success: function (data) {
            //alert(data.is_like);

            if (data.is_like == 1) {
                $('*[data-movieid="' + movie_id + '_l"]').removeClass('btn-info').addClass('colorLike')
                $('*[data-movieid="' + movie_id + '_d"]').removeClass('colorDisLike').addClass('btn-info')

                var cu_like = $('*[data-movieid="' + movie_id + '_l"]').find('.like_count').text();
                var new_like = parseInt(cu_like) + 1;
                var cu_like = $('*[data-movieid="' + movie_id + '_l"]').find('.like_count').text(new_like);
                if (data.change_like == 1) {

                    var cu_dislike = $('*[data-movieid="' + movie_id + '_d"]').find('.dislike_count').text();
                    var new_dislike = parseInt(cu_dislike) - 1;
                    var cu_dislike = $('*[data-movieid="' + movie_id + '_d"]').find('.dislike_count').text(new_dislike);
                }
            }
            if (data.is_like == 0) {
                $('*[data-movieid="' + movie_id + '_l"]').removeClass('colorLike').addClass('btn-info')
                var cu_like = $('*[data-movieid="' + movie_id + '_l"]').find('.like_count').text();
                var new_like = parseInt(cu_like) - 1;
                var cu_like = $('*[data-movieid="' + movie_id + '_l"]').find('.like_count').text(new_like);

            }

        }
    })

});


$('.dislike').on('click', function () {

    var like_s = $(this).attr('data-like');
    var movie_id = $(this).attr('data-movieid');
    movie_id = movie_id.slice(0, -2);


    $.ajax({
        type: 'POST',
        url: url_dis,
        data: { like_s: like_s, movie_id: movie_id, _token: token },

        success: function (data) {

            if (data.is_dislike == 1) {
                $('*[data-movieid="' + movie_id + '_d"]').removeClass('defaultColor').addClass('colorDisLike')
                $('*[data-movieid="' + movie_id + '_l"]').removeClass('colorLike').addClass('defaultColor')
                var cu_dislike = $('*[data-movieid="' + movie_id + '_d"]').find('.dislike_count').text();
                var new_dislike = parseInt(cu_dislike) + 1;
                var cu_dislike = $('*[data-movieid="' + movie_id + '_d"]').find('.dislike_count').text(new_dislike);
                if (data.change_dislike == 1) {

                    var cu_like = $('*[data-movieid="' + movie_id + '_l"]').find('.like_count').text();
                    var new_like = parseInt(cu_like) - 1;
                    var cu_like = $('*[data-movieid="' + movie_id + '_l"]').find('.like_count').text(new_like);
                }


            }
            if (data.is_dislike == 0) {

                $('*[data-movieid="' + movie_id + '_d"]').removeClass('colorDisLike').addClass('defaultColor')
                var cu_dislike = $('*[data-movieid="' + movie_id + '_d"]').find('.dislike_count').text();
                var new_dislike = parseInt(cu_dislike) - 1;
                var cu_dislike = $('*[data-movieid="' + movie_id + '_d"]').find('.dislike_count').text(new_dislike);
            }


        }
    })

});



$('.report').on('click', function () {

    var like_s = $(this).attr('data-report');
    var movie_id = $(this).attr('data-movieid');
    movie_id = movie_id.slice(0, -2);
    $.ajax({
        type: 'POST',
        url: report,
        data: { like_s: like_s, movie_id: movie_id, _token: token },

        success: function (data) {
            //alert(data.is_like);

            if (data.is_report == 1) {
                $('*[data-movieid="' + movie_id + '_r"]').removeClass('defaultColor').addClass('colorReport')
                var cu_report = $('*[data-movieid="' + movie_id + '_r"]').find('.report_count').text();
                var new_report = parseInt(cu_report) + 1;
                var cu_report = $('*[data-movieid="' + movie_id + '_r"]').find('.report_count').text(new_report);

            }
            if (data.is_report == 0) {
                $('*[data-movieid="' + movie_id + '_r"]').removeClass('colorReport').addClass('defaultColor')
                var cu_report = $('*[data-movieid="' + movie_id + '_r"]').find('.report_count').text();
                var new_report = parseInt(cu_report) - 1;
                var cu_report = $('*[data-movieid="' + movie_id + '_r"]').find('.report_count').text(new_report);

            }

        }
    })

});
