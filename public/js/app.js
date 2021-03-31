(function($){
    var movieSearchInterval = undefined;

    $('#title').on('input', function (){
        getMovieLocal($(this));
    }).on('click', function(){
        if($(this).val().length >= 3){
            let searchMovie = $('#search-movie');

            if(searchMovie.find('.movie').length > 0){
                searchMovie.removeClass('d-none');
                return true;
            }

            getMovieLocal($('#title'));
        }
    })

    $('#search-movie').on('click', '.movie', function (){
        let searchMovie = $('#search-movie'),
            url = searchMovie.data('url');

        searchMovie.addClass('d-none');

        $.ajax({
            'url': url,
            'data': {'showID':$(this).find('input').val()},
            'method': 'post'
        }).done(function (data){
            $('#show').removeClass('d-none').html(data);
        }).fail(function (jqXHR, textStatus) {
            alert( "Request failed: " + textStatus );
        })
    })

    $('#search-movie, form').on('click', 'button', function (){
        getMovieOnline($(this));
    })

    function getMovieLocal(item){
        let form = $('#header form'),
            url = form.attr('action'),
            title = item.val(),
            type = form.find('#type').val();

        if(item.val().length < 3){
            return false;
        }

        clearInterval(movieSearchInterval);

        movieSearchInterval = setInterval(function () {
            $.ajax({
                'url': url,
                'data': {'title':title, 'type':type},
                'method': 'post'
            }).done(function (data){
                let searchMovie = $('#search-movie');
                searchMovie.removeClass('d-none').html(data);

                if(searchMovie.height() > 500) {
                    searchMovie.addClass('lots-of-movies')
                } else {
                    searchMovie.removeClass('lots-of-movies')
                }

                clearInterval(movieSearchInterval);
            }).fail(function (jqXHR, textStatus) {
                alert( "Request failed: " + textStatus );
            })
        }, 500);
    }

    function getMovieOnline(item){
        let searchMovie = $('#search-movie');

        if($(this).data('url') === ''){
            searchMovie.addClass('d-none');
            return true;
        }

        let showContainer = $('#show'),
            form = $('#header form'),
            url = item.data('url'),
            title = form.find('#title').val(),
            type = form.find('#type').val()

        $.ajax({
            'url': url,
            'data': {'title':title, 'type':type},
            'method': 'post'
        }).done(function (data){
            let results = $.parseJSON(data);

            if(!results.response){
                searchMovie.removeClass('d-none').html(results.view);
                showContainer.addClass('d-none');
                return true;
            } else {
                console.log('test 2');
                searchMovie.addClass('d-none');
                showContainer.removeClass('d-none').html(results.view);
            }
        }).fail(function (jqXHR, textStatus) {
            alert( "Request failed: " + textStatus );
        })
    }
})(jQuery)
