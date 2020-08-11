<?php

//Добавление новых коментариев
if (isset($_REQUEST['comment'])) {
    $errors = []; // список ошибок если не заполнены поля

    //Проверка на заполненость полей
    //Если поля пустые добавляем в массив ошибок сообщение об ошибке
    //Иначе присваеваем значение из глобального массива переменной
    if (empty($_REQUEST['name'])) {
        $errors['name'] = 'Введите имя';
    } else {
        $name = trim(htmlspecialchars($_REQUEST['name']));
    }

    if (empty($_REQUEST['message'])) {
        $errors['message'] = 'Оставьте комментарий';
    } else {
        $message = trim(htmlspecialchars($_REQUEST['message']));
    }

// Если массив с ошибками пуст - делаем запрос к БД и вставляем в нее новые данные
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO guest_book  (name, message, date) VALUES (:name,:message,NOW())");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
        header('refresh:0');
    }
}


//Пагинация
$stmt = $pdo->query("SELECT COUNT(*) as count FROM guest_book");

//количество записей в БД
$count = $stmt->fetchColumn();

//количество комментариев на странице
$comment_on_page = 2;

//текущая страница
if ($_REQUEST['page']) {
    $page = (int)$_REQUEST['page'];
} else {
    $page = 1;
};

//количество страниц пагинации
$page_count = ceil($count / $comment_on_page);

//смешение в выборке данных для следующей страницы
$offset = ($page - 1) * $comment_on_page;

// Так как определение текущей страницы реализовано в файле main.js этот код закомментирован
// Если пагинация  нужна с перезагрузкой страницы следует раскомментировать данный код и переменные $prev и $next
//подставить в index.php в адреса ссылок с стрелками назад-вперед


//предыдущие записи
/*if ($page <= 1) {
    $prev = 1;
} else {
    $prev = $page - 1;
}*/

//следующие записи
/*if ($page >= $page_count) {
    $next = $page_count;
} else {
    $next = $page + 1;
}*/


//запрос на выборку нужного кол-ва данных из БД и вывод  комментариев
$stmt     = $pdo->query("SELECT * FROM guest_book ORDER BY id DESC LIMIT $offset,$comment_on_page");
$messages = [];

while ($row = $stmt->fetch()) {
    $messages[] = $row;
}
if ($row == 0) {
    $no_comment = 'Пока нет комментариев';
}

//Ajax пагинация

// Если существует $_REQUEST['move'] запускаем цикл и выходим
// exit() нужен чтобы не выводилась заново вся страница, а обновлялась только часть с комментариями
if (isset($_REQUEST['move'])) {
    foreach ($messages as $message) {
        echo '<p>';
        echo '<time class="date">' . date('d.m.y H:s:i', strtotime($message['date'])) . '</time>';
        echo '<span> ' . $message['name'] . '</span>';
        echo '</p>';
        echo '<p>' . $message['message'] . '</p>';
    }
    exit();
}
