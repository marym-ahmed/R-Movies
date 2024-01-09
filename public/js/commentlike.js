
$('.like').on('click', function() {

    var like_s = $(this).attr('data-like');
    var comment_id =$(this).attr('data-commentid');
    comment_id= comment_id.slice(0,-2);

     $.ajax({
        type: 'POST',
        url: url,
        data: {like_s: like_s, comment_id: comment_id, _token: token},

        success: function(data){
            //alert(data.is_like);

            if(data.is_like == 1){
                $('*[data-commentid="'+comment_id+'_l"]').removeClass('btn-secondry').addClass('btn-success')
                $('*[data-commentid="'+comment_id+'_d"]').removeClass('btn-danger').addClass('btn-secondry')

                var cu_like =  $('*[data-commentid="'+comment_id+'_l"]').find('.like_count').text();
                var new_like =parseInt(cu_like) +1;
                var cu_like =  $('*[data-commentid="'+comment_id+'_l"]').find('.like_count').text(new_like);
                if(data.change_like == 1){

                var cu_dislike=  $('*[data-commentid="'+comment_id+'_d"]').find('.dislike_count').text();
                var new_dislike =parseInt(cu_dislike) - 1;
                var cu_dislike=  $('*[data-commentid="'+comment_id+'_d"]').find('.dislike_count').text(new_dislike);
            }}
            if(data.is_like == 0){
                $('*[data-commentid="'+comment_id+'_l"]').removeClass('btn-success').addClass('btn-secondry')
                var cu_like =  $('*[data-commentid="'+comment_id+'_l"]').find('.like_count').text();
                var new_like =parseInt(cu_like) - 1;
                var cu_like =  $('*[data-commentid="'+comment_id+'_l"]').find('.like_count').text(new_like);

            }

        }
    })

    });


    $('.dislike').on('click', function() {

        var like_s = $(this).attr('data-like');
        var comment_id =$(this).attr('data-commentid');
        comment_id= comment_id.slice(0,-2);


         $.ajax({
            type: 'POST',
            url: url_dis,
            data: {like_s: like_s, comment_id: comment_id, _token: token},

            success: function(data){

              if(data.is_dislike == 1){
                $('*[data-commentid="'+ comment_id+'_d"]').removeClass('btn-secondry').addClass('btn-danger')
                $('*[data-commentid="'+comment_id+'_l"]').removeClass('btn-success').addClass('btn-secondry')
                var cu_dislike =  $('*[data-commentid="'+comment_id+'_d"]').find('.dislike_count').text();
                var new_dislike =parseInt(cu_dislike) +1;
                var cu_dislike =  $('*[data-commentid="'+comment_id+'_d"]').find('.dislike_count').text(new_dislike);
                if(data.change_dislike == 1){

                    var cu_like=  $('*[data-commentid="'+comment_id+'_l"]').find('.like_count').text();
                    var new_like =parseInt(cu_like) - 1;
                    var cu_like=  $('*[data-commentid="'+comment_id+'_l"]').find('.like_count').text(new_like);
                }


            }
                if(data.is_dislike == 0){

                    $('*[data-commentid="'+ comment_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry')
                    var cu_dislike=  $('*[data-commentid="'+comment_id+'_d"]').find('.dislike_count').text();
                    var new_dislike =parseInt(cu_dislike) - 1;
                    var cu_dislike=  $('*[data-commentid="'+comment_id+'_d"]').find('.dislike_count').text(new_dislike);
                }


            }
        })

        });



    $('.report').on('click', function() {

        var like_s = $(this).attr('data-report');
        var comment_id =$(this).attr('data-commentid');
        comment_id= comment_id.slice(0,-2);
         $.ajax({
            type: 'POST',
            url: report,
            data: {like_s: like_s, comment_id: comment_id, _token: token},

            success: function(data){
                //alert(data.is_like);

                if(data.is_report == 1){
                    $('*[data-commentid="'+comment_id+'_r"]').removeClass('btn-secondry').addClass('btn-danger')
                    var cu_report =  $('*[data-commentid="'+comment_id+'_r"]').find('.report_count').text();
                    var new_report =parseInt(cu_report) +1;
                    var cu_report =  $('*[data-commentid="'+comment_id+'_r"]').find('.report_count').text(new_report);

                }
                if(data.is_report == 0){
                    $('*[data-commentid="'+comment_id+'_r"]').removeClass('btn-danger').addClass('btn-secondry')
                    var cu_report=  $('*[data-commentid="'+comment_id+'_r"]').find('.report_count').text();
                    var new_report =parseInt(cu_report) - 1;
                    var cu_report=  $('*[data-commentid="'+comment_id+'_r"]').find('.report_count').text(new_report);

                }

            }
        })

        });
