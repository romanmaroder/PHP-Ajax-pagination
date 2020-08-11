// Пагинация ajax
$(document).ready(function () {

    //При клике по номерам страниц
    $('.page-link').on('click', function (e) {

        //Отменяем стандартное поведение ссылок
        e.preventDefault();

        //Получаем значение ссылки
        let page = $(this).attr('href');

        // При клике на кнопку назад, добавляем класс "active" текущей ссылке
        $(this).closest('ul').find('li').removeClass('active');
        $(this).parent().addClass('active');

        // Выполняем ajax запрос
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: page + '&move', //&move дополнительный параметр для ajax запроса
            success: function (data) {
                $('.note').html(data);
            }
        });

    })

    //При клике по ссылке назад
    $('.prev').on('click', function (e) {

        //Отменяем стандартное поведение ссылок
        e.preventDefault();

        //Выбираем из всех ссылок на страницы, ту у которой класс 'active' и удаляем его.
        //Находим предыдущую ссылку и добавляем к ней кдасс 'active'
        let list = $('.pagination li').filter('.active').removeClass('active').prev().addClass('active');

        list.each(function (i, elem) {
            //Проверяем каждую ссылку на наличие класса 'prev'
            if ($(this).hasClass('prev')) {
                // Если такой есть, тогда НЕ добавляем к нему класс 'active'
                $(this).removeClass('active')
            }
        })

        // Находим аттрибут data-id у ссылок с классом 'active' и записываем в переменную
        let page = $('.page-link').parent('.active').data('id');
        //Если data-id не найден, добавляем класс 'active' предыдущей ссылке
        if (page === undefined) {
            $('.pagination li[data-id]:first').addClass('active');
        } else {
            // Если аттрибут есть, выполняем запрос на сервер
            $.ajax({
                url: 'index.php',
                type: 'POST',
                data: 'page=' + page + '&move',
                success: function (data) {
                    $('.note').html(data);
                }
            });
        }

    });

    //При клике по ссылке вперед
    $('.next').on('click', function (e) {

        e.preventDefault();

        let list = $('.pagination li').filter('.active').removeClass('active').next().addClass('active');

        list.each(function (i, elem) {
            if ($(this).hasClass('next')) {
                $(this).removeClass('active')
            }
        })

        let page = $('.page-link').parent('.active').data('id');

        if (page === undefined) {
            $('.pagination li[data-id]:last').addClass('active');
        } else {
            $.ajax({
                url: 'index.php',
                type: 'POST',
                data: 'page=' + page + '&move',
                success: function (data) {
                    $('.note').html(data);
                }
            });
        }

    });

});
